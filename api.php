<?php

$listJson = file_get_contents("list.json");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    if (isset($_POST['id'])) {
        $list = json_decode($listJson, true);

        $newToDo = [
            'id' => (int) $_POST['id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'done' => (bool) $_POST['done']
        ];
        $list[] = $newToDo;

        $listJson = json_encode($list, JSON_PRETTY_PRINT);
        file_put_contents('list.json', $listJson);
    }
}



header("Content-Type: application/json");
echo $listJson;
