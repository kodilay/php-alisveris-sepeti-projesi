<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/helpers.php';

use App\Controllers\ProductController;

$controller = new ProductController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            if (isset($_GET['id'])) {
                $controller->addToCart($_GET['id']);
            }
            break;
        case 'remove':
            if (isset($_GET['id'])) {
                $controller->removeFromCart($_GET['id']);
            }
            break;
        case 'delete':
            if (isset($_GET['id'])) {
                $controller->deleteFromCart($_GET['id']);
            }
            break;
        default:
            $controller->index();
            break;
    }
} else {
    $controller->index();
}
