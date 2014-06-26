<?php

require_once 'models/Professor.php';

$professor = Professor::find(1234);
$professors = Professor::all();

foreach ($professors as $pro) {
    var_dump($pro->name());
}