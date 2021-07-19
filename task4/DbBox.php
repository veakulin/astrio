<?php

include "AbstractBox.php";

// Здесь пока еще не совсем разобрался, каким образом PHP управлянт подключениями
// Класс заточен под SQLite, но по хорошему надо бы сделать фабрику
// для создания объектов доступа к данным под разные СУБД
class DbBox extends AbstractBox {

    private function __construct() {
        parent::__construct();
        $this->connStr = "sqlite:".dirname(__FILE__)."/data.sqlite3";
    }
    
    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function load() {
        $conn = $this->getConnection();
        $result = $conn->query('select value from option where name = "data"')->fetch();
        $raw = unserialize($result["value"]);
        if (($raw != NULL) && (gettype($raw) == "array")) {
            $this->data = $raw;
        }
    }

    public function save() {
        $conn = $this->getConnection();
        $rawData = serialize($this->data);
        $updateQuery = $conn->prepare('UPDATE option SET value = ? WHERE name = "data";');
        $insertQuery = $conn->prepare(' INSERT INTO option (name, value) SELECT "data", ? WHERE NOT EXISTS(SELECT 1 FROM option WHERE name = "data");');
        $updateQuery->execute(array($rawData));
        $insertQuery->execute(array($rawData));
    }    
    
    private function getConnection() {
        return new PDO($this->connStr);
    }

}