<?php
namespace App\Utility\FileManager;

use Intervention\Image\Facades\Image;

/**
 |-----------------------------------
 | Class Base64ImageManager
 |-----------------------------------
 | @package App\Utility\FileManager
 */
class Base64ImageManager extends FileManager
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
    |-------------------------------------------------
    | upload User Avatar
    |-------------------------------------------------
    | User Avatar Size is 150 × 150 px
    |
    | @param $imageAddress
    | @return string
     */
    public static function uploadBase64ImageFiles($base64Image)
    {
        $directory = self::$mainDirectory . self::$avatar;
        self::directoryExists(self::$mainDirectory);
        self::directoryExists($directory);
        //TODO: Get & Check Valid Extensions

        $base64 = preg_replace('/data:image\/[a-zA-Z]{3,5};base64,/', '', $base64Image);
        $base64 = str_replace(' ', '+', $base64);
        $data = base64_decode($base64);
        $file = $directory.md5(microtime()). '.png';
        $success = file_put_contents($file, $data);

        if($success) Image::make($file)->resize(150, 150)->save($file);
        return $success ? $file : false;
    }

    /**
    |-------------------------------------------------
    | upload User Avatar
    |-------------------------------------------------
    | User Avatar Size is 250 × 250 px
    |
    | @param $imageAddress
    | @return string
     */
    public static function uploadBase64ImageFilesNotification($base64Image)
    {
        $directory = self::$mainDirectory . self::$notification;
        self::directoryExists(self::$mainDirectory);
        self::directoryExists($directory);
        //TODO: Get & Check Valid Extensions

        $base64 = preg_replace('/data:image\/[a-zA-Z]{3,5};base64,/', '', $base64Image);
        $base64 = str_replace(' ', '+', $base64);
        $data = base64_decode($base64);
        $file = $directory.md5(microtime()). '.png';
        $success = file_put_contents($file, $data);

        if($success) Image::make($file)->resize(250, 250)->save($file);
        return $success ? $file : false;
    }
}