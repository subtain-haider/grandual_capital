<?php

use App\Models\Account;
use App\Models\Affiliation;
use App\Models\Conversation;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use App\Repositories\NotificationRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Http;

/**
 * @return int
 */
function getLoggedInUserId()
{
    return Auth::id();
}

/**
 * @return string[]
 */
function getUserLanguages()
{
    return User::LANGUAGES;
}

/**
 * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
 */
function getCurrentLanguageName()
{
    return User::whereId(Auth::id())->first()->language;
}

/**
 * @return User
 */
function getLoggedInUser()
{
    return Auth::user();
}

function detectURL($url)
{
    if (strpos($url, 'youtube.com/watch?v=') > 0) {
        return Conversation::YOUTUBE_URL;
    }

    return 0;
}

function isValidURL($url)
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

function getDefaultAvatar()
{
    return asset('assets/images/avatar.png');
}

/**
 * return random color.
 *
 * @param  int  $userId
 *
 * @return string
 */
function getRandomColor($userId)
{
    $colors = ['329af0', 'fc6369', 'ffaa2e', '42c9af', '7d68f0'];
    $index = $userId % 5;

    return $colors[$index];
}

/**
 * return avatar url.
 *
 * @return string
 */
function getAvatarUrl()
{
    return 'https://ui-avatars.com/api/';
}

/**
 * return avatar full url.
 *
 * @param  int  $userId
 * @param  string  $name
 *
 * @return string
 */
function getUserImageInitial($userId, $name)
{
    return getAvatarUrl()."?name=$name&size=100&rounded=true&color=fff&background=".getRandomColor($userId);
}

/**
 * @return array
 */
function getNotifications()
{
    /** @var NotificationRepository $notificationRepo */
    $notificationRepo = app(NotificationRepository::class);

    return $notificationRepo->getNotifications();
}

/**
 * @return mixed|string
 */
function getAppName()
{
    static $appNameSetting;

    if (! empty($appNameSetting)) {
        return $appNameSetting;
    }

    $record = Setting::where('key', '=', 'app_name')->first();
    $appNameSetting = (! empty($record)) ? $record->value : config('app.name');

    return $appNameSetting;
}

/**
 * @return mixed|string
 */
function getCompanyName()
{
    static $companyName;

    if (! empty($companyName)) {
        return $companyName;
    }

    $record = Setting::where('key', '=', 'company_name')->first();
    $companyName = (! empty($record)) ? $record->value : config('app.name');

    return config('app.name');
}

/**
 * @return string
 */
function getLogoUrl()
{
    static $logoURL;

    if (! empty($logoURL)) {
        return $logoURL;
    }

    $setting = Setting::where('key', '=', 'logo_url')->first();
    $logoURL = (! empty($setting) && ! empty($setting->value)) ? app(Setting::class)->getLogoUrl($setting->value) : asset('assets/images/logo.png');

    return $logoURL;
}

/**
 * @return string
 */
function getThumbLogoUrl()
{
    static $thumbLogo;

    if (! empty($thumbLogo)) {
        return $thumbLogo;
    }

    $setting = Setting::where('key', '=', 'logo_url')->first();
    $thumbLogo = (! empty($setting) && ! empty($setting->value)) ? app(Setting::class)->getLogoUrl($setting->value,
        Setting::THUMB_PATH) : asset('assets/images/logo-30x30.png');

    return $thumbLogo;
}

/**
 * @return string
 */
function getFaviconUrl()
{
    static $favicon;

    if (! empty($favicon)) {
        return $favicon;
    }

    $setting = Setting::where('key', '=', 'favicon_url')->first();
    $favicon = (! empty($setting) && ! empty($setting->value)) ? asset($setting->value) : asset('assets/images/favicon/favicon-16x16.ico');

    return $favicon;
}

/**
 * @return int|mixed
 */
function isGroupChatEnabled()
{
    static $groupChatEnabled;

    if (isset($groupChatEnabled)) {
        return $groupChatEnabled;
    }

    $setting = Setting::where('key', '=', 'enable_group_chat')->first();
    $groupChatEnabled = ! empty($setting) ? $setting->value : true;

    return $groupChatEnabled;
}

/**
 * @return int|mixed
 */
function canMemberAddGroup()
{
    static $membersCanAddGroup;

    if (isset($membersCanAddGroup)) {
        return $membersCanAddGroup;
    }

    $setting = Setting::where('key', '=', 'members_can_add_group')->first();
    $membersCanAddGroup = ! empty($setting) ? $setting->value : true;

    return $membersCanAddGroup;
}

/**
 * @return bool
 */
function checkUserStatusForGroupMember($userStatus)
{
    return ($userStatus != null) ? true : false;
}

/**
 * @param int $gender
 *
 * @return string
 */
function getGender($gender)
{
    if ($gender == 1) {
        return 'male';
    }
    if ($gender == 2) {
        return 'female';
    }

    return '';
}

/**
 * @param int $status
 *
 * @return string
 */
function getOnOffClass($status)
{
    if ($status == 1) {
        return 'online';
    }

    return 'offline';
}

/**
 * @return array
 */
function getTimeZone()
{
    return DateTimeZone::listIdentifiers();
}

/**
 * @param $data
 *
 * @return Application|UrlGenerator|string
 */
function getPermissionWiseRedirectTo($data)
{
    $redirect = '/conversations';

    if ($data->name == 'manage_users') {
        $redirect = url('/users');
    } elseif ($data->name == 'manage_roles') {
        $redirect = '/roles';
    } elseif ($data->name == 'manage_reported_users') {
        $redirect = '/reported-users';
    } elseif ($data->name == 'manage_meetings') {
        $redirect = '/meetings';
    } elseif ($data->name == 'manage_settings') {
        $redirect = '/settings';
    }

    return $redirect;
}

function getNotificationSound()
{
    /** @var Setting $setting */
    $setting = Setting::where('key', 'notification_sound')->pluck('value', 'key')->toArray();
    $notification_sound = [];
    if (isset($setting['notification_sound'])) {
        $notification_sound = app(Setting::class)->getNotificationSound($setting['notification_sound']);
    }
    
    return $notification_sound;
}
function account_key_file($accounts){
    $txt = '';
    foreach ($accounts as $account){
        if (!empty($account->account)){
            $txt = $txt. "\n". $account->account.':GrandeurCapital'.'@'.$account->user->expires_at.'.'.$account->user->email;
        }
    }
    $myfile = fopen(public_path('/')."/accountDetail.key", "w") or die("Unable to open file!");
    fwrite($myfile, $txt);
    fclose($myfile);
}

function user_subscribe_helper($user_id, $subscription_id){
    $user = User::find($user_id);
    $subscription = Subscription::find($subscription_id);
    $affiliation = Affiliation::first();

    $a_user = User::where('ref_id', $user->ref_by )->first();
    $a_user_sub = $a_user->subscription_id;
    // return $a_user_sub_check;
    if ($a_user_sub){
        $a_user_sub_check = Subscription::find($a_user_sub);
        $a_user_sub_A = $a_user_sub_check ->affiliate;
        if ($a_user_sub_A == "Yes") {
            $amount = ($subscription->price * $affiliation->percentage) / 100;
            $amount = $a_user->a_cash + $amount;
            $a_user->update([
                'a_cash' => $amount,
            ]);
        }
    }


    $expires_at = Carbon::now()->addMonths($subscription->name);


//        $user->accounts()->delete();
    $subscription_accounts = $subscription->account;
    $user_accounts = 0;
    if ($user->p_subscription_id){
        $all_accounts = $user->accounts()->where('subscription_id',$user->p_subscription_id)->get();
        $user_accounts = count($all_accounts);
    }

    if ($user_accounts < $subscription_accounts){
        $difference = $subscription_accounts - $user_accounts ;
        for ($x=1; $x<=$difference; $x++){
            $user->accounts()->create([
                'number' => $x,
                'subscription_id' => $subscription_id
            ]);
        }
        foreach ($all_accounts as $account){
            $account->update(['subscription_id' => $subscription]);
        }
    }elseif ($user_accounts > $subscription_accounts){
        $del_accounts = $user->accounts->where('subscription_id',$user->p_subscription_id)->slice($subscription_accounts);
        foreach ($del_accounts as $del){
            $del->delete();
        }
    }
    $user->update([
        'p_subscription_id' => $subscription_id,
        'expires_at' => $expires_at->format('Y.m.d')
    ]);

    $accounts = Account::all();
    account_key_file($accounts);
}

function cryptochill_api_payout($endpoint, $payload = [], $method = 'GET'){
    $API_URL = 'https://api.cryptochill.com';
    $API_KEY = env('p_api_key');
    $API_SECRET = env('p_api_secret');

    $request_path = '/v1/' . $endpoint . '/';
    $payload['request'] = $request_path;
    $payload['nonce'] = round(microtime(true) * 10000);

    // Encode payload to base64 format and create signature using your API_SECRET
    $encoded_payload = json_encode($payload);
    $b64 = base64_encode($encoded_payload);
    $signature = hash_hmac('sha256', $b64, $API_SECRET);

    // Add your API key, encoded payload and signature to following headers
    $request_headers = [
        'X-CC-KEY' => $API_KEY,
        'X-CC-PAYLOAD' => $b64,
        'X-CC-SIGNATURE' => $signature,
    ];

    $data = [
        'method' => $method,
        'url' => $API_URL . $request_path,
        'headers' => $request_headers
    ];

    if ($data['method'] == 'GET'){
        return Http::withHeaders($data['headers'])->get($data['url']);
    }
    elseif ($data['method'] == 'POST'){
        return Http::withHeaders($data['headers'])->post($data['url'], $payload);
    }

}