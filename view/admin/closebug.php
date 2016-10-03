<?php
namespace exmsl;
require_once("../../config/initialize.php");

// language
$language = new Language();
$lang = $language->userLanguage();

$bug = new Adminsupport($language->getLanguage());

$currentBug = $bug->getBugById($_GET['id']);

if(!$currentBug) {
    // bug id missing or invalid
    $_SESSION['message'] = $lang['DB_BUG_NOT_FOUND'];
    App::redirect('support.php');
}

// set resolved to 1
$bug->bugTreatment($_GET['id']);