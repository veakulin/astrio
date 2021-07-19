<?php

// Выбрал рекурсивный вариант, т.к. трудно представить дерево категорий такой вложенности, чтобы не хватило стека.
function searchCategory($categories, $id) {
    $name = NULL;
    foreach ($categories as $category) {
        if ($category["id"] == $id) {
            $name = $category["title"];
        }
        elseif (array_key_exists("children", $category)) {
            $name = searchCategory($category["children"], $id);
        }
        if ($name != NULL) {
            break;
        }
    }
    return $name;
}

// Данные прямо из задания
$categories = array(
    array(
        "id" => 1,
        "title" => "Обувь",
        "children" => array(
            array(
                "id" => 2,
                "title" => "Ботинки",
                "children" => array(
                    array("id" => 3, "title" => "Кожа"),
                    array("id" => 4, "title" => "Текстиль")
                )
            ),
            array("id" => 5, "title" => "Кроссовки")
        )
    ),
    array(
        "id" => 6,
        "title" => "Спорт",
        "children" => array(
            array("id" => 7, "title" => "Мячи")
        )
    )
);

echo searchCategory($categories, 1) . "\n";


