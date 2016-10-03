<?php
namespace exmsl;

use \PDO;
require_once(dirname(__DIR__) . '/config/initialize.php');

class Adminsupport  {

    protected static $tablename = "bugs";
    protected $language = "";

    public function __construct($language) {
        $this->language = $language;
    }

    /**
     * Find all bug entries for the currently used language
     * @param $lang string
     * @param $status int status (0 = open, 1 = closed)
     * @return array|PDOStatement
     */
    public function getAllBugs($lang, $status){
        $pdo = new Database();

        if($status === "open") {
            $status = 0;
        } else {
            $status = 1;
        }

        $sql  = "SELECT * ";
        $sql .= "FROM bugs ";
        $sql .= "WHERE langue = '{$lang}' ";
        $sql .= "AND resolved = '{$status}' ";
        $sql .= "ORDER BY id ASC";

        $result = $pdo->query($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getBugById($id)
    {
        $pdo = new Database();

        $sql  = "SELECT * ";
        $sql .= "FROM bugs ";
        $sql .= "WHERE id = '{$id}' ";

        $result = $pdo->query($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function bugTreatment($id)
    {
        global $lang;

        $pdo = new Database();

        $sql  = "UPDATE bugs SET resolved = '1' ";
        $sql .= " WHERE id = '{$id}' LIMIT 1";

        $result = $pdo->query($sql);
        $result->execute();

        if($result) {
            $_SESSION['message'] = $lang['BUG_CLOSE_TRUE'];
            App::redirect('support.php#feedback_closed');
        } else {
            $_SESSION["message2"] = $lang['BUG_CLOSE_FALSE'];
            App::redirect("support.php#feedback");
        }
    }

    public function deleteBug($id)
    {
        global $lang;

        $pdo = new Database();

        $sql = "DELETE FROM bugs WHERE id = '{$id}' LIMIT 1";
        $result = $pdo->query($sql);
        $result->execute();


        if($result) {
            $_SESSION["message"] = $lang['BUG_DELETE_TRUE'];
            App::redirect("support.php");
        } else {
            $_SESSION["message"] = $lang['BUG_DELETE_FALSE'];
            App::redirect("support.php");
        }
    }

    /**
     * Get all suggestions for the given language
     * @return array|PDOStatement
     */
    public function getSuggestions(){
        $pdo = new Database();
        $lang = $this->language;

        $sql  = "SELECT * ";
        $sql .= "FROM feedback ";
        $sql .= "WHERE langue = '{$lang}' ";
        $sql .= "ORDER BY date ASC";
        $result = $pdo->query($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSuggestionById($id)
    {
        $pdo = new Database();

        $sql  = "SELECT * FROM ";
        $sql .= "feedback ";
        $sql .= "WHERE id = '{$id}' ";

        $result = $pdo->query($sql);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);

    }

    public function suggestionDelete($id)
    {
        global $lang;
        $pdo = new Database();

        $sql  = "DELETE FROM feedback WHERE id = '{$id}' LIMIT 1";
        $result = $pdo->query($sql);
        $result->execute();


        if($result) {
            $_SESSION["message"] = $lang['SUG_DELETE_TRUE'];
            App::redirect("support.php");
        } else {
            $_SESSION["message"] = $lang['SUG_DELETE_FALSE'];
            App::redirect("support.php");
        }
    }
}