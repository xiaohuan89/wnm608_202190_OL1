<?php
session_start();
require_once "data products.php";

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = [];
}

$cartCount = 0;
foreach ($_SESSION["cart"] as $cartItem) {
  $cartCount += (int)$cartItem["quantity"];
}

$order = $_SESSION["order"] ?? null;

if (!$order) {
  header("Location: shop.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmed | Paws &amp; Whiskers</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="lib/css/styleguide.css">
  <link rel="stylesheet" href="lib/css/gridsystem.css">
  <link rel="stylesheet" href="css/storetheme.css">

  <style>
    .confirm-page {
      padding: 70px 0 80px;
      min-height: 60vh;
      background: #f9fafb;
    }

    .confirm-card {
      max-width: 900px;
      margin: 0 auto;
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      padding: 42px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }

    .confirm-card h1 {
      font-family: "Fraunces", serif;
      font-size: 42px;
      color: #34425c;
      margin-bottom: 14px;
    }

    .confirm-card p {
      margin-bottom: 12px;
      color: #4b5563;
      line-height: 1.6;
    }

    .order-list {
      margin-top: 24px;
    }

    .order-line {
      padding: 14px 0;
      border-bottom: 1px solid #e5e7eb;
      color: #4b5563;
      line-height: 1.6;
    }

    .order-total {
      margin-top: 20px;
      font-size: 18px;
    }

    .cart-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 24px;
      height: 24px;
      padding: 0 7px;
      margin-left: 8px;
      border-radius: 999px;
      background: #f4c542;
      color: #34425c;
      font-size: 13px;
      font-weight: 700;
    }

    @media (max-width: 900px) {
      .confirm-card {
        padding: 30px;
      }

      .confirm-card h1 {
        font-size: 34px;
      }
    }
  </style>
</head>

<body>

  <header class="site-header">
    <div class="container nav-shell">
      <a class="brand" href="index.php#top" aria-label="Paws and Whiskers home">
        <span class="brand-mark">PW</span>
        <span class="brand-copy">
          <strong>Paws &amp; Whiskers</strong>
          <span>Modern essentials for happy pets</span>
        </span>
      </a>

      <nav class="site-nav" aria-label="Primary">
        <a href="index.php#shop">Shop</a>
        <a href="index.php#categories">Categories</a>
        <a href="index.php#about">About</a>
        <a href="checkout.php">Checkout</a>
        <a href="index.php#contact">Contact</a>
      </nav>

      <a class="nav-cta" href="cart.php">
        View Cart
        <?php if ($cartCount > 0): ?>
          <span class="cart-badge"><?php echo $cartCount; ?></span>
        <?php endif; ?>
      </a>
    </div>
  </header>

  <main class="confirm-page">
    <div class="container">
      <div class="confirm-card">
        <h1>Thank you for your order!</h1>

        <p>Your order has been placed successfully.</p>

        <p><strong>Name:</strong> <?php echo htmlspecialchars($order["name"]); ?></p>

        <p><strong>Email:</strong> <?php echo htmlspecialchars($order["email"]); ?></p>

        <p>
          <strong>Shipping Address:</strong>
          <?php
            echo htmlspecialchars(
              $order["address"] . ", " . $order["city"] . ", " . $order["state"] . " " . $order["zip"]
            );
          ?>
        </p>

        <div class="order-list">
          <?php foreach ($order["items"] as $item): ?>
            <div class="order-line">
              <div><strong><?php echo htmlspecialchars($item["name"]); ?></strong></div>
              <div>Qty: <?php echo (int)$item["quantity"]; ?></div>

              <?php if (!empty($item["options"])): ?>
                <?php foreach ($item["options"] as $optionName => $value): ?>
                  <div>
                    <?php echo ucfirst(htmlspecialchars($optionName)); ?>:
                    <?php echo htmlspecialchars($value); ?>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>

        <p class="order-total">
          <strong>Total:</strong> <?php echo formatPrice($order["total"]); ?>
        </p>

        <a class="btn secondary" href="shop.php">Continue Shopping</a>
      </div>
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