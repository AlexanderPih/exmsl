<?php
namespace exmsl;

use \PDO;
require_once(dirname(__DIR__) . '/config/initialize.php');

class Faq  {

    protected static $tableName = "faq";

    public $lastQuery;
    public $id;
    public $langue;
    public $question;
    public $answer;


    /**
     * Find all faq entries for the currently used language
     * @param $lang
     * @return array|PDOStatement
     */
    public function findAllFaq($lang){
        $pdo = new Database();

        $sql  = "SELECT * ";
        $sql .= "FROM faq ";
        $sql .= "WHERE langue = '{$lang}' ";
        $sql .= "ORDER BY id ASC";
        $result = $pdo->query($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Get Faq with the given id
     * @param $id
     * @return array
     */
    public function getFaqById($id) {
        $pdo = new Database();

        $sql  = "SELECT * ";
        $sql .= "FROM faq ";
        $sql .= "WHERE id = '{$id}' ";
        $result = $pdo->query($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Delete Faq entry
     * @param $id
     */
    public function delete($id) {

        global $lang;

        $pdo = new Database();

        $sql = "DELETE FROM faq WHERE id = '{$id}' LIMIT 1";
        $result = $pdo->query($sql);
        $result->execute();


        if($result) {
            $_SESSION["message"] = $lang['FAQ_DELETE_TRUE'];
            App::redirect("faq.php");
        } else {
            $_SESSION["message"] = $lang['FAQ_DELETE_FALSE'];
            App::redirect("faq.php");
        }
    }
}