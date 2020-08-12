<?php

use W1019\DbTable;

include "src/autoload.php";

$table = new DbTable(
    new mysqli( // 1 параметр из конструктора
        "localhost",
        "root",
        "root",
        "cp"
    ),
    "table124" // 2 параметр из конструктора
);

// print_r($table->get());

// echo $table->add(["Text" => "hello", "Name" => "Jack"]);
// echo $table->add(["Text" => "hi", "Name" => "Egor"]);

$table->edit(7, ["Text" => "wow", "Name" => "Jackkk"]);

$table->del(12);