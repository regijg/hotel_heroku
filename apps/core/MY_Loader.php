<?php

/**
 * ARISOFT ID  GLOBAL LOADER
 * Create Engine for  ARISOFT ID WEB Builder powered by Codeigniter
 *
 * author :
 * - Agus Prasetyo / ARISOFT ID
 * - agusprasetyo811@gmail.com
 * --------------------------------------------------------------------------------------
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class MY_Loader extends CI_Loader {

	private $frontThemePath, $adminThemePath;
	private $widgetPath, $contentPath;
	private $baseFrontTheme, $baseAdminTheme;

	private $forAdmin;

	function __construct() {
		parent::__construct();

		// Init Theme Base
		$this->baseFrontTheme = 'index';
		$this->baseAdminTheme = 'index';

		// Init Theme  Name
		$this->frontTheme = 'sb-admin';
		$this->adminTheme = 'admin';

		// Init theme path
		$this->frontThemePath = $this->frontTheme;
		$this->adminThemePath = $this->adminTheme;
		$this->widgetPath = "widget/";
		$this->contentPath = "content/";

	}

	/**
	 *
	 * @param unknown $page
	 * @param unknown $data
	 * @param unknown $param
	 */
	public function tpl($page = NULL, $data = NULL) {

		// If Page not loaded
		if ($page == NULL) {
			show_error();
			exit();
		}

		// Register Content
		$content['content'] = $this->content($page, $data);
		$content['theme_url'] = site_url()."tpl/".$this->themePath()."/";
		$content['theme_path'] = "tpl/".$this->themePath()."/";

		// Combine Data
		$pushData = array_merge($data, $content);

		// Display
		$this->view($this->themePath().'/'.$this->themeBase(), $pushData);
	}

	/**
	 *
	 * @param unknown $widget
	 * @param unknown $data
	 * @param unknown $param
	 */
	public function widget($widget = NULL, $data = NULL) {

		// If Widget not loaded
		if ($widget == NULL) {
			show_error();
			exit();
		}

		// Widget Path
		$widgetPath = $this->themePath()."/".$this->widgetPath;

		$passingData['theme_url'] = site_url()."tpl/".$this->themePath()."/";
		$passingData['theme_path'] = "tpl/".$this->themePath()."/";

		// Combine Data
		$pushData = array_merge($data, $passingData);

		// Display
		return $this->view($widgetPath . $widget, $pushData, TRUE);
	}

	/**
	 *
	 * @param unknown $content
	 * @param unknown $data
	 */
	public  function content($content = NULL, $data = NULL) {

		// If Content  not loaded
		if ($content == NULL) {
			show_error('Content Not Registered');
		}

		// Widget Path
		$contentPath = $this->themePath()."/".$this->contentPath;

		$passingData['theme_url'] = site_url()."tpl/".$this->themePath()."/";
		$passingData['theme_path'] = "tpl/".$this->themePath()."/";

		// Combine Data
		$pushData = array_merge($data, $passingData);

		// Display
		return $this->view($contentPath . $content, $pushData, TRUE);
	}


	/**
	 * Helper theme path
	 * @return unknown
	 */
	public function themePath() {
		// Theme Switch
		$themePath = $this->frontThemePath;
		if ($this->forAdmin) {
			$themePath = $this->adminThemePath;
		}
		return $themePath;
	}

	/**
	 * Helper theme path
	 * @return unknown
	 */
	private function themeBase() {
		// Theme Switch
		$themeBase = $this->baseFrontTheme;
		if ($this->forAdmin) {
			$themeBase = $this->baseAdminTheme;
		}
		return $themeBase;

	}

	public function admin($isForAdmin) {
		$this->forAdmin = TRUE;
	}

}
