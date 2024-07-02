<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>
    <ul>
        <?php if (!empty($cartItems)) : ?>
            <?php foreach ($cartItems as $item) : ?>
                <li>
                    <?= htmlspecialchars($item['name']) ?> - $<?= htmlspecialchars($item['price']) ?> 
                    Quantity: <?= htmlspecialchars($item['quantity']) ?>
                    <a href="index.php?action=add&id=<?= $item['id'] ?>">Add</a>
                    <a href="index.php?action=remove&id=<?= $item['id'] ?>">Remove</a>
                    <a href="index.php?action=delete&id=<?= $item['id'] ?>">Delete</a>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li>Your cart is empty.</li>
        <?php endif; ?>
    </ul>
    <a href="index.php">Continue Shopping</a>
</body>
</html>
