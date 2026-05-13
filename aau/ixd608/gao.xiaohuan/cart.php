<?php
session_start();
require_once "data products.php";

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = [];
}

/* Count cart items for badge */
$cartCount = 0;
foreach ($_SESSION["cart"] as $cartItem) {
  $cartCount += (int)$cartItem["quantity"];
}

/* Handle cart actions */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $action = $_POST["action"] ?? "";

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

    if (isset($_SESSION["cart"][$key])) {
      unset($_SESSION["cart"][$key]);
    }

    header("Location: cart.php");
    exit;
  }

  if ($action === "clear") {
    $_SESSION["cart"] = [];

    header("Location: cart.php");
    exit;
  }
}

/* Calculate totals */
$cartItems = $_SESSION["cart"];
$subtotal = 0;

foreach ($cartItems as $item) {
  $subtotal += (float)$item["price"] * (int)$item["quantity"];
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
    .cart-page {
      padding: 60px 0 80px;
    }

    .cart-page h1 {
      font-family: "Fraunces", serif;
      font-size: 48px;
      color: #34425c;
      margin-bottom: 32px;
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
      border-radius: 18px;
      padding: 24px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
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
      border-radius: 14px;
    }

    .cart-item h3 {
      font-family: "Fraunces", serif;
      font-size: 22px;
      color: #34425c;
      margin-bottom: 8px;
    }

    .meta {
      color: #6b7280;
      font-size: 14px;
      margin-bottom: 8px;
    }

    .price {
      color: #111827;
      font-weight: 700;
      margin-bottom: 10px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #34425c;
    }

    input[type="number"] {
      width: 84px;
      padding: 10px;
      border: 1px solid #d1d5db;
      border-radius: 10px;
      font-size: 16px;
    }

    .item-actions {
      display: flex;
      flex-direction: column;
      gap: 10px;
      align-items: flex-end;
    }

    .item-total {
      font-size: 18px;
      font-weight: 700;
      color: #34425c;
    }

    .cart-buttons,
    .summary-actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      margin-top: 20px;
    }

    .summary-card h2 {
      font-family: "Fraunces", serif;
      color: #34425c;
      margin-bottom: 20px;
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

    .remove-form {
      margin: 0;
    }

    .remove-form .btn {
      min-width: 120px;
      height: 42px;
      padding: 0 16px;
      font-size: 14px;
    }

    .empty-card p {
      color: #6b7280;
      margin-bottom: 18px;
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
      .cart-layout {
        grid-template-columns: 1fr;
      }

      .cart-item {
        grid-template-columns: 90px 1fr;
      }

      .cart-item img {
        width: 90px;
        height: 90px;
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
                  <img 
                    src="<?php echo htmlspecialchars($item["img"]); ?>" 
                    alt="<?php echo htmlspecialchars($item["name"]); ?>"
                  >

                  <div>
                    <h3><?php echo htmlspecialchars($item["name"]); ?></h3>

                    <?php if (!empty($item["options"])): ?>
                      <div class="meta">
                        <?php foreach ($item["options"] as $optionName => $value): ?>
                          <div>
                            <?php echo ucfirst(htmlspecialchars($optionName)); ?>:
                            <?php echo htmlspecialchars($value); ?>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>

                    <?php if (!empty($item["option_label"]) && !empty($item["option"])): ?>
                      <div class="meta">
                        <?php echo htmlspecialchars($item["option_label"]); ?>:
                        <?php echo htmlspecialchars($item["option"]); ?>
                      </div>
                    <?php endif; ?>

                    <div class="price">
                      <?php echo formatPrice($item["price"]); ?> each
                    </div>

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
                    <div class="item-total">
                      <?php echo formatPrice((float)$item["price"] * (int)$item["quantity"]); ?>
                    </div>

                    <button
                      type="submit"
                      form="remove_<?php echo md5($key); ?>"
                      class="btn secondary"
                    >
                      Remove
                    </button>
                  </div>
                </div>
              <?php endforeach; ?>

              <div class="cart-buttons">
                <button type="submit" class="btn secondary">Update Cart</button>
                <a href="shop.php" class="btn secondary">Continue Shopping</a>
              </div>
            </form>

            <?php foreach ($cartItems as $key => $item): ?>
              <form 
                id="remove_<?php echo md5($key); ?>" 
                class="remove-form" 
                method="post" 
                action="cart.php"
              >
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="key" value="<?php echo htmlspecialchars($key); ?>">
              </form>
            <?php endforeach; ?>
          </div>

          <aside class="summary-card">
            <h2>Order Summary</h2>

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
                <button type="submit" class="btn secondary">Clear Cart</button>
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