<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Facade;
use App\Models\Attachment;

class AttachmentHelperFacade extends Facade
{
      public static function getFacadeAccessor() {
            return 'AttachmentHelper';
      }
}

class AttachmentHelper
{
    public static function uploadFile($file , $type , $module) {
        $attachment = new Attachment;
        $attachment->fileType = $type;
        $attachment->name = $file->getClientOriginalName();
        $attachment->contentType = $file->getMimeType();
        $attachment->fileSize = $file->getSize();
        $attachment->path = '';
        $attachment->encoding = 'UTF-8';
        $attachment->save();

        $path = AttachmentHelper::upload($file->getRealPath() , $module , $attachment);

        $attachment->path = $path;
        $attachment->save();

        return $attachment->attachmentId;
    }

    public static function upload($from_path , $module , $attachment) {
    	$fileServerDir = storage_path('app/files/');
        $path = $module.'/'.$attachment->attachmentId;

        if(!file_exists($fileServerDir.'/'.$path))
            mkdir($fileServerDir.'/'.$path, 0777, true);

        $fp = fopen($fileServerDir.$path.'/file', 'w');

        fwrite($fp, file_get_contents($from_path));
        fclose($fp);

        return $path;
    }

    public static function renderUrl($attachmentId , $size = "") {
        if($attachmentId != "")
            return url('attachment/render/'.$attachmentId. ($size ? '/'.$size.'/true' : ''));
        else
            return "";
    }

    public static function downloadUrl($attachmentId) {
    	if($attachmentId != "")
            return url('attachment/download/'.$attachmentId);
        else
            return "";
    }

    public static function download($attachment) {
    	$fileServerDir = storage_path('app/files/');
        $path = $fileServerDir.'/'.$attachment->path.'/file';

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"".$attachment->name."\"");
        header("Content-length: ".(string)(filesize($path)));

        header("Expires: Wed, 29 May 2033 06:50:58 GMT");
        header("Cache-Control: max-age=29030400");
        header("Etag: ".$attachment->attachmentId);
        header('Pragma: cache');

        // header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
        // header("Cache-Control: no-cache, must-revalidate");
        // header("Pragma: no-cache");
        echo file_get_contents($path);
        exit;
    }

    public static function render($attachment) {
    	$fileServerDir = storage_path('app/files/');
        $path = $fileServerDir.'/'.$attachment->path.'/file';
        header("Content-type: " . $attachment->contentType);
        header("Content-Disposition: inline; filename=\"".$attachment->name."\"");
        header("Content-length: ".(string)(filesize($path)));

        header("Expires: Wed, 29 May 2033 06:50:58 GMT");
        header("Cache-Control: max-age=29030400");
        header("Etag: ".$attachment->attachmentId);
        header('Pragma: cache');

        // header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
        // header("Cache-Control: no-cache, must-revalidate");
        // header("Pragma: no-cache");
        echo file_get_contents($path);
        exit;
    }

    public static function renderThumb($attachment , $width , $height , $trim = true) {
        $fileServerDir = storage_path('app/files/');
        $path = $fileServerDir.'/'.$attachment->path.'/file'.$width.'_'.$height;

        if(true || !file_exists($path))
        {
            CommonHelper::resizeImage($fileServerDir.'/'.$attachment->path.'/file' , $path , $width , $height , $trim);
        }

        header("Content-type: " . $attachment->contentType);
        header("Content-Disposition: inline; filename=\"".$attachment->name."\"");
        header("Content-length: ".(string)(filesize($path)));
        header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
        /*
        header("Pragma: no-cache");
        header("Expires: Wed, 29 May 2033 06:50:58 GMT");
        header("Cache-Control: no-cache, must-revalidate");
        /**/

        header('Pragma: public');
        header('Cache-Control: max-age=86400');
        header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));

        echo file_get_contents($path);
        exit;
    }

    public static function uploadVideo($from_path , $module , $attachment) {
    	$fileServerDir = storage_path('app/files/');
        $path = $module.'/'.$attachment->attachmentId;

        if(!file_exists($fileServerDir.'/'.$path))
            mkdir($fileServerDir.'/'.$path, 0777, true);

        $fp = fopen($fileServerDir.$path.'/file', 'w');

        fwrite($fp, file_get_contents($from_path));
        fclose($fp);

        return $path;
    }
}
