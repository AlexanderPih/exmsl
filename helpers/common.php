<?php
namespace exmsl;
session_start();

// language, checks if $_GET has language value, if not, check $_SESSION or else Cookie
if(isset($_GET['lang'])) {
    $language = $_GET['lang'];

    // register the session
    $_SESSION['lang'] = $language;
    // cookie, 7 days
    setcookie('lang', $language, time() + (3600 * 24 * 7));
} else if(isset($_SESSION['lang'])) {
    $language = $_SESSION['lang'];
} else if(isset($_COOKIE['lang'])) {
    $language = $_COOKIE['lang'];
} else {
    $language = 'en';
}
echo "language: ". $language;
echo "<br>";
// return language file name
switch($language) {
    case 'en':
        $lang_file = 'lang.en.php';
        break;
    case 'de':
        $lang_file = 'lang.de.php';
        break;
    case 'fr':
        $lang_file = 'lang.fr.php';
        break;
    default:
        $lang_file = 'lang.en.php';
}
// path to file
echo $lang_file;
echo "<br>";
include_once "../view/lang/".$lang_file;
