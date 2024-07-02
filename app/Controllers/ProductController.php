<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    public function index()
    {
        $products = Product::getAll();
        $cartItems = $this->getCartItems();
        include __DIR__ . '/../Views/product_list.php';
    }

    public function addToCart($productId)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Ürün bilgilerini al
        $product = Product::getById($productId);

        if ($product) {
            $cartQuantity = $_SESSION['cart'][$productId] ?? 0;

            // Stok kontrolü
            if ($cartQuantity < $product['stock']) {
                if (!isset($_SESSION['cart'][$productId])) {
                    $_SESSION['cart'][$productId] = 1;
                } else {
                    $_SESSION['cart'][$productId]++;
                }

                $this->setFlash('Product added to cart', 'success');
            } else {
                $this->setFlash('Product stock limit reached', 'warning');
            }
        } else {
            $this->setFlash('Product not found', 'error');
        }

        header('Location: index.php');
        exit();
    }

    public function removeFromCart($productId)
    {
        if (isset($_SESSION['cart'][$productId])) {
            if ($_SESSION['cart'][$productId] > 1) {
                $_SESSION['cart'][$productId]--;
            } else {
                unset($_SESSION['cart'][$productId]);
            }

            $this->setFlash('Product removed from cart', 'warning');
        }

        header('Location: index.php');
        exit();
    }

    public function deleteFromCart($productId)
    {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);

            $this->setFlash('Product deleted from cart', 'error');
        }

        header('Location: index.php');
        exit();
    }

    private function getCartItems()
    {
        $cartItems = [];
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $allProducts = Product::getAll();
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                foreach ($allProducts as $product) {
                    if ($product['id'] == $productId) {
                        $product['quantity'] = $quantity;
                        $cartItems[] = $product;
                        break;
                    }
                }
            }
        }
        return $cartItems;
    }

    private function setFlash($message, $type)
    {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }

    public static function getFlash()
    {
        if (isset($_SESSION['flash_message'])) {
            $message = [
                'message' => $_SESSION['flash_message'],
                'type' => $_SESSION['flash_type']
            ];
            unset($_SESSION['flash_message']);
            unset($_SESSION['flash_type']);
            return $message;
        }
        return null;
    }
}
