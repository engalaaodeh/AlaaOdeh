<?php
include_once('config.php');

session_set_cookie_params(0, $GLOBALS['app_base_path']);
session_start();

include_once('functions/db_functions.php');
include_once('functions/Forms.php');
include_once('db/db_class.php');

//Template
include_once('templates/Template_engine.php');
include_once('templates/Template_seo.php');
include_once('templates/admin/Template_class.php');

?>