<?php
namespace exmsl;
use exmsl\App;
use PDO;

class Admin {
    
    protected $tableName = "admin";
    public $id;
    
    public function checkId(){
        if($_GET['id']) {
            $this->id = $_GET['id'];
        } else {
            App::redirect('admin.php');
        }
    }
    
    public function findAllAdmins() {
        $pdo = new Database();
        
        $sql  = "SELECT * ";
        $sql .= "FROM " . $this->tableName ." ";
        $sql .= "ORDER BY username ASC";
        $result = $pdo->query($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    public function getAdminById($id) {
        
        $pdo = new Database();
        
        $sql  = "SELECT * ";
        $sql .= "FROM admin ";
        $sql .= "WHERE id = '{$id}' ";
        $result = $pdo->query($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    /**
     * @param $admin Checks if admin entries are existent, if so displays them, otherwise shows a message that no entries are available
     */
    public function showAdmin($admin) {
        global $lang;

        if($admin) {
            foreach($admin as $result){
                $output  = "<div class=\"adminwrapper\">";
                $output .= "<div class=\"username\">";
                $output .= htmlentities($result["username"]);
                $output .= "</div>";
                $output .= "<div class=\"actions\">";
                $output .= "<a href=\"editadmin.php?id=".urlencode($result['id'])."\">".$lang['ADMIN_EDIT']." </a>";
                $output .= "<a href=\"deleteadmin.php?id=".urlencode($result['id'])."\" onclick=\"return confirm('".$lang['DELETE_QUESTION']."')\">".$lang['ADMIN_DELETE']."</a>";
                $output .= "</div>";
                $output .= "</div>";

                echo $output;
            }
        } else {
            $output = $lang['DB_NO_ADMIN'];

            echo $output;
        }
    }
    
    public function newAdmin($data) {
        global $lang;

        $pass1 = $data["password"];
        $pass2 = $data["passverify"];
        $user  = $data["username"];
        
        if($pass1 === $pass2) {

            $hashedPassword = password_hash($pass1, PASSWORD_DEFAULT);

            $pdo = new Database();

            $sql  = "INSERT INTO admin (";
            $sql .= " username, hashed_password ";
            $sql .= ") VALUES (";
            $sql .= " :user, :hashedPassword ";
            $sql .= ")";

            $statement = $pdo->insert($sql);

            $statement->bindParam(':user', $user);
            $statement->bindParam(':hashedPassword', $hashedPassword);

            $result = $statement->execute();

            if($result) {
                $_SESSION["message"] = $lang['ADMIN_CREATED'];
                App::redirect("admin.php");
            } else {
                $_SESSION["message"] = $lang['ADMIN_FAILED'];
                App::redirect("admin.php");
            }   

        } else {

            $_SESSION["message"] = $lang['PASSWORD_NO_MATCH'];
            App::redirect("newadmin.php");
        }
        
    }
    
    public function editAdmin($adminSet) {
        
        global $lang;
        
        if($adminSet) {
            foreach($adminSet as $result) {

            $output  = "<form id=\"form\" action=\"editadmin.php?id=".$result["id"]."\" method=\"post\">";
            $output .= "<label>".$lang['ADMIN_USERNAME'].":</label>";
            $output .= "<input name=\"username\" type=\"text\" value=\"".$result["username"]."\" required>";

            $output .= "<label>".$lang['ADMIN_FORM_PASSWORD']."</label>";
            $output .= "<input name=\"password\" type=\"password\" required>";

            $output .= "<label>".$lang['ADMIN_FORM_PASSWORD2']."</label>";
            $output .= "<input name=\"passverify\" type=\"password\" required>";

            $output .= "<input class=\"Asubmit\" name=\"submit\" type=\"submit\" value=\"".$lang['BUG_BUTTON_SUBMIT']."\">";
            $output .= "</form>";
                
            echo $output;

            }
        } else {
            $output  = "<section class=\"article\">";
            $output .= $lang['DB_ADMIN_NOT_FOUND'];
            $output .= "</section>";
            
            echo $output;
        }
    }
    
    public function delete($id) {
        
        global $lang;
        
        $pdo = new Database();

        $sql = "DELETE FROM admin WHERE id = '{$id}' LIMIT 1";
        $result = $pdo->query($sql);
        $result->execute();
        

        if($result) {
            $_SESSION["message"] = $lang['ADMIN_DELETE_TRUE'];
            App::redirect("admin.php");
        } else {
            $_SESSION["message"] = $lang['ADMIN_DELETE_FALSE'];
            App::redirect("admin.php");
        }
    }
}

