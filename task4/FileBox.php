<?php

include "AbstractBox.php";

class FileBox extends AbstractBox {
    
    private function __construct() {
        parent::__construct();
        // Т.к. из задания непонятно, как вообще конфигурировать приложение,
        // просто захардкодим (знаю-знаю, так делать не нужно)
        $this->connStr = dirname(__FILE__)."/data.txt";
    }
    
    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function load() {
        $raw = unserialize(file_get_contents($this->connStr));
        if (($raw != NULL) && (gettype($raw) == "array" )) {
            $this->data = $raw;
        }
    }
    
    public function save() {
        file_put_contents($this->connStr, serialize($this->data));
    }    
}
