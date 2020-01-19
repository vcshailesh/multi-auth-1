<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 16-Jan-19
 * Time: 10:18 PM
 */

use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('include_route_files')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (!function_exists('active_class')) {
    /**
     * Get the active class if the condition is not falsy
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function active_class($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return app('active')->getClassIf($condition, $activeClass, $inactiveClass);
    }
}


if (!function_exists('sendSms')) {
    function sendSms($mobileNo, $message)
    {
        $senderURL = config('app.sms_connection.sender_url') . 'sendSMS';

        //Preparing post parameters
        $postData = array(
            'username' => config('app.sms_connection.sender_username'),
            'message' => $message,
            'sendername' => config('app.sms_connection.sendername'),
            'smstype' => config('app.sms_connection.sender_type'),
            'numbers' => $mobileNo,
            'apikey' => config('app.sms_connection.sender_api_key')
        );

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $senderURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));

        //get response
        $response = curl_exec($ch);

        return $result = json_decode($response);
    }
}

if (!function_exists('uniquePropertyString')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function uniquePropertyString()
    {
        $date = date('dmY', strtotime(Carbon::now()));
        $time = date('his', strtotime(Carbon::now()));
        $randomString = Str::random(3);
        return 'N' . $date . strtoupper($randomString) . $time;
    }
}

if (!function_exists('uniqueProjectString')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function uniqueProjectString()
    {
        $date = date('dmY', strtotime(Carbon::now()));
        $time = date('his', strtotime(Carbon::now()));
        $randomString = Str::random(3);
        return 'N' . $date . strtoupper($randomString) . $time;
    }
}

if (!function_exists('uploadImage')) {
    /**
     * @param $path
     * @param $image
     */
    function uploadImage($path, $image)
    {
        try {
            $path = 'uploads' . $path;
            if (!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0777, true, true);
            }
            $imageName = time() . "-" . $image->getClientOriginalName();

            $image->move(public_path($path), $imageName);
            return $imageName;
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
}

if (!function_exists('moveImage')) {
    /**
     * @param $path
     * @param $image
     */
    function moveImage($path, $image, $imageName)
    {
        try {
            $path = 'uploads' . $path;
            if (!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0777, true, true);
            }

            $image->move(public_path($path), $imageName);
            return $imageName;
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
}

if (!function_exists('removeImage')) {
    /**
     * @param $path
     */
    function removeImage($path)
    {
        try {
            $path = public_path('/uploads' . $path);
            if (File::exists($path)) {
                File::delete($path);
            }
            return true;
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
}

if (!function_exists('uniqueOrderID')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function uniqueOrderID()
    {
        $date = date('dmY', strtotime(Carbon::now()));
        $time = date('his', strtotime(Carbon::now()));
        $randomString = Str::random(3);
        return 'N' . $date . strtoupper($randomString) . $time;
    }
}

if (!function_exists('uniqueUploadFileName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function uniqueUploadFileName($file)
    {
        $uniqueFileName = time() . "-" . $file->getClientOriginalName();

        return $uniqueFileName;
    }
}

if (!function_exists('loggedUser')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function loggedUser()
    {
        return auth()->user();
    }
}

if (!function_exists('globalDateFormat')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function globalDateFormat($date)
    {
        return $date->format('d-m-Y h:i:s');
    }
}
