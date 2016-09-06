<?php
/**
 * @package     Zen Tools
 * @subpackage  Zen Tools
 * @author      Joomla Bamboo - design@joomlabamboo.com
 * @copyright   Copyright (c) 2014 Joomla Bamboo. All rights reserved.
 * @license     GNU General Public License version 2 or later
 * @version     1.12.2
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

//Resize image options: exact, portrait, landscape, auto, crop, topleft, center
// Fix the base path for some servers
if (!(class_exists('ZenToolsResizeImageHelper'))) {
	class ZenToolsResizeImageHelper
	{
		public static function getResizedImage($image, $newWidth, $newHeight, $option='crop', $quality='90')
		{
			
			$offset = strpos($image, '/media/');
			
			if ($offset)
			{
				$image = substr_replace($image, '', 0, $offset);
			}
				
			$image = preg_replace('/^\/images\//', 'images/', $image);
			
			if (empty($image))
			{
				return '';
			}
			
			// Import libraries
			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');
			jimport('joomla.filesystem.path');

			$baseCacheUrl = JURI::base() . '/';
			$imageCacheUrl = $baseCacheUrl . 'media/mod_zentools/cache/images/';
			$imageCacheRoot = JPath::clean(JPATH_SITE . '/media/mod_zentools/cache/images/');

			if (strpos($image, JPATH_SITE) === false)
			{
				$image = JPath::clean($image);
			}

			if (!JFile::exists($image))
			{
				return '';
			}

			$imageFullFileName = JFile::getName($image);
			$imageFileName = JFile::stripExt($imageFullFileName);
			$extension = '.' . strtolower(JFile::getExt($imageFullFileName));

			unset($imageFullFileName);

			//open the image
			switch ($extension)
			{
				case '.jpg':
				case '.jpeg':
					$img = imagecreatefromjpeg($image);
					break;
				case '.gif':
					$img = imagecreatefromgif($image);
					break;
				case '.png':
					$img = imagecreatefrompng($image);
					break;
				default:
					$img = false;
					break;
			}

			if ($img !== false) {
				//Retrieve its width and Height
				$width  = imagesx($img);
				$height = imagesy($img);

				//name for our new image & path to save to
				$lastMod = filemtime($image);
				$newImage = $imageFileName.'-'.md5($image.'-'.$newWidth.'x'.$newHeight.'-'.$option.'-'.$lastMod);
				$savePath = $imageCacheRoot . $newImage . $extension;

				//if the original image is smaller than specified we just return the original
				if (($width < $newWidth) && ($height < $newHeight)){
					$originalImage = str_replace(JPATH_ROOT . '/', '', $image);
					$originalImage = str_replace('\\'.'\\', '\\', str_replace('//', '/', str_replace('\\', '/', $originalImage)));

					return $originalImage;
				}

				//if we have already created the image once at the same size we just return that one
				if (file_exists($imageCacheRoot . $newImage . $extension)){
					return $imageCacheUrl . $newImage . $extension;
				}

				//Make sure the cache exists. If it doesn't, then create it
				if (!JFolder::exists($imageCacheRoot)){
					JFolder::create($imageCacheRoot, 0755);
				}
				//Fix permissions if they are not correct
				if ((JFolder::exists($imageCacheRoot))&&(JPath::setPermissions($imageCacheRoot)!='0755')){
					JPath::setPermissions($imageCacheRoot, $filemode= '0755', $foldermode= '0755');
				}

				//Get optimal width and height - based on $option
				$optionArray = ZenToolsResizeImageHelper::getDimensions($newWidth, $newHeight, $width, $height, $option);
				$optimalWidth  = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				//Resample - create image canvas of x, y size
				$imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);

				if ($extension === '.png')
				{
					ZenToolsResizeImageHelper::setPngTransparency($imageResized, $img);
				}
				else if ($extension === '.gif') {
					ZenToolsResizeImageHelper::setGifTransparency($imageResized, $img);
				}

				imagecopyresampled($imageResized, $img, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $width, $height);
				//if option is 'crop', then crop too
				if ($option == 'crop') {
					//Find center - this will be used for the crop
					$cropStartX = ($optimalWidth / 2) - ($newWidth /2);
					$cropStartY = ($optimalHeight/ 2) - ($newHeight/2);
					$crop = $imageResized;
					//Now crop from center to exact requested size
					$imageResized = imagecreatetruecolor($newWidth , $newHeight);
					if ($extension === '.png')
					{
						ZenToolsResizeImageHelper::setPngTransparency($imageResized, $img);
					}
					else if ($extension === '.gif') {
						ZenToolsResizeImageHelper::setGifTransparency($imageResized, $img);
					}
					imagecopyresampled($imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
				}
				//if option is 'topleft', then crop w/o resize
				if ($option == 'topleft') {
					$crop = $img;
					//Now crop from top left to exact requested size
					$imageResized = imagecreatetruecolor($newWidth , $newHeight);
					if ($extension === '.png')
					{
						ZenToolsResizeImageHelper::setPngTransparency($imageResized, $img);
					}
					else if ($extension === '.gif') {
						ZenToolsResizeImageHelper::setGifTransparency($imageResized, $img);
					}
					imagecopyresampled($imageResized, $crop, 0, 0, 0, 0, $newWidth, $newHeight , $newWidth, $newHeight);
				}
				//if option is 'topleft', then crop w/o resize
				if ($option == 'center') {
					//Find center - this will be used for the crop
					$cropStartX = ($width / 2)  - ($optimalWidth / 2);
					$cropStartY = ($height / 2) - ($optimalHeight/ 2);
					// $cropEndX = $cropStartX + $optimalWidth;
					// $cropEndY = $cropStartY + $optimalHeight;
					$crop = $img;
					//Now crop from center to exact requested size
					$imageResized = imagecreatetruecolor($newWidth, $newHeight);
					if ($extension === '.png')
					{
						ZenToolsResizeImageHelper::setPngTransparency($imageResized, $img);
					}
					else if ($extension === '.gif') {
						ZenToolsResizeImageHelper::setGifTransparency($imageResized, $img);
					}
					imagecopyresampled($imageResized, $crop, 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
				}

				// Free unused resources to avoid memory issue in imageconvolution
				imagedestroy($img);
				if (isset($crop))
				{
					imagedestroy($crop);
				}
				unset($crop, $cropStartX, $cropStartY, $newWidth, $newHeight, $img, $optimalHeight, $option, $optionArray, $imageCacheRoot);

				switch ($extension)
				{
					case '.jpg':
					case '.jpeg':
						// Sharpen the image before we save it
						$sharpness = ZenToolsResizeImageHelper::findSharp($width, $optimalWidth);
						$sharpenMatrix = array(
							array(-1, -2, -1),
							array(-2, $sharpness + 12, -2),
							array(-1, -2, -1)
						);
						$divisor = $sharpness;
						$offset = 0;
						if (function_exists('imageconvolution')){
							imageconvolution($imageResized, $sharpenMatrix, $divisor, $offset);
						} else {
							createImageConvolution::imageConvolution($imageResized, $sharpenMatrix, $divisor, $offset);
						}
						if (imagetypes() & IMG_JPG) {
							imagejpeg($imageResized, $savePath, $quality);
						}
						break;
					case '.gif':
						if (imagetypes() & IMG_GIF) {
							imagegif($imageResized, $savePath);
						}
						break;
					case '.png':
						//Scale quality from 0-100 to 0-9
						$scaleQuality = round(($quality/100) * 9);
						//Invert quality setting as 0 is best, not 9
						$invertScaleQuality = 9 - $scaleQuality;
						if (imagetypes() & IMG_PNG) {
							 imagepng($imageResized, $savePath, $invertScaleQuality);
						}
						break;
					default:
						break;
				}
				imagedestroy($imageResized);

				return $imageCacheUrl . $newImage . $extension;
			}

			return '';
		}

		private static function getDimensions($newWidth, $newHeight, $width, $height, $option="crop")
		{
		   switch ($option)
			{
				case 'exact':
					$optimalWidth = $newWidth;
					$optimalHeight= $newHeight;
					break;
				case 'portrait':
					$optimalWidth = ZenToolsResizeImageHelper::getSizeByFixedHeight($newHeight, $width, $height);
					$optimalHeight= $newHeight;
					break;
				case 'landscape':
					$optimalWidth = $newWidth;
					$optimalHeight= ZenToolsResizeImageHelper::getSizeByFixedWidth($newWidth, $width, $height);
					break;
				case 'auto':
					$optionArray = ZenToolsResizeImageHelper::getSizeByAuto($newWidth, $newHeight, $width, $height);
					$optimalWidth = $optionArray['optimalWidth'];
					$optimalHeight = $optionArray['optimalHeight'];
					break;
				case 'crop':
					$optionArray = ZenToolsResizeImageHelper::getOptimalCrop($newWidth, $newHeight, $width, $height);
					$optimalWidth = $optionArray['optimalWidth'];
					$optimalHeight = $optionArray['optimalHeight'];
					break;
				case 'topleft':
					$optimalWidth = $newWidth;
					$optimalHeight= $newHeight;
					break;
				case 'center':
					$optimalWidth = $newWidth;
					$optimalHeight= $newHeight;
					break;
				default:
					$optionArray = ZenToolsResizeImageHelper::getOptimalCrop($newWidth, $newHeight, $width, $height);
					$optimalWidth = $optionArray['optimalWidth'];
					$optimalHeight = $optionArray['optimalHeight'];
					break;
				}
			return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
		}

		private static function getSizeByFixedHeight($newHeight, $width, $height)
		{
			$ratio = $width / $height;
			$newWidth = $newHeight * $ratio;
			return $newWidth;
		}

		private static function getSizeByFixedWidth($newWidth, $width, $height)
		{
			$ratio = $height / $width;
			$newHeight = $newWidth * $ratio;
			return $newHeight;
		}

		private static function getSizeByAuto($newWidth, $newHeight, $width, $height)
		{
			if ($height < $width)
			//Image to be resized is wider (landscape)
			{
				$optimalWidth = $newWidth;
				$optimalHeight= ZenToolsResizeImageHelper::getSizeByFixedWidth($newWidth, $width, $height);
			}
			elseif ($height > $width)
			//Image to be resized is taller (portrait)
			{
				$optimalWidth = ZenToolsResizeImageHelper::getSizeByFixedHeight($newHeight, $width, $height);
				$optimalHeight= $newHeight;
			}
			else
			//Image to be resizerd is a square
			{
				if ($newHeight < $newWidth) {
					$optimalWidth = $newWidth;
					$optimalHeight= ZenToolsResizeImageHelper::getSizeByFixedWidth($newWidth, $width, $height);
				} else if ($newHeight > $newWidth) {
					$optimalWidth = ZenToolsResizeImageHelper::getSizeByFixedHeight($newHeight, $width, $height);
					$optimalHeight= $newHeight;
				} else {
					//Sqaure being resized to a square
					$optimalWidth = $newWidth;
					$optimalHeight= $newHeight;
				}
			}
			return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
		}

		private static function getOptimalCrop($newWidth, $newHeight, $width, $height)
		{
			$heightRatio = $height / $newHeight;
			$widthRatio  = $width /  $newWidth;
			if ($heightRatio < $widthRatio) {
				$optimalRatio = $heightRatio;
			} else {
				$optimalRatio = $widthRatio;
			}
			$optimalHeight = $height / $optimalRatio;
			$optimalWidth  = $width  / $optimalRatio;
			return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
		}

		public static function findSharp($orig, $final) // function from Ryan Rud (http://adryrun.com)
		{
			$final	= $final * (750.0 / $orig);
			$a		= 52;
			$b		= -0.27810650887573124;
			$c		= .00047337278106508946;

			$result = $a + $b * $final + $c * $final * $final;

			return max(round($result), 0);
		} // findSharp()

		private static function setGifTransparency($newImage, $image_source)
		{
				$transparencyIndex = imagecolortransparent($image_source);
				$transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);
				if ($transparencyIndex >= 0) {
					$transparencyColor    = imagecolorsforindex($image_source, $transparencyIndex);
				}
				$transparencyIndex  = imagecolorallocate($newImage, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
				imagefill($newImage, 0, 0, $transparencyIndex);
				imagecolortransparent($newImage, $transparencyIndex);
		}

		private static function setPngTransparency($newImage, $image_source)
		{
			imagealphablending($newImage, false);
			imagesavealpha($newImage, true);

			$transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
			imagefilledrectangle($newImage, 0, 0, imagesx($newImage), imagesy($newImage), $transparent);
		}
	}

	if (!function_exists('imageconvolution')){
		class createImageConvolution
		{
			public static function ImageConvolution($src, $filter, $filter_div, $offset){
				if ($src == NULL) {
					return 0;
				}
				$sx = imagesx($src);
				$sy = imagesy($src);
				$srcback = ImageCreateTrueColor ($sx, $sy);
				ImageAlphaBlending($srcback, false);
				ImageAlphaBlending($src, false);
				ImageCopy($srcback, $src, 0, 0, 0, 0, $sx, $sy);
				if ($srcback == NULL){
					return 0;
				}
				for ($y=0; $y<$sy; ++$y){
					for ($x=0; $x<$sx; ++$x){
						$new_r = $new_g = $new_b = 0;
						$alpha = imagecolorat($srcback, @$pxl[0], @$pxl[1]);
						$new_a = ($alpha >> 24);

						for ($j=0; $j<3; ++$j) {
							$yv = min(max($y - 1 + $j, 0), $sy - 1);
							for ($i=0; $i<3; ++$i) {
									$pxl = array(min(max($x - 1 + $i, 0), $sx - 1), $yv);
								$rgb = imagecolorat($srcback, $pxl[0], $pxl[1]);
								$new_r += (($rgb >> 16) & 0xFF) * $filter[$j][$i];
								$new_g += (($rgb >> 8) & 0xFF) * $filter[$j][$i];
								$new_b += ($rgb & 0xFF) * $filter[$j][$i];
								$new_a += ((0x7F000000 & $rgb) >> 24) * $filter[$j][$i];
							}
						}
						$new_r = ($new_r/$filter_div)+$offset;
						$new_g = ($new_g/$filter_div)+$offset;
						$new_b = ($new_b/$filter_div)+$offset;
						$new_a = ($new_a/$filter_div)+$offset;
						$new_r = ($new_r > 255)? 255 : (($new_r < 0)? 0:$new_r);
						$new_g = ($new_g > 255)? 255 : (($new_g < 0)? 0:$new_g);
						$new_b = ($new_b > 255)? 255 : (($new_b < 0)? 0:$new_b);
						$new_a = ($new_a > 127)? 127 : (($new_a < 0)? 0:$new_a);
						$new_pxl = ImageColorAllocateAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
						if ($new_pxl == -1) {
							$new_pxl = ImageColorClosestAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
						}
						if (($y >= 0) && ($y < $sy)) {
							imagesetpixel($src, $x, $y, $new_pxl);
						}
					}
				}
				imagedestroy($srcback);
				return 1;
			}
		}
	}
}
?>