<?php
namespace exmsl;
require_once("../../config/initialize.php");

// language
$language = new Language();
$lang = $language->userLanguage();

// get admin with the given id 
$faq = new Faq();
$currentFaq = $faq->getFaqById($_GET["id"]);

// check if there is a result
if(!$currentFaq) {
    // admin id missing or invalid
    $_SESSION["message"] = $lang['FAQ_DELETE_FALSE'];
    App::redirect("faq.php");
}

// delete the admin 
$faq->delete($_GET["id"]);