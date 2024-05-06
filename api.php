<?php

$listJson = file_get_contents("list.json");

/* $list = json_decode($filecontent, true); */

header("Content-Type: application/json");
echo $listJson;
