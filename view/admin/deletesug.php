<?php
namespace exmsl;
require_once("../../config/initialize.php");

// language
$language = new Language();
$lang = $language->userLanguage();

// get admin with the given id
$suggestion = new Adminsupport($language->getLanguage());
$currentSuggestion = $suggestion->getSuggestionById($_GET["id"]);

// check if there is a result
if(!$currentSuggestion) {
    // admin id missing or invalid
    $_SESSION["message"] = $lang['DB_SUGGESTION_NOT_FOUND'];
    App::redirect("support.php");
}

// delete the admin
$suggestion->suggestionDelete($_GET["id"]);