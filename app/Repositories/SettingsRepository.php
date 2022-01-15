<?php

namespace App\Repositories;

use App\Exceptions\ApiOperationFailedException;
use App\Models\Setting;
use App\Traits\ImageTrait;
use Arr;
use Exception;
use Illuminate\Support\Collection;
use Image;
use Storage;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class SettingsRepository.
 */
class SettingsRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['key', 'value'];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }

    /**
     * @param array $input
     *
     * @throws ApiOperationFailedException
     * @throws Exception
     */
    public function updateSettings($input)
    {
        if (isset($input['app_logo']) && !empty($input['app_logo'])) {
            $this->deleteImageValue('logo_url');
            $input['logo_url'] = $this->uploadLogo($input['app_logo']);
        }
        if (isset($input['favicon_logo']) && !empty($input['favicon_logo'])) {
            $input['favicon_url'] = $this->uploadFavicon($input['favicon_logo']);
        }
        if (isset($input['pwa_icon']) && !empty($input['pwa_icon'])) {
            $this->deleteImageValue('pwa_icon');
            $input['pwa_icon'] = $this->uploadPWAIcon($input['pwa_icon']);
        }
        if (isset($input['notification_sound']) && !empty($input['notification_sound'])) {
            $this->deleteImageValue('notification_sound');
            $input['notification_sound'] = $this->uploadNotificationSound($input['notification_sound']);
        }
        $input = Arr::only($input, [
            'app_name', 'company_name', 'logo_url', 'favicon_url', 'enable_group_chat', 'members_can_add_group',
            'notification_sound', 'pwa_icon',
        ]);
        $input['enable_group_chat'] = (isset($input['enable_group_chat'])) ? 1 : 0;
        $input['members_can_add_group'] = (isset($input['members_can_add_group'])) ? 1 : 0;

        foreach ($input as $key => $value) {
            $setting = Setting::firstOrCreate(['key' => $key]);
            $setting->update(['value' => $value]);
        }

        $pwaSetting = Setting::where('key', 'pwa_icon')->first();

        $path = public_path('manifest.json');
        $json = json_decode(file_get_contents($path), true);
        $json['name'] = !empty($input['app_name']) ? $input['app_name'] : 'InfyChat';
        $json['icons'][0]['src'] = !empty($pwaSetting) ? $pwaSetting->value : 'logo.png';
        file_put_contents($path, json_encode($json));
    }

    /**
     * @return Collection
     */
    public function getSettings()
    {
        $settings = Setting::all()->pluck('value', 'key');
        if (isset($settings['logo_url'])) {
            $settings['logo_url'] = app(Setting::class)->getLogoUrl($settings['logo_url']);
        }
        if (isset($settings['pwa_icon'])) {
            $settings['pwa_icon'] = app(Setting::class)->getPWAIcon($settings['pwa_icon']);
        }
        if (isset($settings['notification_sound'])) {
            $settings['notification_sound'] = app(Setting::class)->getNotificationSound($settings['notification_sound']);
        }

        return $settings;
    }

    /**
     * @param $file
     *
     * @throws ApiOperationFailedException
     *
     * @return string
     */
    public function uploadLogo($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        if (in_array($extension, ['jpg', 'png', 'jpeg'])) {
            $fileName = ImageTrait::makeImage($file, Setting::PATH, ['width' => 65, 'height' => 35]);
            ImageTrait::makeImage($file, Setting::THUMB_PATH,
                ['width' => 30, 'height' => 30, 'file_name' => $fileName]);

            return $fileName;
        } else {
            throw new UnprocessableEntityHttpException("Please upload valid 'jpg', 'png' or 'jpeg' image.");
        }
    }

    /**
     * @param $file
     *
     * @throws ApiOperationFailedException
     *
     * @return string
     */
    public function uploadPWAIcon($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        if (in_array($extension, ['jpg', 'png', 'jpeg'])) {
            $fileName = ImageTrait::uploadPWAIcon($file, ['width' => 512, 'height' => 512]);

            return $fileName;
        } else {
            throw new UnprocessableEntityHttpException("Please upload valid 'jpg', 'png' or 'jpeg' image.");
        }
    }

    /**
     * @param $file
     *
     * @throws Exception
     *
     * @return string
     */
    public function uploadFavicon($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        if (in_array($extension, ['jpg', 'png', 'jpeg'])) {
            $this->deleteFavicon();
            $fileName = 'favicon.ico';
            $imageThumb = Image::make($file->getRealPath())->fit(15, 15);
            $imageThumb = $imageThumb->stream();

            Storage::disk('public_uploads')->put($fileName, $imageThumb->__toString());

            return $fileName;
        } else {
            throw new UnprocessableEntityHttpException("Please upload valid 'jpg', 'png' or 'jpeg' image.");
        }
    }

    /**
     * @param $file
     *
     * @throws ApiOperationFailedException
     *
     * @return string
     */
    public function uploadNotificationSound($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        if (in_array($extension, ['mp4', 'mp3', 'ogg', 'wav', 'aac', 'alac', 'zip', 'rar'])) {
            $fileName = ImageTrait::uploadFile($file, Setting::NOTIFICATION_SOUND_PATH);

            return $fileName;
        } else {
            throw new UnprocessableEntityHttpException("Please upload valid 'mp4', 'mp3', 'ogg', 'wav', 'aac', 'alac', 'zip', 'zip', or 'rar' audio.");
        }
    }

    /**
     * @param $keyName
     *
     * @throws Exception
     */
    public function deleteImageValue($keyName)
    {
        $setting = Setting::where(['key' => $keyName])->first();
        if (!empty($setting) && !empty($setting->value)) {
            $oldImage = $setting->value;
            $setting->update(['value' => '']);
            if ($setting->key == 'notification_sound') {
                $this->deleteAudio($oldImage);
            } else {
                $this->deleteImage($oldImage);
            }
        }
    }

    /**
     * @param string $fileName
     *
     * @throws Exception
     *
     * @return bool
     */
    public function deleteImage($fileName)
    {
        if (empty($fileName)) {
            return true;
        }

        ImageTrait::deleteImage(Setting::THUMB_PATH.DIRECTORY_SEPARATOR.$fileName);

        return ImageTrait::deleteImage(Setting::PATH.DIRECTORY_SEPARATOR.$fileName);
    }

    /**
     * @throws Exception
     */
    public function deleteFavicon()
    {
        $setting = Setting::where(['key' => 'favicon_logo'])->first();
        if (!empty($setting) && !empty($setting->value)) {
            $oldImage = $setting->value;
            $setting->update(['value' => '']);
            if (Storage::disk('public_uploads')->exists($oldImage)) {
                Storage::disk('public_uploads')->delete($oldImage);

                return true;
            }
        }
    }

    /**
     * @param string $fileName
     *
     * @throws Exception
     *
     * @return bool
     */
    public function deleteAudio($fileName)
    {
        if (empty($fileName)) {
            return true;
        }

        return ImageTrait::deleteImage(Setting::NOTIFICATION_SOUND_PATH.DIRECTORY_SEPARATOR.$fileName);
    }
}
