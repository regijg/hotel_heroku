<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author eResources/AID/AP
 */

/**
 * 
 * 
 * @param unknown_type $files
 * @param unknown_type $path
 * @param unknown_type $resize
 * @param unknown_type $pic_names
 * @param unknown_type $get_size
 * @return string|mixed
 */
function do_upload($files, $path, $resize = FALSE, $pic_names = NULL, $get_size = NULL ) {
	// Format gambar yang diupload keserver dalam bentuk array
	$format_gambar = array(
			'image/svg+xml'
	);
	
	if ($pic_names != NULL) {
		$get_file_type = explode('.', $files['name']); 
		$get_count = count($get_file_type);	
		$get_type = $get_file_type[$get_count - 1];
	} else {
		$get_type = '';
	}
	
	@$pic_name = ($pic_names != NULL) ? $pic_names . '.' . $get_type : $files['name'];
	@$pic_type = $files['type'];
	@$pic_size = $files['size'] . " kb";
	@$pic_temp_name = $files['tmp_name'];
	
	// Membuat direktory folder dan menggenerate file name location
	$oldmask = umask(0);
	@mkdir($path, 0777, TRUE);
	@umask($oldmask);
	
	// Melakukan pengkondisian
	if ($files['error'] > 0) {
		return false;
	} else if(!in_array((@$pic_type),$format_gambar)) {
		return false;
	} else if(($pic_size =!0) && ($pic_size > 80000000)) {
		return false;
	} else {
		$picture = $path.'/'.str_replace(' ', '__', $pic_name);
		if ($resize == TRUE) {
			@img_resize($pic_temp_name , 800 , $path , str_replace(' ', '__', $pic_name));
			@img_resize($pic_temp_name , 500 , $path , 'med_'.str_replace(' ', '__', $pic_name));
			@img_resize($pic_temp_name , 200 , $path , 'small_'.str_replace(' ', '__', $pic_name));
		} else if ($get_size != NULL) {
			foreach ($get_size as $row) {
				$get_attr = explode('__', $row);
				@img_resize($pic_temp_name , $get_attr[1] , $path , $get_attr[0].'_'.str_replace(' ', '__', $pic_name));
			}
		} else {
			@copy($pic_temp_name, $picture);
			@unlink($pic_temp_name);
		}
		// Mengembalikan nilai picture yaitu berupa nama gambar yang diupload
		return str_replace(' ', '__', $pic_name);
	}
}

/**
 * Make thumbs from JPEG, PNG, GIF source file
 *
 * $tmpname = $_FILES['source']['tmp_name'];
 * $size - max width size
 * $save_dir - destination folder
 * $save_name - tnumb new name
 *
 * Author:  LEDok - http://www.citadelavto.ru/
 */

/**
 * Example :
 *
 * $tmpname  = $_FILES['pic']['tmp_name'];
 * @img_resize( $tmpname , 600 , "../album" , "album_".$id.".jpg");
 * @img_resize( $tmpname , 120 , "../album" , "album_".$id."_small.jpg");
 * @img_resize( $tmpname , 60 , "../album" , "album_".$id."verysmall.jpg");
 *
 */
function img_resize($tmpname, $size, $save_dir, $save_name) {
	$save_dir .= ( substr($save_dir,-1) != "/") ? "/" : "";
	$gis = GetImageSize($tmpname);
	$type = $gis[2];
	switch($type)
	{
		case "1": $imorig = imagecreatefromgif($tmpname); break;
		case "2": $imorig = imagecreatefromjpeg($tmpname);break;
		case "3": $imorig = imagecreatefrompng($tmpname); break;
		default:  $imorig = imagecreatefromjpeg($tmpname);
	}

	$x = imageSX($imorig);
	$y = imageSY($imorig);
	if($gis[0] <= $size) {
		$av = $x;
		$ah = $y;
	} else {
		$yc = $y*1.3333333;
		$d = $x>$yc?$x:$yc;
		$c = $d>$size ? $size/$d : $size;
		$av = $x*$c;
		$ah = $y*$c;
	}
	$im = imagecreate($av, $ah);
	$im = imagecreatetruecolor($av,$ah);
	if (imagecopyresampled($im,$imorig , 0,0,0,0,$av,$ah,$x,$y))
		if (imagejpeg($im, $save_dir.$save_name))
		return true;
	else
		return false;
}

/**
 * 
 * @param unknown $image
 * @param string $mime
 * @return string
 */
function getDataURI($image) {
	$CI = & get_instance();
	try {
		if (file_exists(str_replace(SITE, "", $image))) {
			return 'data:image/png;base64,'.base64_encode(file_get_contents($image));
		} else {
			return 'data:image/png;base64,'.base64_encode(file_get_contents($CI->config->item ( 'catalog_img' ) . 'small_' . $CI->config->item ( 'img_not_avaiable' )));
		}
	}
	catch (Exception $e) {
		return '';
	}
}
