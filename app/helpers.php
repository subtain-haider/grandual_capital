<?php

use App\Models\Conversation;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\NotificationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;

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