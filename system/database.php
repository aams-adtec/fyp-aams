<?php

$config = json_decode(file_get_contents(__DIR__ . "/database.json"));

$db = new mysqli($config->host, $config->user, $config->pass, $config->database);

function esc($str) { global $db; return $db->escape_string($str); }
function uesc($str) {
    return str_replace('\\', '', $str);
}

function post($id) {
    return esc(filter_input(INPUT_POST, $id));
}
?>