<?php
session_start();
require_once "data products.php";

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = [];
}

function checkoutPriceNumber($price) {
  if (is_numeric($price)) {
    return (float)$price;
  }

  return (float)str_replace(["$", ","], "", $price);
}

$cartItems = $_SESSION["cart"];

/* Cart badge count */
$cartCount = 0;
foreach ($cartItems as $cartItem) {
  $cartCount += (int)$cartItem["quantity"];
}

/* Calculate totals */
$subtotal = 0;

foreach ($cartItems as $item) {
  $subtotal += checkoutPriceNumber($item["price"]) * (int)$item["quantity"];
}

$shipping = count($cartItems) > 0 ? 8.00 : 0.00;
$total = $subtotal + $shipping;

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"] ?? "");
  $email = trim($_POST["email"] ?? "");
  $address = trim($_POST["address"] ?? "");
  $city = trim($_POST["city"] ?? "");
  $state = trim($_POST["state"] ?? "");
  $zip = trim($_POST["zip"] ?? "");

  if (empty($cartItems)) $errors[] = "Your cart is empty.";
  if ($name === "") $errors[] = "Please enter your full name.";
  if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please enter a valid email.";
  if ($address === "") $errors[] = "Please enter your address.";
  if ($city === "") $errors[] = "Please enter your city.";
  if ($state === "") $errors[] = "Please enter your state.";
  if ($zip === "") $errors[] = "Please enter your ZIP code.";

  if (empty($errors)) {
    $_SESSION["order"] = [
      "name" => $name,
      "email" => $email,
      "address" => $address,
      "city" => $city,
      "state" => $state,
      "zip" => $zip,
      "items" => $cartItems,
      "subtotal" => $subtotal,
      "shipping" => $shipping,
      "total" => $total
    ];

    $_SESSION["cart"] = [];

    header("Location: confirmation.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | Paws &amp; Whiskers</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="lib/css/styleguide.css">
  <link rel="stylesheet" href="lib/css/gridsystem.css">
  <link rel="stylesheet" href="css/storetheme.css">

  <style>
    .checkout-page {
      padding: 60px 0 80px;
    }

    .checkout-page h1 {
      font-family: "Fraunces", serif;
      font-size: 48px;
      color: #34425c;
      margin-bottom: 32px;
    }

    .checkout-layout {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 30px;
      align-items: start;
    }

    .form-card,
    .summary-card,
    .empty-card {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      padding: 24px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }

    .field {
      margin-bottom: 16px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #34425c;
    }

    input {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #d1d5db;
      border-radius: 12px;
      font-size: 16px;
      font-family: "Inter", sans-serif;
    }

    .row-3 {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 16px;
    }

    .summary-card h2 {
      font-family: "Fraunces", serif;
      color: #34425c;
      margin-bottom: 18px;
    }

    .summary-item {
      padding: 12px 0;
      border-bottom: 1px solid #e5e7eb;
    }

    .summary-item:last-child {
      border-bottom: none;
    }

    .summary-item-title {
      font-weight: 700;
      color: #34425c;
    }

    .summary-item-meta {
      color: #6b7280;
      font-size: 14px;
      margin-top: 4px;
    }

    .summary-item-price {
      margin-top: 6px;
      font-weight: 700;
      color: #111827;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-top: 14px;
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

    .error-box {
      background: #fef2f2;
      color: #991b1b;
      border: 1px solid #fecaca;
      padding: 14px 16px;
      border-radius: 14px;
      margin-bottom: 18px;
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
      .checkout-layout,
      .row-3 {
        grid-template-columns: 1fr;
      }

      .checkout-page h1 {
        font-size: 40px;
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

  <main class="checkout-page">
    <div class="container">
      <h1>Checkout</h1>

      <?php if (!empty($cartItems)): ?>
        <div class="checkout-layout">

          <section class="form-card">
            <?php if (!empty($errors)): ?>
              <div class="error-box">
                <?php foreach ($errors as $error): ?>
                  <div><?php echo htmlspecialchars($error); ?></div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <form method="post" action="checkout.php">
              <div class="field">
                <label for="name">Full Name</label>
                <input 
                  type="text" 
                  id="name" 
                  name="name" 
                  value="<?php echo htmlspecialchars($_POST["name"] ?? ""); ?>"
                >
              </div>

              <div class="field">
                <label for="email">Email</label>
                <input 
                  type="email" 
                  id="email" 
                  name="email" 
                  value="<?php echo htmlspecialchars($_POST["email"] ?? ""); ?>"
                >
              </div>

              <div class="field">
                <label for="address">Street Address</label>
                <input 
                  type="text" 
                  id="address" 
                  name="address" 
                  value="<?php echo htmlspecialchars($_POST["address"] ?? ""); ?>"
                >
              </div>

              <div class="row-3">
                <div class="field">
                  <label for="city">City</label>
                  <input 
                    type="text" 
                    id="city" 
                    name="city" 
                    value="<?php echo htmlspecialchars($_POST["city"] ?? ""); ?>"
                  >
                </div>

                <div class="field">
                  <label for="state">State</label>
                  <input 
                    type="text" 
                    id="state" 
                    name="state" 
                    value="<?php echo htmlspecialchars($_POST["state"] ?? ""); ?>"
                  >
                </div>

                <div class="field">
                  <label for="zip">ZIP Code</label>
                  <input 
                    type="text" 
                    id="zip" 
                    name="zip" 
                    value="<?php echo htmlspecialchars($_POST["zip"] ?? ""); ?>"
                  >
                </div>
              </div>

              <button type="submit" class="btn primary">Place Order</button>
            </form>
          </section>

          <aside class="summary-card">
            <h2>Order Summary</h2>

            <?php foreach ($cartItems as $item): ?>
              <div class="summary-item">
                <div class="summary-item-title">
                  <?php echo htmlspecialchars($item["name"]); ?>
                </div>

                <div class="summary-item-meta">
                  Qty: <?php echo (int)$item["quantity"]; ?>
                </div>

                <?php if (!empty($item["options"])): ?>
                  <div class="summary-item-meta">
                    <?php foreach ($item["options"] as $optionName => $value): ?>
                      <div>
                        <?php echo ucfirst(htmlspecialchars($optionName)); ?>:
                        <?php echo htmlspecialchars($value); ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>

                <?php if (!empty($item["option_label"]) && !empty($item["option"])): ?>
                  <div class="summary-item-meta">
                    <?php echo htmlspecialchars($item["option_label"]); ?>:
                    <?php echo htmlspecialchars($item["option"]); ?>
                  </div>
                <?php endif; ?>

                <div class="summary-item-price">
                  <?php echo formatPrice(checkoutPriceNumber($item["price"]) * (int)$item["quantity"]); ?>
                </div>
              </div>
            <?php endforeach; ?>

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
          </aside>

        </div>
      <?php else: ?>
        <div class="empty-card">
          <p>Your cart is empty. Add some products before checking out.</p>
          <a href="shop.php" class="btn primary">Go to Shop</a>
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