<?php
namespace exmsl;
require_once(dirname(__DIR__) . '/config/initialize.php');

class Language {

    private $userLang;
    public $lang = array();

    /**
     * Constructor, gets current language and loads the language file.
     */
    public function __construct(){
        $userLanguage = $this->getLanguage();
        $this->userLang = $userLanguage;
        $langfile = LANG_PATH.DS.'lang.'.$this->userLang.'.ini';
        if(!file_exists($langfile)) {
            // language file not found, default language is english
            $langfile = LANG_PATH.DS.'lang.en.ini';
        }
        $this->lang = parse_ini_file($langfile);
    }

    /**
     * Gets the current language. Checks $_GET first, if it isset, registers it into session and cookie
     * if not set, checks if it isset in session or cookie. Default is english
     * @return string
     */
    public static function getLanguage() {
        if(isset($_GET['lang'])) {
            $language = $_GET['lang'];
            // register the session
            $_SESSION['lang'] = $language;
            // cookie, 7 days
            setcookie('lang', $language, time() + (3600 * 24 * 7));
            return $language;
        } else if(isset($_SESSION['lang'])) {
            $language = $_SESSION['lang'];
            return $language;
        } else if(isset($_COOKIE['lang'])) {
            $language = $_COOKIE['lang'];
            return $language;
        } else {
            $language = 'en';
            return $language;
        }
    }

    /**
     * Returns the language array.
     * @return array
     */
    public function userLanguage() {
        return $this->lang;
    }
}

