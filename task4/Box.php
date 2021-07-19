<?php

interface Box {
    public function load();
    public function save();
    public function getData($key);
    public function setData($key, $value);
}
