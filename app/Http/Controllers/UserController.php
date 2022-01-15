<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\topic;
use App\Models\Post;
use App\Models\User;
use App\Models\Categories;
use App\Models\PollQuestion;
use App\Models\PollTaken;
use App\Models\Notification;
use App\Models\Ban;
use App\Models\BanTimes;
use App\Models\PMTopic;
use App\Models\Shortcuts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Route;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::find(1);
        $users = User::where('is_admin', '0')->get();
        // dd($users->products);
        return view('admin.user.user', compact('users'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edituser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::where('id', $id)->first();
        $user->full_name = $request->full_name;
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if ($request->image) {
            if ($user->image != null) {
                $image_path = public_path('/') . '/users/' . $user->image;
                unlink($image_path);
            }
            $name = time() . '.' . $request->image->extension();
            $store = $request->image->storeAs('users', $name, 'public');
            $user->image = $name;
            $user->save();
        };
        $user->save();
        return redirect('admin/a_users');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Account::where('user_id', $user->id)->delete();
        $user->delete();
        return redirect()->back();
    }

    public function profile(Request $request, $id)
    {

        $categories = Categories::All();
        $BanTimes = BanTimes::All();

        if (user_info($id, 'disable_account') == "on" || user_info($id, 'id') < 1) {
            return redirect()->route('home');
        }

        if ($user = Auth::user() && $request->isMethod('post') && $request->post('ban_duration') != null && $request->post('reason') != null) {

            if ($id != myid() && my('level') >= 1 && my('level') <= 3 && my('level') > user_info($id, 'level')) {

                $this->validate($request, [
                    'reason' => 'required|min:23',
                    'ban_duration' => 'required'
                ]);

                if (ban_info($id, 'banned_till') < dayXnow()) {
                    $post_values = ['user_id' => $id,
                        'admin_id' => myid(),
                        'banned_till' => DatePlusMinutes($request->post('ban_duration')),
                        'reason' => $request->post('reason'),
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ];
                    $ins_or_update = Ban::insert($post_values);
                } else {   //edit current ban
                    $lastbanId = ban_info($id, 'id');
                    $ins_or_update = Ban::where('id', $lastbanId)->update(['admin_id' => myid(), 'banned_till' => DatePlusMinutes($request->post('ban_duration')), 'reason' => $request->post('reason')]);

                }

                if ($ins_or_update) {
                    return redirect()->route('show_banlist');
                }

            }

        }
        // max_topics_profile
        $topicsby = topic::orderBy('created_at', 'desc')->where('user_by', $id)->paginate(sys_info('max_topics_profile'));
        return view('user.UserProfile', ['uid' => $id, 'categories' => $categories, 'BanTimes' => $BanTimes, 'topicsby' => $topicsby]);
    }

    public function showTags(Request $request)
    {

        return view('tags.show');
    }

    public function getTags(Request $request)
    {


        $word = $request->get('query');
        $output = '';

        if ($word) {

            $alltags = DB::table('country')->where('nicename', $word)->orWhere('nicename', 'like', '%' . $word . '%')->limit(15)->get();

            $output = '<ul class="list-unstyled">';

            if ($alltags->count() >= 1) {

                foreach ($alltags as $tags) {
                    $output .= '<li>' . $tags->nicename . '</li>';
                }

            } else {
                $output .= '<li>Country Not Found</li>';
            }
            $output .= '</ul>';

            return $output;
        }// if get word


    }


    public function getUserTags(Request $request)
    {

        $word = $request->get('query');
        $output = '';

        if ($word) {

            $alltags = User::where('name', $word)->orWhere('name', 'like', '%' . $word . '%')->limit(15)->get();

            return view('tags.user_tags_json', ['tags' => $alltags]);
        }// if get word


    }


    public function MemberList(Request $request)
    {

        $max_items_perpage = sys_info('max_memberlist');
        $users = User::orderBy('id', 'asc')->paginate($max_items_perpage);
        return view('user.members', ['users' => $users,
            'max_perpage' => $max_items_perpage
        ]);

    }

    public function staff(Request $request)
    {

        $admins = User::where(['level' => '3'])->orderBy('id', 'asc')->get();
        $global_moders = User::where(['level' => '2'])->orderBy('id', 'asc')->get();
        $moders = User::where(['level' => '1'])->orderBy('id', 'asc')->get();

        $data = ['admins' => $admins, 'global_moders' => $global_moders, 'moders' => $moders];

        return view('user.staff', ['data' => $data]);

    }


    public function BanList(Request $request)
    {

        $max_items_perpage = sys_info('max_memberlist');

        $users = Ban::where([['banned_till', '>=', dayXnow()]])->orderBy('id', 'asc')->paginate($max_items_perpage);
        return view('user.banned_members', ['users' => $users,
            'max_perpage' => $max_items_perpage
        ]);

    }

    public function pmWhere(Request $request, $id = 0)
    {

        $iStarted = PMTopic::where('starter', myid())->where('with_to', $id)->get();
        $withStarted = PMTopic::where('with_to', myid())->where('starter', $id)->get();

        if ($iStarted->count() == 1) {
            return redirect()->route('messages', [$iStarted[0]['id']]);
        } elseif ($withStarted->count() == 1) {
            return redirect()->route('messages', [$withStarted[0]['id']]);
        } else {
            if (user_info($id, 'id') >= 1) {
                //return 'Start new';
                return redirect()->route('messages', ['contact' => $id]);
            } else {
                return redirect()->route('home');
            }

        }

    }


    public function settings(Request $request, $id = null, $subpage = null)
    {

        $success_msg = '';
        $warrning_msg = '';

        if ($user = Auth::user() && user_info($id, 'owner') != 1 && my('level') >= 1 && my('level') <= 3) {
            //if user logged in
            if ($request->isMethod('post')) {
                $user_id = (int)$request->post('user_id');

                //if editiong user info
                if ($subpage == '') {
                    $this->validate($request, [
                        'name' => 'required|max:80',
                        'username' => 'required|max:20',
                        'sex' => 'required|min:1|max:1',
                        'address' => 'max:200',
                        'profeesion' => 'max:100',
                        'social_msg' => 'max:500'
                    ]);


                    //Insert genera info
                    $my_info = [
                        'full_name' => $request->post('name'),
                        'name' => $request->post('username'),
                        'gender' => $request->post('sex'),
                        'location' => $request->post('address'),
                        'profession' => $request->post('profeesion'),
                        'social_msg' => $request->post('social_msg')
                    ];

                    $update_myinfo = User::where('id', $user_id)->update($my_info);
                    if ($update_myinfo) {
                        $success_msg = 'User info updated successfully';
                    } else {
                        $warrning_msg = 'Operation failed, We are sorry about. Please try again later.';
                    }

                } elseif ($subpage == 'account') {
                    $this->validate($request, [
                        'email' => 'required|min:6',
                        'password' => 'required|min:6'
                    ]);

                    $oldPassword = $request->post('password');
                    $hashedPassword = user_info($user_id, 'password');////eeeeeeeeeeeeeeee
                    $CurrentEmail = my('email');

                    if (Hash::check($oldPassword, $hashedPassword)) {
                        $new_password = $request->post('newpassword');
                        $repeat_password = $request->post('repeatpassword');

                        if (!empty($new_password) && $new_password == $repeat_password) {
                            $user = User::where('id', $user_id)->update(['email' => $request->post('email'), 'password' => Hash::make($new_password)]);
                            if ($user) {
                                $to_name = my('name');
                                $to_email = $request->post('email');

                                $data = array('name' => $to_name, 'email' => $to_email, 'pass' => $new_password);
                                Mail::send('email.view', $data, function ($message) use ($to_email, $to_name) {
                                    $message->to($to_email, $to_name)->subject('Your password has been changed');
                                });

                                Auth::logout();
                                return redirect()->route('home');
                            } else {
                                $warrning_msg = 'Password couldn`t change, We are sorry about. Please try again later.';
                            }
                        } else {
                            if (empty($new_password) && $CurrentEmail != $request->post('email')) {
                                $user = User::where('id', $user_id)->update(['email' => $request->post('email')]);
                                if ($user) {
                                    $success_msg = 'User email updated successfully';
                                } else {
                                    $warrning_msg = 'Email couldn`t change, We are sorry about. Please try again later.';
                                }
                            } else {
                                $warrning_msg = 'You couldn`t confirm password. Try again.';
                            }

                        }

                    }

                } elseif ($subpage == 'shortcuts') {
                    $user = User::where('id', $user_id)->update(['shortcuts' => $request->post('keepenCode')]);
                    if ($user) {
                        $success_msg = 'User shortcuts updated successfully';
                    } else {
                        $warrning_msg = 'Operation failed, We are sorry about. Please try again later.';
                    }

                } elseif ($subpage == 'level' && user_info($id, 'owner') != 1 && user_info($id, 'level') < my('level') && my('level') == 3 || my('owner') == 1) {

                    $set_level = (int)$request->post('levelup');
                    $disable_account = $request->post('disable_account');

                    $levelQuery = User::where('id', $id)->update(['level' => $set_level, 'disable_account' => $disable_account]);

                    if ($levelQuery) {
                        $success_msg = 'User level changed successfully';
                        return redirect()->route('UserModSettings', [$id, 'level']);
                    } else {
                        $warrning_msg = 'Operation failed, We are sorry about. Please try again later.';
                    }

                } else {
                    return redirect()->route('home');
                    exit;
                }


            }

            $shortcuts = Shortcuts::All();

            return view('user.user_settings', [
                'id' => $id,
                'subpage' => $subpage,
                'success_msg' => $success_msg,
                'warrning_msg' => $warrning_msg,
                'shortcuts' => $shortcuts
            ]);
        } else {
            return redirect()->route('home');
        }


    }
//end class
}


//
//namespace App\Http\Controllers;
//
//use App\Http\Requests\CreateUserRequest;
//use App\Http\Requests\UpdateUserRequest;
//use App\Models\Role;
//use App\Models\User;
//use App\Queries\UserDataTable;
//use App\Repositories\UserRepository;
//use Carbon\Carbon;
//use DataTables;
//use Exception;
//use Hash;
//use Illuminate\Contracts\Foundation\Application;
//use Illuminate\Contracts\View\Factory;
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\RedirectResponse;
//use Illuminate\Http\Request;
//use Illuminate\Routing\Redirector;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\View\View;
//use Response;
//
//class UserController extends AppBaseController
//{
//    /** @var UserRepository */
//    private $userRepository;
//
//    public function __construct(UserRepository $userRepo)
//    {
//        $this->userRepository = $userRepo;
//    }
//
//    /**
//     * @return Factory|View
//     */
//    public function getProfile()
//    {
//        return view('profile');
//    }
//
//    /**
//     * Display a listing of the User.
//     *
//     * @param  Request  $request
//     * @throws Exception
//     * @return Response
//     */
//    public function index(Request $request)
//    {
//        if ($request->ajax()) {
//            return Datatables::of((new UserDataTable())->get($request->only(['filter_user','privacy_filter'])))->make(true);
//        }
//        $roles = Role::all()->pluck('name', 'id')->toArray();
//
//        return view('users.index')->with([
//            'roles' => $roles,
//        ]);
//    }
//
//    /**
//     * Show the form for creating a new User.
//     *
//     * @return Response
//     */
//    public function create()
//    {
//        $roles = Role::all()->pluck('name', 'id')->toArray();
//
//        return view('users.create')->with(['roles' => $roles]);
//    }
//
//    /**
//     * Store a newly created User in storage.
//     *
//     * @param  CreateUserRequest  $request
//     *
//     * @return Response
//     */
//    public function store(CreateUserRequest $request)
//    {
//        $input = $this->validateInput($request->all());
//
//        $this->userRepository->store($input);
//
//        return $this->sendSuccess('User saved successfully.');
//    }
//
//    /**
//     * Display the specified User.
//     * @param  User  $user
//     *
//     * @return Response
//     */
//    public function show(User $user)
//    {
//        $user->roles;
//        $user = $user->apiObj();
//
//        return view('users.show')->with('user', $user);
//    }
//
//    /**
//     * Show the form for editing the specified User.
//     *
//     * @param  User  $user
//     * @return Response
//     */
//    public function edit(User $user)
//    {
//        $user->roles;
//        $user = $user->apiObj();
//
//        return $this->sendResponse(['user' => $user], 'User retrieved successfully.');
//    }
//
//    /**
//     * Update the specified User in storage.
//     *
//     * @param  User  $user
//     * @param  UpdateUserRequest  $request
//     *
//     * @return Response
//     */
//    public function update(User $user, UpdateUserRequest $request)
//    {
//        if ($user->is_system) {
//            return $this->sendError('You can not update system generated user.');
//        }
//
//        $input = $this->validateInput($request->all());
//        $this->userRepository->update($input, $user->id);
//
//        return $this->sendSuccess('User updated successfully.');
//    }
//
//    /**
//     * @param  Request  $request
//     *
//     * @return JsonResponse
//     */
//    public function updateLanguage(Request $request)
//    {
//        $language = $request->get('languageName');
//
//        /** @var User $user */
//        $user = getLoggedInUser();
//        $user->update(['language' => $language]);
//
//        return $this->sendSuccess('Language updated successfully.');
//    }
//
//    /**
//     * Remove the specified User from storage.
//     *
//     * @param User $user
//     *
//     * @throws Exception
//     *
//     * @return JsonResponse
//     */
//    public function archiveUser(User $user)
//    {
//        if ($user->is_system) {
//            return $this->sendError('You can not archive system generated user.');
//        }
//        $this->userRepository->delete($user->id);
//
//        return $this->sendSuccess('User archived successfully.');
//    }
//
//    /**
//     * Remove the specified User from storage.
//     *
//     * @param Request $request
//     *
//     * @return JsonResponse
//     */
//    public function restoreUser(Request $request)
//    {
//        $id = $request->get('id');
//        $this->userRepository->restore($id);
//
//        return $this->sendSuccess('User restored successfully.');
//    }
//
//    /**
//     * Remove the specified User from storage.
//     *
//     * @param int $id
//     *
//     * @throws Exception
//     *
//     * @return JsonResponse
//     */
//    public function destroy($id)
//    {
//        $user = User::withTrashed()->whereId($id)->first();
//        if ($user->is_system) {
//            return $this->sendError('You can not delete system generated user.');
//        }
//        $this->userRepository->deleteUser($user->id);
//
//        return $this->sendSuccess('User deleted successfully.');
//    }
//
//    /**
//     * @param  User  $user
//     *
//     * @return JsonResponse
//     */
//    public function activeDeActiveUser(User $user)
//    {
//        $this->userRepository->checkUserItSelf($user->id);
//        $this->userRepository->activeDeActiveUser($user->id);
//
//        return $this->sendSuccess('User updated successfully.');
//    }
//
//    /**
//     * @param $input
//     *
//     * @return mixed
//     */
//    public function validateInput($input)
//    {
//        if (isset($input['password']) && ! empty($input['password'])) {
//            $input['password'] = Hash::make($input['password']);
//        } else {
//            unset($input['password']);
//        }
//
//        $input['is_active'] = (! empty($input['is_active'])) ? 1 : 0;
//
//        return $input;
//    }
//
//    /**
//     * @param  User  $user
//     *
//     * @return Application|RedirectResponse|Redirector
//     */
//    public function userImpersonateLogin(User $user)
//    {
//        Auth::user()->impersonate($user);
//
//        if (\Auth::check() && \Auth::user()->hasPermissionTo('manage_conversations')){
//            return redirect(url('/conversations'));
//        }elseif (\Auth::check()) {
//            if (\Auth::user()->getAllPermissions()->count() > 0) {
//                $url = getPermissionWiseRedirectTo(\Auth::user()->getAllPermissions()->first());
//
//                return redirect(url($url));
//            }else{
//                return redirect(url('/conversations'));
//            }
//        }
//    }
//
//    /**
//     * @return Application|RedirectResponse|Redirector
//     */
//    public function userImpersonateLogout()
//    {
//        Auth::user()->leaveImpersonation();
//
//        return redirect(url('/conversations'));
//    }
//
//    /**
//     * @param  User  $user
//     *
//     * @return JsonResponse
//     */
//    public function isEmailVerified(User $user)
//    {
//        $emailVerified = $user->email_verified_at == null ? Carbon::now() : null;
//        $user->update(['email_verified_at' => $emailVerified]);
//
//        return $this->sendSuccess('Email Verified successfully.');
//    }
//}
