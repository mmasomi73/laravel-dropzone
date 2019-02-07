<?php

namespace App\Utility\FileManager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;

/**
 |-----------------------------------
 | Class FileManager
 |-----------------------------------
 | @package App\Utility\FileManager
 */
class FileManager
{

    protected static $mainDirectory = 'uploads/';//For Files Directory
    protected static $avatar = 'avatar/';//For Avatar Images Directory
    protected static $notification = 'notification/';//For Notification Images Directory
    protected static $gateway = 'gateway/';//For settings Files Directory
    protected static $properties = 'properties/';//For settings Files Directory


    public function __construct()
    {
        self::directoryExists(self::$mainDirectory);
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
    public static function uploadImageFiles($imageAddress)
    {
        $directory = self::$mainDirectory . self::$avatar;
        self::directoryExists($directory);
        $mainFileName = md5(microtime()) . '.' . $imageAddress->getClientOriginalExtension();
        $directory = $directory . $mainFileName;
        Image::make($imageAddress)->resize(150, 150)->save($directory);
        return self::$mainDirectory . self::$avatar . $mainFileName;
    }
    /**
     |-------------------------------------------------
     | directory Exists Function
     |-------------------------------------------------
     | Check Directory Exist Or Not, If Not Exist
     | Make Directory
     | Note: If Want To Make Directory Can Pass Permission
     |       Of Directory On Host
     |
     | @param $subDirectory
     | @param int $permission
     */
    public static function directoryExists($subDirectory, $permission = 640)
    {
        if (!(\File::isDirectory($subDirectory)))
            \File::makeDirectory($subDirectory, $permission);

    }

    /**
     |-------------------------------------------------
     | get Root Directory Of Files That is Public
     |-------------------------------------------------
     |
     | @param $imageAddress
     | @return string
     */
    public static function getRootDirectory($imageAddress)
    {
        return public_path($imageAddress);
    }

    /**
     |-------------------------------------------------
     | remove File By Address Of File
     |-------------------------------------------------
     |
     | @param $address
     */
    public static function removeFile($address)
    {
        if ($address == "" || empty($address))
            return;
        \File::delete(self::getRootDirectory($address));
    }

    //********************************************
    //***** upload property pictures
    //********************************************
    public static function setPropertyPictures(Request $request){
        $urls = array();
        $files = $request->file('file');
        if (is_array($files) || is_object($files)) {
            foreach ($files as $file) {
                $filename = time() . $file->getClientOriginalName();
                $file->move('uploads/properties', $filename);
                $urls[] = $filename;
            }
        }
        return $urls;
    }

    /**
     * upload property pictures in admin side
     * @param $request
     * @return array
     */
    public static function uploadPropertyPicturesAdmin($request){
        $urls = array();
        $directory = self::$mainDirectory . self::$properties;
        $files = $request->file('file');
        if (is_array($files) || is_object($files)) {
            foreach ($files as $file) {
                $filename = md5(microtime()) . '.'  . $file->getClientOriginalExtension();
	            $size = $file->getSize() / (1024 * 1024);
	            $file->move($directory, $filename);
	            $directory = $directory . $filename;
	            $watermark = Image::make(public_path ("img/banner-logo-2.png"))->resize(200, 66);
                if($size > 5){ini_set('memory_limit', "2000M");}
                if(App::environment('local')){

	                $img = Image::make(public_path ($directory))->resize(1200, 800)->encode('jpg', 75);
	                $img->insert($watermark, 'bottom-right', 60,60)->save($directory);
                }
                else{

	                $img = Image::make(public_path (self::getServerDirectory(). $directory))->resize(1200, 800)->encode('jpg', 75);
	                $img->insert($watermark, 'bottom-right', 60,60)->save($directory);
                }
                $urls[] = $filename;
            }
        }
        return $urls;
    }


    /**
     * @param $imageAddress
     * @param $mainFileName
     * @return string
     */
    public static function uploadGatewayThumbnail($imageAddress)
    {
        $directory = self::$mainDirectory . self::$gateway;
        self::directoryExists($directory);
        $mainFileName = md5(microtime()) . '.' . $imageAddress->getClientOriginalExtension();
        $directory = $directory . $mainFileName;
        $image = Image::make($imageAddress);
        if ($image->width() > 80 && $image->height() > 80)
            $image = $image->resize(80, 80);
        $image->save($directory);
        return self::$mainDirectory . self::$gateway . $mainFileName;
    }

    public static function getServerDirectory()
    {
        if(App::environment('local'))
            return '';
        else
            return '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public_html'.DIRECTORY_SEPARATOR;
    }

}