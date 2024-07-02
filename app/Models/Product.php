<?php

namespace App\Models;

use PDO;

class Product
{
    public static function getAll()
    {
        require __DIR__ . '/../../config/db.php';
        
        $stmt = $pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        require __DIR__ . '/../../config/db.php';

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
