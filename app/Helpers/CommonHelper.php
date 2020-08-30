<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Facade;

use App;
use App\Models\Option;
use App\Models\Category;

class CommonHelperFacade extends Facade
{
	public static function getFacadeAccessor() {
		return 'CommonHelper';
	}
}

class CommonHelper
{
	private static $options = null;

	public static function resizeImage($imagePath , $thumbPath , $w , $h , $trim = true) {
		list($width, $height) = getimagesize($imagePath);
		$ratio = $width/$height;

		$owidth = $width;
		$oheight = $height;

		$r = $w/$h;

		$scale_x = $w/$width;
		$scale_y = $h/$height;

		if(!$trim) {
			// calculating the part of the image to use for thumbnail
			if($scale_x <= $scale_y) {
				$height = $width / $r;
				$x = 0;
				$y = ($oheight - $height) / 2;
			} else {
				$width = $r * $height;
				$x = ($owidth - $width) / 2;
				$y = 0;
			}
		} else {
			if($scale_x > $scale_y) {
				$height = $width / $r;
				$x = 0;
				$y = ($oheight - $height) / 2;
			} else {
				$width = $r * $height;
				$x = ($owidth - $width) / 2;
				$y = 0;
			}
		}

		/*
		// calculating the part of the image to use for thumbnail
		if($scale_x > $scale_y) {
			$height = $width / $r;
			$x = 0;
			$y = ($oheight - $height) / 2;
		} else {
			$width = $r * $height;
			$x = ($owidth - $width) / 2;
			$y = 0;
		}
		/**/

		$type = exif_imagetype($imagePath);

		if($type == IMAGETYPE_PNG) {
			//saving the image into memory (for manipulation with GD Library)
			$image = imagecreatefrompng($imagePath);

			// copying the part into thumbnail
			$thumb = imagecreatetruecolor($w, $h);
			imagealphablending($thumb, false);
			imagesavealpha($thumb, true);
			imagecopyresampled($thumb, $image, 0, 0, $x, $y, $w, $h, $width, $height);

			//final output
			imagepng($thumb , $thumbPath , 7);
		} else {
			//saving the image into memory (for manipulation with GD Library)
			$image = imagecreatefromjpeg($imagePath);

			// copying the part into thumbnail
			$thumb = imagecreatetruecolor($w, $h);
			imagecopyresampled($thumb, $image, 0, 0, $x, $y, $w, $h, $width, $height);

			//final output
			imagejpeg($thumb , $thumbPath , 75);
		}

		return $thumbPath;
	}

	public static function setupOptions() {
		if(!self::$options) {
			self::$options = [];
			$options = Option::app()->get();
			foreach ($options as $option)
			{
				self::$options[$option->key] = $option->value;
			}
		}
	}

	public static function hasOption($key) {
		self::setupOptions();
		return isset(self::$options[$key]) ? true : false;
	}

	public static function option($key) {
		self::setupOptions();
		return isset(self::$options[$key]) ? self::$options[$key] : $key;
	}

	public static function getCardEthValue($usdPrice) {
		if(10000 <= $usdPrice) {
			$range = 7;
			$ethValue = 1 * 1E18;
		}

		else if(1000 <= $usdPrice) {
			$range = 6;
			$ethValue = 0.5 * 1E18;
		}

		else if(100 <= $usdPrice) {
			$range = 5;
			$ethValue = 0.25 * 1E18;
		}

		else if(10 <= $usdPrice) {
			$range = 4;
			$ethValue = 0.20 * 1E18;
		}

		else if(2.5 <= $usdPrice) {
			$range = 3;
			$ethValue = 0.125 * 1E18;
		}

		else if(0.5 <= $usdPrice) {
			$range = 2;
			$ethValue = 0.1 * 1E18;
		}

		else if(0.1 <= $usdPrice) {
			$range = 1;
			$ethValue = 0.05 * 1E18;
		}

		else {
			$range = 0;
			$ethValue = 0.025 * 1E18;
		}

		return $ethValue;
	}

	public static function getCardRange($usdPrice) {
		if(10000 <= $usdPrice) {
			$range = 7;
			$ethValue = 1 * 1E18;
		}

		else if(1000 <= $usdPrice) {
			$range = 6;
			$ethValue = 0.5 * 1E18;
		}

		else if(100 <= $usdPrice) {
			$range = 5;
			$ethValue = 0.25 * 1E18;
		}

		else if(10 <= $usdPrice) {
			$range = 4;
			$ethValue = 0.20 * 1E18;
		}

		else if(2.5 <= $usdPrice) {
			$range = 3;
			$ethValue = 0.125 * 1E18;
		}

		else if(0.5 <= $usdPrice) {
			$range = 2;
			$ethValue = 0.1 * 1E18;
		}

		else if(0.1 <= $usdPrice) {
			$range = 1;
			$ethValue = 0.05 * 1E18;
		}

		else {
			$range = 0;
			$ethValue = 0.025 * 1E18;
		}

		return $range;
	}

	public static function split_name($name)
	{
		$name = trim($name);
		$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
		$first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
		return array('first_name' => $first_name, 'last_name' => $last_name);
	}


	//get high resolution avatar from social login user
	public static function getSocialAvatar($user)
	{
		if(isset($user->avatar_original)){
			return $user->avatar_original;
		}
		if(isset($user->avatar)) {
			return $user->avatar;
		}

		return '';
	}
}
