<?php

require_once "controllers/main.php";
require_once "views/layout.php";

$controller = new Main();
$layout = new Layout();

$mainData = $controller->render();

$layout->render($mainData);
