<?php
namespace exmsl;
require_once("../../config/initialize.php");

// language
$language = new Language();
$lang = $language->userLanguage();

// get admin with the given id 
$admin = new Admin();
$currentAdmin = $admin->getAdminById($_GET["id"]);

// check if there is a result
if(!$currentAdmin) {
    // admin id missing or invalid
    $_SESSION["message"] = $lang['ADMIN_DELETE_FALSE'];
    App::redirect("admin.php");
}

// delete the admin 
$admin->delete($_GET["id"]);
