<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author eResources/AID/AP
 */
// Fungsi untuk menuliskan file
function write_to_file($file_txt, $data) {
	$data_txt = $file_txt;
	if (! file_exists($data_txt)) {
		$open = @fopen($data_txt, "w");
		@fputs($open, ' ');
		@fclose($open);
	} else {
		$open = fopen($data_txt, "w");
		fwrite($open, $data);
		fclose($open);
	}
}

// Fungsi untuk membaca file
function reading_file($file_txt) {
	$data_txt = $file_txt;
	$fh = fopen($data_txt, "r");
	$file = file_get_contents($data_txt);
	return $file;
}

// Fungsi Untuk menghapus File
function delete_file($file) {
	return @unlink($file);
}

// Fungsi Untuk menghapus File
function delete_dir($dir) {
	if (! file_exists($dir)) return true;
	if (! is_dir($dir)) return @unlink($dir);
	foreach ( scandir($dir) as $item ) {
		if ($item == '.' || $item == '..') continue;
		if (! delete_dir($dir . DIRECTORY_SEPARATOR . $item)) return false;
	}
	return rmdir($dir);
}

// Fungsi Untuk membaca direktori
function read_dir($system_dir) {
	$file_type = 'file';
	if (is_dir($system_dir)) {
		if ($dir = opendir($system_dir)) {
			while ( ($file = readdir($dir)) !== false ) {
				if ($file != "." && $file != "..") {
					$dir_name [] ['file'] = $file;
				}
			}
			$data ['data'] = @$dir_name;
			return json_encode($data);
			closedir($dir);
		}
	}
}

// Fungsi untuk mendapatkan content dengan curl
function get_content_curl($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, "");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

// Fungsi Untuk membaca list controller dan method
function reading_controllers($sub_folder = NULL, $method_all = FALSE, $controller_unset = NULL, $appath = NULL) {
	$controllers = array ();
	$sub_folder = ($sub_folder != NULL) ? $sub_folder . '/' : '';
	$appath = ($appath == NULL) ? APPPATH : $appath;
	$dir = $appath . '/controllers/' . $sub_folder;
	$files = scandir($dir);
	
	$controller_files = array_filter($files, function ($filename) {
		return (substr(strrchr($filename, '.'), 1) == 'php') ? true : false;
	});
	
	if ($controller_unset != NULL) {
		$controller_unset = (! is_array($controller_unset)) ? explode(',', $controller_unset) : $controller_unset;
	}
	
	foreach ( $controller_files as $filename ) {
		$class = strtolower(substr($filename, 0, strrpos($filename, '.')));
		
		if ($controller_unset != NULL) {
			if (! in_array($class, $controller_unset)) {
				require_once ($dir . $filename);
				$classname = ucfirst(substr($filename, 0, strrpos($filename, '.')));
				$controller = new $classname();
				$methods = get_class_methods($controller);
				
				foreach ( $methods as $method ) {
					if ($method_all == FALSE) {
						if ($method != '__construct' && $method != 'get_instance') {
							$get_method [$filename] [] = $method;
						}
					} else {
						$get_method [$filename] [] = trim($method);
					}
				}
				
				$controller_info = array (
						'filename' => $filename,
						'class_name' => $classname,
						'methods' => array_unique($get_method [$filename]) 
				);
				array_push($controllers, $controller_info);
			}
		} else {
			require_once ($dir . $filename);
			$classname = ucfirst(substr($filename, 0, strrpos($filename, '.')));
			$controller = new $classname();
			$methods = get_class_methods($controller);
			
			if ($method_all == FALSE) {
				foreach ( $methods as $method ) {
					if ($method != '__construct' && $method != 'get_instance') {
						$get_method [$filename] [] = trim($method);
					}
				}
			} else {
				foreach ( $methods as $method ) {
					$get_method [$filename] [] = trim($method);
				}
			}
			
			$controller_info = array (
					'filename' => $filename,
					'class_name' => $classname,
					'methods' => array_unique($get_method [$filename]) 
			);
			array_push($controllers, $controller_info);
		}
	}
	
	return $controllers;
}

function reading_file_from_ci_encoder($file_txt, $key = NULL) {
	$ci = & get_instance();
	
	if ($key != NULL) {
		$data_txt = $ci->encrypt->decode($file_txt, $key);
	} else {
		$data_txt = $ci->encrypt->decode($file_txt);
	}
	
	$fh = fopen($data_txt, "r");
	$file = file_get_contents($data_txt);
	return $file;
}

define('PHP_COMPAT_FILE_GET_CONTENTS_MAX_REDIRECTS', 5);

function php_compat_file_get_contents($filename, $incpath = false, $resource_context = null) {
	if (is_resource($resource_context) && function_exists('stream_context_get_options')) {
		$opts = stream_context_get_options($resource_context);
	}
	
	$colon_pos = strpos($filename, '://');
	$wrapper = $colon_pos === false ? 'file' : substr($filename, 0, $colon_pos);
	$opts = (empty($opts) || empty($opts [$wrapper])) ? array () : $opts [$wrapper];
	
	switch ($wrapper) {
	case 'http' :
		$max_redirects = (isset($opts [$wrapper] ['max_redirects']) ? $opts [$proto] ['max_redirects'] : PHP_COMPAT_FILE_GET_CONTENTS_MAX_REDIRECTS);
		for($i = 0; $i < $max_redirects; $i ++) {
			$contents = php_compat_http_get_contents_helper($filename, $opts);
			if (is_array($contents)) {
				$filename = rtrim($contents [1]);
				$contents = '';
				continue;
			}
			return $contents;
		}
		user_error('redirect limit exceeded', E_USER_WARNING);
		return;
	case 'ftp' :
	case 'https' :
	case 'ftps' :
	case 'socket' :
	}
	
	if (false === $fh = fopen($filename, 'rb', $incpath)) {
		user_error('failed to open stream: No such file or directory', E_USER_WARNING);
		return false;
	}
	
	clearstatcache();
	
	if ($fsize = @filesize($filename)) {
		$data = fread($fh, $fsize);
	} else {
		$data = '';
		while ( ! feof($fh) ) {
			$data .= fread($fh, 8192);
		}
	}
	
	fclose($fh);
	return $data;
}

function php_compat_http_get_contents_helper($filename, $opts) {
	$path = parse_url($filename);
	if (! isset($path ['host'])) {
		return '';
	}
	$fp = fsockopen($path ['host'], 80, $errno, $errstr, 4);
	if (! $fp) {
		return '';
	}
	if (! isset($path ['path'])) {
		$path ['path'] = '/';
	}
	
	$headers = array (
			'Host' => $path ['host'],
			'Conection' => 'close' 
	);
	
	$opts_defaults = array (
			'method' => 'GET',
			'header' => null,
			'user_agent' => ini_get('user_agent'),
			'content' => null,
			'request_fulluri' => false 
	);
	
	foreach ( $opts_defaults as $key => $value ) {
		if (! isset($opts [$key])) {
			$opts [$key] = $value;
		}
	}
	$opts ['path'] = $opts ['request_fulluri'] ? $filename : $path ['path'];
	
	$request = $opts ['method'] . ' ' . $opts ['path'] . " HTTP/1.0\r\n";
	
	if (isset($opts ['header'])) {
		$optheaders = explode("\r\n", $opts ['header']);
		for($i = count($optheaders); $i --;) {
			$sep_pos = strpos($optheaders [$i], ': ');
			$headers [substr($optheaders [$i], 0, $sep_pos)] = substr($optheaders [$i], $sep_pos + 2);
		}
	}
	foreach ( $headers as $key => $value ) {
		$request .= "$key: $value\r\n";
	}
	$request .= "\r\n" . $opts ['content'];
	
	fputs($fp, $request);
	$response = '';
	while ( ! feof($fp) ) {
		$response .= fgets($fp, 8192);
	}
	fclose($fp);
	$content_pos = strpos($response, "\r\n\r\n");
	
	if (preg_match('/^Location: (.*)$/mi', $response, $matches)) {
		return $matches;
	}
	return ($content_pos != - 1 ? substr($response, $content_pos + 4) : $response);
}

function php_compat_ftp_get_contents_helper($filename, $opts) {
}

if (! function_exists('file_get_contents_alt')) {

	function file_get_contents_alt($filename, $incpath = false, $resource_context = null) {
		return php_compat_file_get_contents($filename, $incpath, $resource_context);
	}
}

function copy_directory($src, $dst) {
	if (is_dir($src) && is_dir($dst)) {
		$files = json_decode(read_dir($src))->data;
		foreach ( $files as $f ) {
			$file = $f->file;
			copy($src . '/' . $file, $dst . '/' . $file);
		}
		return TRUE;
	} else {
		return FALSE;
	}
}

function url_exists($url) {
	$a_url = parse_url($url);
	if (! isset($a_url ['port'])) $a_url ['port'] = 80;
	$errno = 0;
	$errstr = '';
	$timeout = 30;
	if (isset($a_url ['host']) && $a_url ['host'] != gethostbyname($a_url ['host'])) {
		$fid = fsockopen($a_url ['host'], $a_url ['port'], $errno, $errstr, $timeout);
		if (! $fid) return false;
		$page = isset($a_url ['path']) ? $a_url ['path'] : '';
		$page .= isset($a_url ['query']) ? '?' . $a_url ['query'] : '';
		fputs($fid, 'HEAD ' . $page . ' HTTP/1.0' . "\r\n" . 'Host: ' . $a_url ['host'] . "\r\n\r\n");
		$head = fread($fid, 4096);
		fclose($fid);
		return preg_match('#^HTTP/.*\s+[200|302]+\s#i', $head);
	} else {
		return false;
	}
}

/**
 * Copy a file, or recursively copy a folder and its contents
 *
 * @author Aidan Lister <aidan@php.net>
 * @version 1.0.1
 * @link http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
 * @param string $source
 *        	Source path
 * @param string $dest
 *        	Destination path
 * @return bool Returns TRUE on success, FALSE on failure
 */
function copyr($source, $dest) {
	// Check for symlinks
	if (is_link($source)) {
		return symlink(readlink($source), $dest);
	}
	
	// Simple copy for a file
	if (is_file($source)) {
		return copy($source, $dest);
	}
	
	// Make destination directory
	if (! is_dir($dest)) {
		mkdir($dest);
	}
	
	// Loop through the folder
	$dir = dir($source);
	while ( false !== $entry = $dir->read() ) {
		// Skip pointers
		if ($entry == '.' || $entry == '..') {
			continue;
		}
		
		// Deep copy directories
		copyr("$source/$entry", "$dest/$entry");
	}
	
	// Clean up
	$dir->close();
	return true;
}

/**
 *
 *
 *
 *
 * Omaps Access Modules to generate Modules and append it into controllers
 *
 * @author Agus Prasetyo (OMAPSLAB)
 * @param string $action        	
 * @param string $method        	
 * @param string/array $param        	
 * @param string $unavailable_message        	
 *
 * @return String html from modules views
 *        
 */
function omaps_access_modules($action, $method, $param = NULL, $unavailable_message = NULL) {
	if ($action == NULL) {
		show_error('OMAPS Action Modules Not Set..!!');
		exit();
	}
	
	if ($method == NULL) {
		show_error('OMAPS Method Modules Not Set..!!');
		exit();
	}
	$CI = & get_instance();
	
	$shop_folder = $CI->config->item('shop_folder');
	$installer_folder = $shop_folder . '/installer/';
	$installer_action_folder = $installer_folder . 'actions/';
	$installer_action_folder = $installer_action_folder . $action . '/';
	$src_folder = APPPATH . 'controllers/src/';
	
	$mod = @json_decode(read_dir($installer_action_folder))->data;
	if ($mod != NULL) {
		foreach ( $mod as $m ) {
			if (file_exists($installer_action_folder . $m->file)) {
				if (file_exists($src_folder . $m->file . '.php')) {
					require $src_folder . $m->file . '.php';
					$class = new $m->file();
					
					if (is_array($method)) {
						$get_label = array_keys($method);
						for($i = 0; $i < count($get_label); $i ++) {
							if ($param [$get_label [$i]] != NULL) {
								
								if (method_exists($class, $method [$get_label [$i]])) {
									$mods [$get_label [$i]] = $class->$method [$get_label [$i]]($param [$get_label [$i]]);
								}
							} else {
								if (method_exists($class, $method [$get_label [$i]])) {
									$mods [$get_label [$i]] = $class->$method [$get_label [$i]]();
								}
							}
						}
					} else {
						if ($param != NULL) {
							if (method_exists($class, $method)) {
								$mods [] = base64_encode($class->$method($param));
							}
						} else {
							if (method_exists($class, $method)) {
								$mods [] = base64_encode($class->$method());
							}
						}
					}
				}
			}
		}
		
		$get_modules = (isset($mods)) ? $mods : array (
				base64_encode('') 
		);
	}
	
	if (is_array($method)) {
		$get_modules = (isset($get_modules)) ? $get_modules : $unavailable_message;
		return $get_modules;
	} else {
		$get_modules = (isset($get_modules)) ? $get_modules : '';
		$get_modules_view = '';
		
		if ($get_modules == '') {
			$get_modules_view .= $unavailable_message;
		} else {
			foreach ( $get_modules as $modules ) {
				$get_modules_view .= base64_decode($modules);
			}
		}
		return $get_modules_view;
	}
}

/**
 *
 *
 *
 *
 * Omaps Access Controllers  to load another Controllers and append it into controllers
 *
 * @author Agus Prasetyo (OMAPSLAB)
 * @param string $class        	
 * @param string $method        	
 * @param string/array $param        	
 * @param string $unavailable_message        	
 *
 * @return String html from modules views
 *        
 */
function omaps_access_controller($class, $method, $param = NULL, $unavailable_message = NULL) {
	$controller_dir = APPPATH . 'controllers/';
	
	if ($class == NULL) {
		show_error('OMAPS Action Modules Not Set..!!');
		exit();
	}
	
	if ($method == NULL) {
		show_error('OMAPS Method Modules Not Set..!!');
		exit();
	}
	$CI = & get_instance();
	
	if (file_exists($controller_dir . $class . EXT)) {
		require $controller_dir . $class . EXT;
		$class = new $class();
		
		if (is_array($method)) {
			$get_label = array_keys($method);
			for($i = 0; $i < count($get_label); $i ++) {
				if ($param [$get_label [$i]] != NULL) {
					
					if (method_exists($class, $method [$get_label [$i]])) {
						$mods [$get_label [$i]] = $class->$method [$get_label [$i]]($param [$get_label [$i]]);
					}
				} else {
					if (method_exists($class, $method [$get_label [$i]])) {
						$mods [$get_label [$i]] = $class->$method [$get_label [$i]]();
					}
				}
			}
		} else {
			if ($param != NULL) {
				if (method_exists($class, $method)) {
					$mods [] = base64_encode($class->$method($param));
				}
			} else {
				if (method_exists($class, $method)) {
					$mods [] = base64_encode($class->$method());
				}
			}
		}
	}
	
	$get_modules = (isset($mods)) ? $mods : array (
			base64_encode('')
	);
	
	if (is_array($method)) {
		$get_modules = (isset($get_modules)) ? $get_modules : $unavailable_message;
		return $get_modules;
	} else {
		$get_modules = (isset($get_modules)) ? $get_modules : '';
		$get_modules_view = '';
		
		if ($get_modules == '') {
			$get_modules_view .= $unavailable_message;
		} else {
			foreach ( $get_modules as $modules ) {
				$get_modules_view .= base64_decode($modules);
			}
		}
		return $get_modules_view;
	}
}
