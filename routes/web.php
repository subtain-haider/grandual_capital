<?php

use App\Http\Controllers\API;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ReportUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Database\Seeders\CreatePermissionSeeder;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Http\Controllers\MyController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AttachController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\Admin\CP_Controller;
use App\Http\Controllers\AjaxUploadController;
use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Admin\CP_UserController;

// Control panel
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\VideoCategoryController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\UserSubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
Route::get('/home', function () {
    return view('home');
})->name('home');
*/
Route::view('/terms', 'terms')->name('terms');
Route::view('/privacy', 'privacy')->name('privacy');
//Route::get('/terms', function (Request $request) {
////    $stripeCustomer = $request->user()->createAsStripeCustomer();
//    return url('/').'/terms.docx';
//});
Route::get('/billing-portal', function (Request $request) {
//    $stripeCustomer = $request->user()->createAsStripeCustomer();
    return $request->user()->redirectToBillingPortal();
});

Route::get('/paypal_modal/{subscription_id}', [\App\Http\Controllers\SubscriptionController::class, 'paypal_modal'])->name('paypal_modal');
Route::post('/paypal_modal_success', [\App\Http\Controllers\SubscriptionController::class, 'paypal_modal_success'])->name('paypal_modal_success');
Route::post('/checkout_session', [\App\Http\Controllers\HomeController::class, 'checkoutsession'])->name('checkoutsession');
Route::get('/subscription_success', [\App\Http\Controllers\HomeController::class, 'subscription_success'])->name('subscription_success');

Route::post('bitcoin_success', [HomeController::class, 'bitcoin_success'])->name('bitcoin_success');
Route::post('setting_update', [HomeController::class, 'setting_update'])->name('setting_update');
Route::post('paypal_update', [PaymentMethodsController::class, 'paypal_update'])->name('setting_update');

Route::get('handle-payment/{sub}', [PayPalPaymentController::class, 'handlePayment'])->name('make.payment');
Route::get('handle-payment/{sub}', [PayPalPaymentController::class, 'handlePayment'])->name('make.payment');
Route::get('cancel-payment', [PayPalPaymentController::class, 'paymentCancel'])->name('cancel.payment');
Route::get('payment-success', [PayPalPaymentController::class, 'paymentSuccess'])->name('success.payment');

Route::get('product/{id}', [ProductController::class, 'product']);
Route::get('allproducts', [ProductController::class, 'products']);
Route::get('f_products', [ProductController::class, 'f_products']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('user')->middleware(['auth'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'userDashboard'])->name('home');
    Route::get('withdraws', [WithdrawController::class, 'user_withdraws'])->name('user_withdraws');
    Route::get('new_withdraws', [WithdrawController::class, 'new_withdraws'])->name('new_withdraws');
    Route::post('new_withdraws', [WithdrawController::class, 'post_new_withdraws'])->name('post_new_withdraws');
    Route::resource('profile', UserProfileController::class);
    Route::resource('subscription', UserSubscriptionController::class);
    Route::get('subscribe/{user_id}/{package_id}', [UserSubscriptionController::class, 'user_subscription']);

    Route::get('accounts', [AccountController::class, 'user_accounts']);
    Route::post('accounts', [AccountController::class, 'user_accounts_post']);


    //Payment Controller
    Route::post('payment', [PaymentController::class, 'payment']);

    Route::get('product', [UserProductController::class, 'index']);

    Route::get('/video', [VideoController::class, 'user_video'])->name('user.video');


});
Route::get('/group_chat', [HomeController::class, 'group_chat']);
Route::get('/group_meetings', [HomeController::class, 'group_meetings']);

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('account/edit/{id}', [AccountController::class, 'admin_account_edit']);
    Route::post('account/update', [AccountController::class, 'admin_account_update']);
    Route::get('withdraws', [WithdrawController::class, 'admin_withdraws'])->name('admin_withdraws');
    Route::get('withdraw_approve/{id}', [WithdrawController::class, 'withdraw_approve'])->name('withdraw_approve');
    Route::get('withdraw_reject/{id}', [WithdrawController::class, 'withdraw_reject'])->name('withdraw_reject');

    Route::get('withdraws/types', [WithdrawController::class, 'withdrawsTypes'])->name('withdraws.types');
    Route::get('withdraws/types/add', [WithdrawController::class, 'withdrawsTypesAdd'])->name('withdraws.types.add');
    Route::any('withdraws/types/delete/{id}', [WithdrawController::class, 'withdrawsTypesdestroy'])->name('withdraws.types.delete');
    Route::post('withdraws/types/store', [WithdrawController::class, 'withdrawsTypesstore'])->name('withdraws.types.store');
    Route::post('withdraws/types/status', [WithdrawController::class, 'withdrawsTypesStatus'])->name('withdraws.types.status');

    // View Redirect Route For Admin
    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin_accounts', [AccountController::class, 'admin_accounts']);


    Route::get('/front', [FrontController::class, 'front']);
    Route::post('/front_post', [FrontController::class, 'front_post']);

    Route::post('/product/image/upload', [ProductController::class, 'image_upload']);

    // Admin product controller
    Route::resource('products', ProductController::class);


    // Admin category controller
    Route::resource('category', CategoryController::class);

    // Admin Video category controller
    Route::get('/videoCategory', [VideoCategoryController::class, 'index'])->name('admin.videoCategory');
    Route::get('/videoCategory/create', [VideoCategoryController::class, 'create'])->name('admin.videoCategory.create');
    Route::post('/videoCategory/store', [VideoCategoryController::class, 'store'])->name('admin.videoCategory.store');
    Route::get('/videoCategory/edit/{id}', [VideoCategoryController::class, 'edit'])->name('admin.videoCategory.edit');
    Route::put('/videoCategory/update/{id}', [VideoCategoryController::class, 'update'])->name('admin.videoCategory.update');
    Route::delete('/videoCategory/destroy/{id}', [VideoCategoryController::class, 'destroy'])->name('admin.videoCategory.destroy');

    // Admin Video  controller
    Route::get('/video', [VideoController::class, 'index'])->name('admin.video');
    Route::get('/video/create', [VideoController::class, 'create'])->name('admin.video.create');
    Route::post('/video/store', [VideoController::class, 'store'])->name('admin.video.store');
    Route::get('/video/edit/{id}', [VideoController::class, 'edit'])->name('admin.video.edit');
    Route::put('/video/update/{id}', [VideoController::class, 'update'])->name('admin.video.update');
    Route::delete('/video/destroy/{id}', [VideoController::class, 'destroy'])->name('admin.video.destroy');

    // Admin profile controller
    Route::resource('profile', ProfileController::class);

    // User working here start
    Route::get('a_users', [UserController::class, 'index']);
    Route::get('users/edit/{id}', [UserController::class, 'edit']);
    Route::post('users/update/{id}', [UserController::class, 'update']);
    Route::post('users/destroy/{id}', [UserController::class, 'destroy']);
    // User working here end

    // Admin subscription package controller
    Route::resource('subscription', SubscriptionController::class);


    Route::get('affiliation', [AffiliationController::class, 'affiliation']);

    Route::post('affiliation', [AffiliationController::class, 'update']);

    // Route::get('users', [UserController::class, 'index']);

    Route::resource('payment_methods', PaymentMethodsController::class);

});


// Payment routes

// Paypal
Route::get('payment', [PayPalController::class,'payment'])->name('payment');
Route::get('cancel', [PayPalController::class,'cancel'])->name('payment.cancel');
Route::get('payment/success', [PayPalController::class,'success'])->name('payment.success');


// Stripe
Route::get('stripe', [StripePaymentController::class,'stripe']);
Route::post('stripe', [StripePaymentController::class,'stripePost'])->name('stripe.post');





// FORUMS
Route::get('/forums', [IndexController::class, 'index'])->name('index');
Route::get('/home', [IndexController::class, 'index'])->name('home');

//Forums and topics
Route::any('/category/{get_forum_id}', [IndexController::class, 'forum'])->where('get_forum_id', '[0-9]+')->name('forum');
Route::any('/addtopic/{get_forum_id}', [IndexController::class, 'addtopic'])->where('get_forum_id', '[0-9]+')->name('addtopic');

Route::any('/etopic/{id}', [TopicController::class, 'Edit_Topic'])->where('id', '[0-9]+')->name('EditTopic');
Route::any('/topic/{id}', [TopicController::class, 'showTopic'])->name('showtopic');
Route::get('/topic/close/{id}', [TopicController::class, 'CloseTopic'])->name('close_topic');
Route::get('/topic/open/{id}', [TopicController::class, 'OpenTopic'])->name('open_topic');

Route::any('/editpost/{postid}', [TopicController::class, 'EditPost'])->where('postid', '[0-9]+')->name('edit_post');
Route::get('/delete_post/{postid}', [TopicController::class, 'DeletePost'])->where('postid', '[0-9]+')->name('delete_post');
Route::post('/movetopic', [TopicController::class, 'MoveTopic'])->name('move_topic');
Route::post('/deletetopic', [TopicController::class, 'DeleteTopic'])->name('delete_topic');
Route::post('/answerpoll', [TopicController::class, 'answer_poll'])->name('answer_poll');

// react to post
Route::post('/data/post/react', [TopicController::class, 'React'])->name('react_action');


//File uploads
Route::post('/ajax_upload/action', [AjaxUploadController::class, 'action'])->name('ajaxupload.action');
Route::any('/ajax_upload/action/second', [AjaxUploadController::class, 'UploadAction'])->name('UploadAction');

Route::post('/ajax_upload/rm', [AjaxUploadController::class, 'dell_attachment'])->name('delete.attach');
Route::get('/download/{filename}/{thefile}', [AjaxUploadController::class, 'download'])->name('download_file');


//Tags
Route::any('/tags', [UserController::class, 'showTags'])->name('get_users');
Route::any('/tags.json', [UserController::class, 'getUserTags'])->name('user_tags_json');

//Routes though 'my' prefic
Route::prefix('my')->group(function () {

    Route::get('/',[MyController::class, 'myhome']);
    Route::any('/settings/{subpage?}',[MyController::class, 'settings'])->name('mysettings');

    Route::get('/tn',[MyController::class, 'check_notifications'])->name('total_notifications');
    Route::get('/mnjson',[MyController::class, 'load_notifications_json'])->name('my_notifications_json');
    Route::get('/upa', [AjaxUploadController::class, 'upa']);
    Route::post('/upload_avatar', [AjaxUploadController::class, 'upavatar'])->name('upavatar.action');
    Route::any('/notifications',[MyController::class, 'MyNotifications'])->name('MyNotifications');
    Route::get('/notifications/data',[MyController::class, 'page_notifications_json'])->name('page_notifications_json');

    Route::any('/pm/data/{thing}',[MyController::class, 'MyMessagesData'])->name('messages_data');
    Route::any('/senddata',[MyController::class, 'SendPM'])->name('SendPM');
});

// pm/messages or pm/contact
Route::get('pm/{thing?}/{id?}',[MyController::class, 'MyMessages'])->where('id', '[0-9]+')->name('messages');

//Go trough notification
Route::get('/redirect/{id}',[MyController::class, 'see_notification'])->name('see_notification');

//User
Route::prefix('user')->group(function () {
    Route::any('/{id}',[UserController::class, 'profile'])->where('id', '[0-9]+')->name('user_profile');
    Route::any('/{id}/settings/{subpage?}',[UserController::class, 'settings'])->name('UserModSettings');
});

Route::get('/users',[UserController::class, 'MemberList'])->name('member_list');
Route::get('/rules', [IndexController::class, 'rules'])->name('show_rules');
Route::get('/about', [IndexController::class, 'About'])->name('about_us');
Route::get('/staff', [UserController::class, 'staff'])->name('show_staffs');
Route::get('/banlist', [UserController::class, 'BanList'])->name('show_banlist');
Route::get('/search/{thing?}/{word?}/{sort?}/{cat?}', [SearchController::class, 'Search'])->where('thing', '[0-9]+')->where('sort', '[0-9]+')->where('cat', '[0-9]+')->name('Search_page');

Route::any('/help', [IndexController::class, 'HelpForm'])->name('HelpForm.contact');


Route::prefix('admin')->group(function () {
    Route::get('/', [CP_Controller::class, 'index'])->name('dashboard');
    Route::any('/about', [CP_Controller::class, 'AboutUs'])->name('admin.aboutus');
    Route::any('/therms', [CP_Controller::class, 'Therms'])->name('admin.therms');
    Route::get('/categories', [CP_Controller::class, 'Categories'])->name('admin.categories');
    Route::any('/categories/add', [CP_Controller::class, 'CategoryAdd'])->name('admin.categories.add');
    Route::any('/categories/edit/{id}', [CP_Controller::class, 'CategoryEdit'])->name('admin.categories.edit');
    Route::any('/categories/delete/{id}', [CP_Controller::class, 'CategoryDelete'])->name('admin.categories.delete');
    Route::any('/announcement', [CP_Controller::class, 'AnnouncementEdit'])->name('admin.announcement.edit');

    // ADS
    Route::any('/ads/footer', [CP_Controller::class, 'AdsFooter'])->name('admin.ads.footer');
    Route::any('/ads/sidebar', [CP_Controller::class, 'AdsSidebar'])->name('admin.ads.sidebar');
    Route::any('/ads/main', [CP_Controller::class, 'AdsMain'])->name('admin.ads.main');

    // users
    Route::get('/users',[CP_UserController::class, 'Members'])->name('admin.members.all');
    Route::get('/users/admins',[CP_UserController::class, 'MembersAdmins'])->name('admin.members.admins');
    Route::get('/users/moders',[CP_UserController::class, 'MembersModers'])->name('admin.members.moders');
    Route::get('/users/moders/global',[CP_UserController::class, 'MembersModersGlobal'])->name('admin.members.globalmoders');
    Route::get('/users/moders/disabled',[CP_UserController::class, 'MembersDisabled'])->name('admin.members.disabled');
    Route::get('/users/banned',[CP_UserController::class, 'MembersBanned'])->name('admin.members.banneds');
    Route::any('/users/delete/{id}',[CP_UserController::class, 'MemberDelete'])->name('admin.member.delete');

    // Support
    Route::get('/support/all', [CP_Controller::class, 'SupportMain'])->name('admin.support');
    Route::get('/support/unread', [CP_Controller::class, 'SupportUnreads'])->name('admin.support.unread');
    Route::get('/support/under-reviewing', [CP_Controller::class, 'SupportUnderReviewing'])->name('admin.support.underreviewing');
    Route::get('/support/completed', [CP_Controller::class, 'SupportCompleted'])->name('admin.support.completed');
    Route::any('/support/viewreport/{id}', [CP_Controller::class, 'SupportViewReport'])->name('admin.support.viewreport');
    Route::get('/support/viewreport/{id}/complete', [CP_Controller::class, 'SupportViewReportComplete'])->name('admin.support.viewreport_complete');
    Route::post('/support/reports/complete', [CP_Controller::class, 'ReportCompleteSelected'])->name('admin.support.report_completeSelected');
    Route::post('/support/reports/delete', [CP_Controller::class, 'ReportDeleteSelected'])->name('admin.support.report_deleteSelected');
    Route::get('/support/viewreport/{id}/delete', [CP_Controller::class, 'SupportViewReportDelete'])->name('admin.support.delete');

    Route::any('/storage', [CP_Controller::class, 'StorageClass'])->name('admin.storage');
    Route::post('/upload_action', [CP_Controller::class, 'Upload_action'])->name('admin.ajaxupload.action');
    Route::get('/storage/{id}/delete', [CP_Controller::class, 'StorageDeleteFile'])->name('admin.storage.deletefile');

    Route::any('/optimisation', [CP_Controller::class, 'Optimisation'])->name('admin.optimisation');
    Route::post('/optimisation/actions/clean/posts', [CP_Controller::class, 'Trash_Clear'])->name('admin.Trash_Clear');

    // options
    Route::any('/options/ban_durations', [CP_Controller::class, 'OptionBanDurations'])->name('admin.option.bandurations');
    Route::any('/options/ban_durations/add', [CP_Controller::class, 'OptionBanDurations_add'])->name('admin.option.bandurations_add');
    Route::any('/options/ban_durations/{id}/edit', [CP_Controller::class, 'OptionBanDurations_edit'])->name('admin.option.bandurations_edit');
    Route::get('/options/ban_durations/{id}/delete', [CP_Controller::class, 'OptionBanDurations_delete'])->name('admin.option.bandurations_delete');


    Route::get('/options/social_shortcuts', [CP_Controller::class, 'OptionSocialShortcuts'])->name('admin.option.social_shortcuts');
    Route::any('/options/social_shortcuts/add', [CP_Controller::class, 'OptionSocialShortcutsAdd'])->name('admin.option.social_shortcuts.add');
    Route::any('/options/social_shortcuts/{id}/edit', [CP_Controller::class, 'OptionSocialShortcutsEdit'])->name('admin.option.social_shortcuts.edit');
    Route::get('/options/social_shortcuts/{id}/delete', [CP_Controller::class, 'OptionSocialShortcutsDelete'])->name('admin.option.social_shortcuts.delete');

    Route::get('/options/stickers', [CP_Controller::class, 'OptionStickers'])->name('admin.option.stickers');
    Route::any('/options/stickers/add', [CP_Controller::class, 'OptionStickersAdd'])->name('admin.option.stickers.add');
    Route::any('/options/stickers/{id}/edit', [CP_Controller::class, 'OptionStickersEdit'])->name('admin.option.stickers.edit');
    Route::get('/options/stickers/{id}/delete', [CP_Controller::class, 'OptionStickersDelete'])->name('admin.option.stickers.delete');

    Route::any('/options/general', [CP_Controller::class, 'OptionGeneral'])->name('admin.option.general');
    Route::any('/options/seo', [CP_Controller::class, 'OptionSeo'])->name('admin.option.seo');


});

//Route::get('/', function () {
//    return view('home.index');
//});

Route::get('upgrade-to-v3-4-0', function () {
    try {
        \Artisan::call('migrate', [
            '--path'  => '/database/migrations/2020_10_19_133700_move_all_existing_devices_to_new_table.php',
            '--force' => true,
        ]);

        return 'You are successfully migrated to v3.4.0';
    } catch (Exception $exception) {
        return $exception->getMessage();
    }
});

Route::get('/upgrade-to-v4-3-0', function () {
    try {
        Artisan::call('db:seed', ['--class' => 'CreatePermissionSeeder']);

        return 'You are successfully seeded to v4.3.0';
    } catch (Exception $exception) {
        return $exception->getMessage();
    }
});

Route::get('upgrade-to-v5-0-0', function () {
    try {
        \Artisan::call('migrate', [
            '--path'  => '/database/migrations/2021_07_12_000000_add_uuid_to_failed_jobs_table.php',
            '--force' => true,
        ]);

        return 'You are successfully migrated to v5.0.0';
    } catch (Exception $exception) {
        return $exception->getMessage();
    }
});

Auth::routes();
Route::get('activate', [AuthController::class, 'verifyAccount']);

Route::get('/home', [HomeController::class, 'index']);
Route::post('update-language', [UserController::class, 'updateLanguage'])->middleware('auth');

// Impersonate Logout
Route::get('/users/impersonate-logout', [UserController::class, 'userImpersonateLogout'])->name('impersonate.userLogout');

Route::group(['middleware' => ['user.activated', 'auth']], function () {
    //view routes
    Route::get('/conversations',
        [ChatController::class, 'index'])->name('conversations')->middleware('permission:manage_conversations');
    Route::get('profile', [UserController::class, 'getProfile']);
    Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

    //get all user list for chat
    Route::get('users-list', [API\UserAPIController::class, 'getUsersList']);
    Route::get('get-users', [API\UserAPIController::class, 'getUsers']);
    Route::delete('remove-profile-image', [API\UserAPIController::class, 'removeProfileImage']);
    /** Change password */
    Route::post('change-password', [API\UserAPIController::class, 'changePassword']);
    Route::get('conversations/{ownerId}/archive-chat', [API\UserAPIController::class, 'archiveChat']);

    Route::get('get-profile', [API\UserAPIController::class, 'getProfile']);
    Route::post('profile', [API\UserAPIController::class, 'updateProfile'])->name('update.profile');
    Route::post('update-last-seen', [API\UserAPIController::class, 'updateLastSeen']);

    Route::post('send-message',
        [API\ChatAPIController::class, 'sendMessage'])->name('conversations.store')->middleware('sendMessage');
    Route::get('users/{id}/conversation', [API\UserAPIController::class, 'getConversation']);
    Route::get('conversations-list', [API\ChatAPIController::class, 'getLatestConversations']);
    Route::get('archive-conversations', [API\ChatAPIController::class, 'getArchiveConversations']);
    Route::post('read-message', [API\ChatAPIController::class, 'updateConversationStatus']);
    Route::post('file-upload', [API\ChatAPIController::class, 'addAttachment'])->name('file-upload');
    Route::post('image-upload', [API\ChatAPIController::class, 'imageUpload'])->name('image-upload');
    Route::get('conversations/{userId}/delete', [API\ChatAPIController::class, 'deleteConversation']);
    Route::post('conversations/message/{conversation}/delete', [API\ChatAPIController::class, 'deleteMessage']);
    Route::post('conversations/{conversation}/delete', [API\ChatAPIController::class, 'deleteMessageForEveryone']);
    Route::get('/conversations/{conversation}', [API\ChatAPIController::class, 'show']);
    Route::post('send-chat-request', [API\ChatAPIController::class, 'sendChatRequest'])->name('send-chat-request');
    Route::post('accept-chat-request',
        [API\ChatAPIController::class, 'acceptChatRequest'])->name('accept-chat-request');
    Route::post('decline-chat-request',
        [API\ChatAPIController::class, 'declineChatRequest'])->name('decline-chat-request');

    /** Web Notifications */
    Route::put('update-web-notifications', [API\UserAPIController::class, 'updateNotification']);

    /** BLock-Unblock User */
    Route::put('users/{user}/block-unblock', [API\BlockUserAPIController::class, 'blockUnblockUser']);
    Route::get('blocked-users', [API\BlockUserAPIController::class, 'blockedUsers']);

    /** My Contacts */
    Route::get('my-contacts', [API\UserAPIController::class, 'myContacts'])->name('my-contacts');

    /** Groups API */
    Route::post('groups', [API\GroupAPIController::class, 'create']);
    Route::post('groups/{group}', [API\GroupAPIController::class, 'update']);
    Route::get('groups', [API\GroupAPIController::class, 'index']);
    Route::get('groups/{group}', [API\GroupAPIController::class, 'show']);
    Route::put('groups/{group}/add-members', [API\GroupAPIController::class, 'addMembers']);
    Route::delete('groups/{group}/members/{user}', [API\GroupAPIController::class, 'removeMemberFromGroup']);
    Route::delete('groups/{group}/leave', [API\GroupAPIController::class, 'leaveGroup']);
    Route::delete('groups/{group}/remove', [API\GroupAPIController::class, 'removeGroup']);
    Route::put('groups/{group}/members/{user}/make-admin', [API\GroupAPIController::class, 'makeAdmin']);
    Route::put('groups/{group}/members/{user}/dismiss-as-admin', [API\GroupAPIController::class, 'dismissAsAdmin']);
    Route::get('users-blocked-by-me', [API\BlockUserAPIController::class, 'blockUsersByMe']);

    Route::get('notification/{notification}/read', [API\NotificationController::class, 'readNotification']);
    Route::get('notification/read-all', [API\NotificationController::class, 'readAllNotification']);

    /** Web Notifications */
    Route::put('update-web-notifications', [API\UserAPIController::class, 'updateNotification']);
    Route::put('update-player-id', [API\UserAPIController::class, 'updatePlayerId']);
    //set user custom status route
    Route::post('set-user-status', [API\UserAPIController::class, 'setUserCustomStatus'])->name('set-user-status');
    Route::get('clear-user-status', [API\UserAPIController::class, 'clearUserCustomStatus'])->name('clear-user-status');

    //report user
    Route::post('report-user', [API\ReportUserController::class, 'store'])->name('report-user.store');
});

// users
Route::group(['middleware' => ['permission:manage_users', 'auth', 'user.activated']], function () {
    Route::resource('users', UserController::class);
    Route::post('users/{user}/active-de-active', [UserController::class, 'activeDeActiveUser'])
        ->name('active-de-active-user');
    Route::post('users/{user}/update', [UserController::class, 'update']);
    Route::delete('users/{user}/archive', [UserController::class, 'archiveUser']);
    Route::post('users/restore', [UserController::class, 'restoreUser']);
    Route::get('users/{user}/login', [UserController::class, 'userImpersonateLogin']);
    Route::post('users/{user}/email-verified', [UserController::class, 'isEmailVerified'])->name('user.email-verified');
});

// roles
Route::group(['middleware' => ['permission:manage_roles', 'auth', 'user.activated']], function () {
    Route::resource('roles', RoleController::class)->except('update');
    Route::post('roles/{role}/update', [RoleController::class, 'update'])->name('roles.update');
});

// settings
Route::group(['middleware' => ['permission:manage_settings', 'auth', 'user.activated']], function () {
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
});

// reported-users
Route::group(['middleware' => ['permission:manage_reported_users', 'auth', 'user.activated']], function () {
    Route::resource('reported-users', ReportUserController::class);
});

// meetings
Route::group(['middleware' => ['permission:manage_meetings', 'auth', 'user.activated']], function () {
    Route::resource('meetings', MeetingController::class);
    Route::get('meetings/{meeting}/change-status', [MeetingController::class, 'changeMeetingStatus']);
});

Route::group(['middleware' => ['permission:manage_meetings', 'auth', 'user.activated']], function () {
    Route::get('member/meetings', [MeetingController::class, 'showMemberMeetings'])->name('meetings.member_index');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('login/{provider}', [\App\Http\Controllers\Auth\SocialAuthController::class, 'redirect']);
    Route::get('login/{provider}/callback', [\App\Http\Controllers\Auth\SocialAuthController::class, 'callback']);
});
