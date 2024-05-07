<?php

$listJson = file_get_contents("list.json");

$method = $_SERVER['REQUEST_METHOD'];

/* with POST add new task */
if ($method === 'POST') {
    if (isset($_POST['id'])) {
        $list = json_decode($listJson, true);

        $newToDo = [
            'id' => (int) $_POST['id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'done' => false
        ];
        $list[] = $newToDo;

        $listJson = json_encode($list, JSON_PRETTY_PRINT);
        file_put_contents('list.json', $listJson);
    }
} /* with DELETE remove task */ elseif ($method === 'DELETE') {
    $list = json_decode($listJson, true);

    /* filter by ID */
    $obj = json_decode(file_get_contents('php://input'), true);
    foreach ($list as $index => $task) {
        if ($task['id'] === $obj['id']) {
            array_splice($list, $index, 1);
        }
    }
    $listJson = json_encode($list, JSON_PRETTY_PRINT);
    file_put_contents('list.json', $listJson);
} /* with PUT toggle task done */ elseif ($method === 'PUT') {
    $list = json_decode($listJson, true);

    /* filter by ID */
    $obj = json_decode(file_get_contents('php://input'), true);
    foreach ($list as $index => $task) {
        if ($task['id'] === $obj['id']) {
            $list[$index]['done'] = !$list[$index]['done'];
        }
    }

    $listJson = json_encode($list, JSON_PRETTY_PRINT);
    file_put_contents('list.json', $listJson);
}

header("Content-Type: application/json");
echo $listJson;
