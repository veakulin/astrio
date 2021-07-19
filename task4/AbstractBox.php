<?php

include "Box.php";

abstract class AbstractBox implements Box {

    protected static $instance;
    protected string $connStr;
    protected mixed $data;
    
    protected function __construct() {
        $this->data = array();
    }        
   
    public function getData($key) {
        $result = null;
        if (array_key_exists($key, $this->data)) {
            $result = $this->data[$key];
        }
        return $result;
    }

    public function setData($key, $value) {
        $this->data[$key] = $value;
    }
}
