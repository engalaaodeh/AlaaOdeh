<?php

class Template_class_admin extends Template_engine  {
	
	var $display_type='';
	var $pageName='';
	var $pageHeader='';
	var $selectedMenu='';
	
	function Template_class_admin() {
		//$_SESSION['account_id'] = '';
		if($_SESSION['session_account_id']=='') {
			header('Location: ./');
		}
	}
	
	function setHtmlOpener() {
		$this->htmlOpener .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
		$this->htmlOpener .= '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
	}
	
	function setDefaultScripts() {
		//Default
		$this->addJsFile('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
		$this->addJsFile($GLOBALS['app_base_path'].'include/js/script.js');
		$this->addCssFile($GLOBALS['app_base_path'].'include/css/style.css');
		
		$this->addJsFile('http://maps.google.com/maps/api/js?sensor=true');
		
		//blueprint
		$this->addCssFile($GLOBALS['app_base_path'].'include/css/blueprint/grid.css');
	}
	
	function setPageName($name) {
		if($name!='') $this->pageName .= '<h2 style="border-bottom:1px solid #ddd; padding-bottom:15px; margin-bottom:25px; color:#949494;">'.$name.'</h1>';
	}
	
	/*
	START Default functions
	Not to be modified
	*/
	
	function setDisplayType($display_type) {
		$this->display_type = $display_type;
	}
	
	function setPageHeader($page_header) {
		if($page_header!='') $this->pageHeader .= $page_header;
	}
	
	function displayTopPage() {
		//include_once('top_page.php');
		?>
		
		<div class="container">
			<br>
			<a href="http://codecanyon.net/user/yougapi/portfolio"><img src="../include/graph/mobile-store-locator-mini.png" align="left" style="margin-right:30px;"></a>
			<h1 style="margin-bottom:5px;">Store Locator Admin</h1>
			<h2 style="margin-bottom:8px; color: #666; font-family: 'Warnock Pro', 'Goudy Old Style','Palatino','Book Antiqua', Georgia, serif; font-style: italic; font-weight: normal;">
			Stores & categories back-end management.<br></h2>
		</div>
		
		<?php
		echo '<div class="container">';
		
		$selectedMenuTab[$this->selectedMenu] = 'class="current"';
		
		echo '<br>';
		echo '<div style="position:relative;">';
			echo '<a href="./home.php">Home</a> 
			- <a href="./add.php">Add store</a> 
			- <a href="./list.php">Stores list</a> 
			- <a href="./categories.php">Categories</a>';
			echo '<div style="position:absolute; right:0px; top:0px;">';
			echo '<a href="../" id="preview_app_btn">Preview</a> - ';
			echo '<a href="./logout.php">Logout</a>';
			echo '</div>';
		echo '</div>';
		echo '<br><hr>';
	}
	
	function displayBottomPage() {
		echo '<br><br><br><hr>';
		echo '<small>Powered by <a href="http://yougapi.com">Yougapi Technology</a></small>';
		echo "\n".'</div>';
		//include_once('bottom_page.php');
	}
	
	function displayHeader() {
		$this->setHtmlOpener();
		$this->setDefaultScripts();
		parent::displayHeader(); //displays all head section until <body>
		$this->displayTopPage();
		echo $this->pageName."\n";
		echo $this->pageHeader."\n";
	}
	
	function displayFooter() {
		echo "\n";
		$this->displayBottomPage();
		parent::displayFooter();
	}
	
}

?>