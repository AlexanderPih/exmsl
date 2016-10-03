<?php
namespace exmsl;
use exmsl\App;
use PDO;

class Adminfaq extends Faq {

    public $id;

    public function checkId(){
        if($_GET['id']) {
            $this->id = $_GET['id'];
        } else {
            App::redirect('admin.php');
        }
    }

    public function updateFaq($input, $inputid) {
        global $lang;
        $pdo = new Database();

        if(isset($input)) {
            $id       = $inputid;
            $langue   = $input['language'];
            $question = $input['question'];
            $answer   = $input['answer'];

            $sql  = "UPDATE faq SET ";
            $sql .= "langue = '{$langue}', ";
            $sql .= "question = '{$question}', ";
            $sql .= "answer = '{$answer}' ";
            $sql .= "WHERE id = '{$id}' ";
            $sql .= "LIMIT 1";

            $result = $pdo->query($sql);
            $result->execute();

            if($result){
                $_SESSION['message'] = $lang['FAQ_EDITED'];
                App::redirect('faq.php');
            } else {
                return $message = $lang['FAQ_EDIT_FAILED'];
            }
        }
    }
    
    public function newFaq($data) {
        global $lang;
        
        $langue = $data["language"];
        $question = $data["question"];
        $answer = $data["answer"];
        
        $pdo = new Database();
        
        $sql  = "INSERT INTO faq (";
        $sql .= " langue, question, answer ";
        $sql .= ") VALUES (";
        $sql .= " :langue, :question, :$answer ";
        $sql .= ")";
        $statement = $pdo->insert($sql);

        $statement->bindParam(':langue', $langue);
        $statement->bindParam(':question', $question);
        $statement->bindParam(':answer', $answer);

        $result = $statement->execute();
        
        if($result) {
            $_SESSION["message"] = $lang['FAQ_CREATED'];
            App::redirect("faq.php");
        } else {
            $_SESSION["message"] = $lang['FAQ_FAILED'];
            App::redirect("faq.php");
        }
    }
}