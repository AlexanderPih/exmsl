<?php
namespace exmsl;
require_once(dirname(__DIR__) . '/config/initialize.php');

class DatabaseObject extends Database {

    protected static $tableName;

    public static function find_by_sql($sql = "") {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    /**
     * Not used ... ?
     * @param $attribute
     * @return bool
     */
    private function has_attribute($attribute) {
        // get_object_vars returns an associative array with all attributes (incl. private ones!) as the key and their current values as the value
        $object_vars = get_object_vars($this);
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $object_vars);
    }

    /**
     * Instantiates an object
     * @param $record
     * @return mixed
     */
    private static function instantiate($record) {

        $class_name = get_called_class();
        $object = new $class_name;

        foreach($record as $attribute=>$value) {
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }
}