<?php
namespace exmsl;

use \PDO;
require_once(dirname(__DIR__) . '/config/initialize.php');


class Database extends PDO {

    public $connection;
    public $lastQuery;

    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $dbname;
    private $pdo;


    function __construct() {
        //$this->openConnection();
        require_once("../../config/config.php");
        $this->dbhost = DB_SERVER;
        $this->dbuser = DB_USER;
        $this->dbpass = DB_PASS;
        $this->dbname = DB_NAME;
    }

    private function openConnection() {
        if($this->pdo === null) {
            $pdo = new PDO("mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname . ";", $this->dbuser, $this->dbpass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($statement) {
        $this->lastQuery = $statement;
        $result = $this->openConnection()->query($statement);
        $this->confirm_query($result);

        return $result;
    }

    protected function confirm_query($result) {
        if(!$result) {
            $output  = "Database query failed: " . $this->connection->error . "<br><br>";
            // debug only!
            $output .= "Last SQL query: " . $this->lastQuery;
            die($output);
        }
    }
    public function prepare($statement, $attributes) {
        $req = $this->openConnection()->prepare($statement);
        $req->execute($attributes);
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function insert($statement)
    {
        $req = $this->openConnection()->prepare($statement);
        return $req;
    }
    
    /*// prepare strings for mysql
    public function mysqlPrep($string) {
        global $connection;
        $escapedString = mysqli_real_escape_string($connection, $string);
        return $escapedString;
    }*/

}