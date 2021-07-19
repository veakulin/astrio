<?php

function isStructureValid(&$struct) {
    
    $result = true;
    $openTagPattern = "/^<[a-zA-Z]+>$/";
    $closeTagPattern = "/^<\/[a-zA-Z]+>$/";
    $wayBack = array();

    foreach ($struct as &$tag) {
        if (preg_match($openTagPattern, $tag)) {
            $backStep = str_replace("<", "</", $tag);
            array_unshift($wayBack, $backStep);
        }
        elseif (preg_match($closeTagPattern, $tag)) {
            if ((sizeof($wayBack) != 0) && ($wayBack[0] == $tag)) {
                array_shift($wayBack);
            }
            else {
                $result = false;
                break;
            }
        }
        else {
            $result = false;
            break;
        }
    }
    
    if (sizeof($wayBack) != 0) {
        $result = false;
    }
    
    return $result;    
}

function checkStruct(&$struct) {
    if (isStructureValid($struct)) {
        echo "Valid!\n";
    }
    else {
        echo "Invalid!\n";
    }
}

$validStruct   = array("<a>", "<b>", "<c>", "</c>", "</b>", "</a>", "<d>", "</d>");
$invalidStruct = array("<a>", "<b>", "<c>", "</c>", "</b>", "</a>", "<d>");

checkStruct($validStruct);
checkStruct($invalidStruct);

