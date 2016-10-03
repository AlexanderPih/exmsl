<?php
namespace exmsl;

use \PDO;
require_once(dirname(__DIR__) . '/config/initialize.php');

class Login {

    protected static $tableName = "admin";
    private $username;
    private $password;

    public function __construct(){
        if(!empty($_POST)){
            $this->username = $_POST['username'];
            $this->password = $_POST['password'];
        } else {
            $this->password = '';
            $this->username = '';
        }
    }

    public function attemptLogin(){
        $admin = $this->getAdminByUsername($this->username);

        if($admin){
            if(password_verify($this->password, $admin->hashed_password)){
                $_SESSION['adminId']  = $admin->id;
                $_SESSION['username'] = $admin->username;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function getAdminByUsername(){
        $pdo = new Database();
        $username = $this->username;

        $sql  = "SELECT * ";
        $sql .= "FROM admin ";
        $sql .= "WHERE username = '{$username}' ";

        $result = $pdo->query($sql);
        $result->execute();
        $result = $result->fetchObject(__CLASS__);

        return $result;

    }
}
