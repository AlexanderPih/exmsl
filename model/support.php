<?php
namespace exmsl;
require_once(dirname(__DIR__) . '/config/initialize.php');

class Support {

    public function addSuggestion($input, $language) {

        global $lang;

        $pdo = new Database();

        $sql = "INSERT INTO feedback ( info, langue, date ) VALUES ( :info, :langue, CURDATE() )";

        $statement = $pdo->insert($sql);

        $statement->bindParam(':info', $input['suggestion']);
        $statement->bindParam(':langue', $language);

        $result = $statement->execute();

        if($result) {
            $_SESSION["message"] = $lang['SUGGESTION_CREATED'];
            App::redirect("support.php");
        } else {
            $_SESSION["message"] = $lang['SUGGESTION_FAILED'];
            App::redirect("support.php");
        }
    }

    public function addBug($input, $language)
    {
        global $lang;

        $pdo = new Database();

        $bug     = $input['bug'];
        $message = $input['message'];

        $sql  = "INSERT INTO bug (";
        $sql .= " date, langue, bug, info ";
        $sql .= ") VALUES (";
        $sql .= " CURDATE(), '{$language}', '{$bug}', '{$message}' ";
        $sql .= ")";
        $result = $pdo->query($sql);
        $result->execute();

        if($result) {
            $_SESSION["message"] = $lang['BUG_CREATED'];
            App::redirect("support.php");
        } else {
            $_SESSION["message"] = $lang['BUG_FAILED'];
            App::redirect("support.php");
        }
    }
}