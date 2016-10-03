<?php
require_once("../config/initialize.php");
//require_once("../helpers/common.php");


$currentlang = Language::getLanguage();
echo "var dump: <br>";
var_dump($currentlang);