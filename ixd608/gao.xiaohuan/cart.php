<?php
session_start();
require_once "data products.php";

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $action = $_POST["action"] ?? "";

  if ($action === "add") {
    $productId = isset($_POST["product_id"]) ? (int)$_POST["product_id"] : -1;
    $quantity = isset($_POST["quantity"]) ? max(1, (int)$_POST["quantity"]) : 1;
    $product = getProductById($productId, $products);

    if ($product) {
      $selectedOption = trim($_POST["option"] ?? "");

      if (!in_array($selectedOption, $product["options"], true)) {
        $selectedOption = $product["options"][0];
      }

      $cartKey = $productId . "|" . $selectedOption;

      if (isset($_SESSION["cart"][$cartKey])) {
        $_SESSION["cart"][$cartKey]["quantity"] += $quantity;
      } else {
        $_SESSION["cart"][$cartKey] = [
          "product_id" => $productId,
          "name" => $product["name"],
          "price" => $product["price"],
          "img" => $product["img"],
          "option_label" => $product["options_label"],
          "option" => $selectedOption,
          "quantity" => $quantity
        ];
      }
    }

    header("Location: cart.php");
    exit;
  }

  if ($action === "update" && isset($_POST["quantities"])) {
    foreach ($_POST["quantities"] as $key => $qty) {
      if (isset($_SESSION["cart"][$key])) {
        $qty = (int)$qty;
        if ($qty <= 0) {
          unset($_SESSION["cart"][$key]);
        } else {
          $_SESSION["cart"][$key]["quantity"] = $qty;
        }
      }
    }

    header("Location: cart.php");
    exit;
  }

  if ($action === "remove" && isset($_POST["key"])) {
    $key = $_POST["key"];
    unset($_SESSION["cart"][$key]);

    header("Location: cart.php");
    exit;
  }

  if ($action === "clear") {
    $_SESSION["cart"] = [];

    header("Location: cart.php");
    exit;
  }
}

$cartItems = $_SESSION["cart"];
$subtotal = 0;

foreach ($cartItems as $item) {
  $subtotal += $item["price"] * $item["quantity"];
}

$shipping = count($cartItems) > 0 ? 8.00 : 0.00;
$total = $subtotal + $shipping;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart | Paws &amp; Whiskers</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="lib/css/styleguide.css">
  <link rel="stylesheet" href="lib/css/gridsystem.css">
  <link rel="stylesheet" href="css/storetheme.css">

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: "Inter", sans-serif;
      background: #f9fafb;
      color: #1f2933;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .site-header,
    .site-footer {
      background: #fff;
      border-bottom: 1px solid #e5e7eb;
    }

    .site-footer {
      border-top: 1px solid #e5e7eb;
      border-bottom: none;
      margin-top: 60px;
    }

    .nav-shell,
    .footer-grid {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
      padding: 18px 0;
      flex-wrap: wrap;
    }

    .site-nav {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    a {
      text-decoration: none;
      color: #34425c;
    }

    .nav-cta,
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 170px;
      height: 48px;
      padding: 0 20px;
      border-radius: 999px;
      font-size: 16px;
      font-weight: 600;
      border: 1px solid #34425c;
      cursor: pointer;
      background: #fff;
      color: #34425c;
      text-decoration: none;
    }

    .btn.primary,
    .nav-cta {
      background: #34425c;
      color: #fff;
    }

    .cart-page {
      padding: 60px 0;
    }

    h1 {
      font-family: "Fraunces", serif;
      font-size: 42px;
      color: #34425c;
      margin-bottom: 24px;
    }

    .cart-layout {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 30px;
      align-items: start;
    }

    .cart-list,
    .summary-card,
    .empty-card {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 20px;
      padding: 24px;
    }

    .cart-item {
      display: grid;
      grid-template-columns: 110px 1fr auto;
      gap: 18px;
      padding: 20px 0;
      border-bottom: 1px solid #e5e7eb;
      align-items: center;
    }

    .cart-item:last-child {
      border-bottom: none;
    }

    .cart-item img {
      width: 110px;
      height: 110px;
      object-fit: cover;
      border-radius: 16px;
    }

    .cart-item h3 {
      font-size: 20px;
      margin-bottom: 8px;
      color: #34425c;
    }

    .meta {
      color: #6b7280;
      font-size: 14px;
      margin-bottom: 8px;
    }

    .price {
      font-weight: 700;
      margin-bottom: 10px;
    }

    input[type="number"] {
      width: 84px;
      padding: 10px;
      border: 1px solid #d1d5db;
      border-radius: 10px;
      margin-top: 6px;
    }

    .item-actions {
      display: flex;
      flex-direction: column;
      gap: 10px;
      align-items: flex-end;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 14px;
      font-size: 17px;
    }

    .summary-total {
      display: flex;
      justify-content: space-between;
      font-size: 22px;
      font-weight: 700;
      padding-top: 16px;
      border-top: 1px solid #e5e7eb;
      margin-top: 16px;
    }

    .summary-actions,
    .cart-buttons {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      margin-top: 20px;
    }

    .remove-form {
      margin: 0;
    }

    .remove-form .btn {
      min-width: 120px;
      height: 42px;
      padding: 0 16px;
    }

    .empty-card p {
      color: #6b7280;
      margin-bottom: 18px;
    }

    @media (max-width: 900px) {
      .cart-layout {
        grid-template-columns: 1fr;
      }

      .cart-item {
        grid-template-columns: 90px 1fr;
      }

      .item-actions {
        grid-column: 1 / -1;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>

<header class="site-header">
  <div class="container nav-shell">
    <a href="index.php"><strong>Paws &amp; Whiskers</strong></a>

    <nav class="site-nav">
      <a href="shop.php">Shop</a>
      <a href="cart.php">Cart</a>
      <a href="checkout.php">Checkout</a>
    </nav>

    <a class="nav-cta" href="checkout.php">Checkout</a>
  </div>
</header>

<main class="cart-page">
  <div class="container">
    <h1>Your Cart</h1>

    <?php if (!empty($cartItems)): ?>
      <div class="cart-layout">
        <div class="cart-list">
          <form method="post" action="cart.php">
            <input type="hidden" name="action" value="update">

            <?php foreach ($cartItems as $key => $item): ?>
              <div class="cart-item">
                <img src="<?php echo htmlspecialchars($item["img"]); ?>" alt="<?php echo htmlspecialchars($item["name"]); ?>">

                <div>
                  <h3><?php echo htmlspecialchars($item["name"]); ?></h3>

                  <div class="meta">
                    <?php echo htmlspecialchars($item["option_label"]); ?>:
                    <?php echo htmlspecialchars($item["option"]); ?>
                  </div>

                  <div class="price"><?php echo formatPrice($item["price"]); ?></div>

                  <label for="qty_<?php echo md5($key); ?>">Quantity</label>
                  <input
                    type="number"
                    id="qty_<?php echo md5($key); ?>"
                    min="1"
                    name="quantities[<?php echo htmlspecialchars($key); ?>]"
                    value="<?php echo (int)$item["quantity"]; ?>"
                  >
                </div>

                <div class="item-actions">
                  <div><?php echo formatPrice($item["price"] * $item["quantity"]); ?></div>
                </div>
              </div>
            <?php endforeach; ?>

            <div class="cart-buttons">
              <button type="submit" class="btn">Update Cart</button>
              <a href="shop.php" class="btn">Continue Shopping</a>
            </div>
          </form>

          <div class="cart-buttons">
            <?php foreach ($cartItems as $key => $item): ?>
              <form class="remove-form" method="post" action="cart.php">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="key" value="<?php echo htmlspecialchars($key); ?>">
                <button class="btn" type="submit">Remove <?php echo htmlspecialchars($item["name"]); ?></button>
              </form>
            <?php endforeach; ?>
          </div>
        </div>

        <aside class="summary-card">
          <h2 style="margin-bottom:20px; color:#34425c;">Order Summary</h2>

          <div class="summary-row">
            <span>Subtotal</span>
            <span><?php echo formatPrice($subtotal); ?></span>
          </div>

          <div class="summary-row">
            <span>Shipping</span>
            <span><?php echo formatPrice($shipping); ?></span>
          </div>

          <div class="summary-total">
            <span>Total</span>
            <span><?php echo formatPrice($total); ?></span>
          </div>

          <div class="summary-actions">
            <a href="checkout.php" class="btn primary">Proceed to Checkout</a>

            <form method="post" action="cart.php">
              <input type="hidden" name="action" value="clear">
              <button type="submit" class="btn">Clear Cart</button>
            </form>
          </div>
        </aside>
      </div>
    <?php else: ?>
      <div class="empty-card">
        <p>Your cart is empty.</p>
        <a href="shop.php" class="btn primary">Shop Now</a>
      </div>
    <?php endif; ?>
  </div>
</main>

<footer class="site-footer" id="contact">
  <div class="container footer-grid">
    <div>
      <a class="brand footer-brand" href="index.php#top">
        <span class="brand-mark">PW</span>
        <span class="brand-copy">
          <strong>Paws &amp; Whiskers</strong>
          <span>Curated care for modern pet homes</span>
        </span>
      </a>
    </div>

    <div>
      <h3>Visit</h3>
      <p>hello@pawsandwhiskers.com</p>
      <p>(123) 456-7890</p>
    </div>

    <div>
      <h3>Explore</h3>
      <a href="index.php#shop">Shop</a>
      <a href="index.php#categories">Categories</a>
      <a href="index.php#about">About</a>
    </div>

    <div>
      <h3>Follow</h3>
      <p>Instagram</p>
      <p>Facebook</p>
      <p>TikTok</p>
    </div>
  </div>
</footer>

</body>
</html>