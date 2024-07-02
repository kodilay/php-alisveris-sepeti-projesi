<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="<?= assets('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= assets('css/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <style>
        .shopping-cart {
            background-color: #f8f9fa; /* Arka plan rengi */
            padding: 20px;
            border-radius: 10px;
            position: sticky;
            top: 20px;
        }
        .shopping-cart .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .icon-btn {
            font-size: 1.2rem;
            margin-left: 10px;
            cursor: pointer;
        }
        .container {
            max-width: 100%; /* Konteyner genişliğini tam yap */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 product-list">
                <h1 class="my-4">Product List</h1>
                <div class="row">
                    <?php foreach ($products as $product) : ?>
                        <div class="col-md-6">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">$<?= htmlspecialchars($product['price']) ?></h6>
                                    <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                                    <p class="card-text"><small class="text-muted">Stock: <?= htmlspecialchars($product['stock']) ?></small></p>
                                    <a href="index.php?action=add&id=<?= $product['id'] ?>" class="btn btn-primary add-to-cart">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="shopping-cart">
                    <h1 class="my-4">Shopping Cart</h1>
                    <ul class="list-group">
                        <?php if (!empty($cartItems)) : ?>
                            <?php foreach ($cartItems as $item) : ?>
                                <li class="list-group-item">
                                    <div>
                                        <h5><?= htmlspecialchars($item['name']) ?></h5>
                                        <h6 class="text-muted">$<?= htmlspecialchars($item['price']) ?></h6>
                                        <p><?= htmlspecialchars($item['description']) ?></p>
                                        <p>Quantity: <?= htmlspecialchars($item['quantity']) ?></p>
                                    </div>
                                    <div>
                                        <i class="bi bi-plus-lg icon-btn add-to-cart" data-href="index.php?action=add&id=<?= $item['id'] ?>"></i>
                                        <i class="bi bi-dash-lg icon-btn remove-from-cart" data-href="index.php?action=remove&id=<?= $item['id'] ?>"></i>
                                        <i class="bi bi-trash icon-btn delete-from-cart" data-href="index.php?action=delete&id=<?= $item['id'] ?>"></i>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="list-group-item">Your cart is empty.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="<?= assets('js/bootstrap.bundle.min.js') ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?= assets('js/sweetalert2.all.min.js') ?>"></script>
    <script>
        // Toast Notification Function
        function showToast(message, type) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                icon: type,
                title: message
            });
        }

        // Flash Message Handling
        <?php if ($flashMessage = \App\Controllers\ProductController::getFlash()) : ?>
            showToast('<?= $flashMessage['message'] ?>', '<?= $flashMessage['type'] ?>');
        <?php endif; ?>

        // Event Listeners for Cart Actions
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const href = this.getAttribute('href') || this.dataset.href;
                showToast('Product added to cart', 'success');
                setTimeout(() => {
                    window.location.href = href;
                }, 100);
            });
        });

        document.querySelectorAll('.remove-from-cart').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const href = this.getAttribute('href') || this.dataset.href;
                showToast('Product removed from cart', 'warning');
                setTimeout(() => {
                    window.location.href = href;
                }, 100);
            });
        });

        document.querySelectorAll('.delete-from-cart').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const href = this.getAttribute('href') || this.dataset.href;
                showToast('Product deleted from cart', 'error');
                setTimeout(() => {
                    window.location.href = href;
                }, 100);
            });
        });
    </script>
</body>
</html>
