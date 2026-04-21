<?php
session_start();
require_once "data products.php";

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = [];
}

$cartItems = $_SESSION["cart"];
$subtotal = 0;

foreach ($cartItems as $item) {
  $subtotal += $item["price"] * $item["quantity"];
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
  <style>
    * { box-sizing:border-box; margin:0; padding:0; }
    body { font-family:"Inter",sans-serif; background:#f9fafb; color:#1f2933; }
    .container { max-width:1200px; margin:0 auto; padding:0 20px; }
    .site-header,.site-footer { background:#fff; border-bottom:1px solid #e5e7eb; }
    .site-footer { border-top:1px solid #e5e7eb; border-bottom:none; margin-top:60px; }
    .nav-shell,.footer-grid { display:flex; justify-content:space-between; align-items:center; gap:20px; padding:18px 0; flex-wrap:wrap; }
    .site-nav { display:flex; gap:20px; flex-wrap:wrap; }
    a { text-decoration:none; color:#34425c; }
    .nav-cta,.btn {
      display:inline-block; padding:12px 18px; border-radius:999px; font-weight:600;
      border:1px solid #34425c; cursor:pointer; background:#fff; color:#34425c;
    }
    .btn.primary,.nav-cta { background:#34425c; color:#fff; }
    .checkout-page { padding:60px 0; }
    h1 { font-family:"Fraunces",serif; font-size:42px; color:#34425c; margin-bottom:24px; }
    .checkout-layout { display:grid; grid-template-columns:2fr 1fr; gap:30px; align-items:start; }
    .form-card,.summary-card,.empty-card {
      background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:24px;
    }
    .field { margin-bottom:16px; }
    label { display:block; margin-bottom:8px; font-weight:600; }
    input {
      width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; font-size:16px;
    }
    .row-2 { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    .row-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; }
    .summary-item { padding:12px 0; border-bottom:1px solid #e5e7eb; }
    .summary-item:last-child { border-bottom:none; }
    .summary-row, .summary-total {
      display:flex; justify-content:space-between; margin-top:14px;
    }
    .summary-total { font-size:22px; font-weight:700; padding-top:16px; border-top:1px solid #e5e7eb; }
    .error-box {
      background:#fef2f2; color:#991b1b; border:1px solid #fecaca;
      padding:14px 16px; border-radius:14px; margin-bottom:18px;
    }
    @media (max-width:900px){
      .checkout-layout,.row-2,.row-3 { grid-template-columns:1fr; }
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
    <a class="nav-cta" href="cart.php">Back to Cart</a>
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

          <form method="post">
            <div class="field">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST["name"] ?? ""); ?>">
            </div>

            <div class="field">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST["email"] ?? ""); ?>">
            </div>

            <div class="field">
              <label for="address">Street Address</label>
              <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($_POST["address"] ?? ""); ?>">
            </div>

            <div class="row-3">
              <div class="field">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($_POST["city"] ?? ""); ?>">
              </div>

              <div class="field">
                <label for="state">State</label>
                <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($_POST["state"] ?? ""); ?>">
              </div>

              <div class="field">
                <label for="zip">ZIP Code</label>
                <input type="text" id="zip" name="zip" value="<?php echo htmlspecialchars($_POST["zip"] ?? ""); ?>">
              </div>
            </div>

            <button type="submit" class="btn primary">Place Order</button>
          </form>
        </section>

        <aside class="summary-card">
          <h2 style="margin-bottom:18px; color:#34425c;">Order Summary</h2>

          <?php foreach ($cartItems as $item): ?>
            <div class="summary-item">
              <div style="font-weight:600;"><?php echo htmlspecialchars($item["name"]); ?></div>
              <div style="color:#6b7280; font-size:14px;">Qty: <?php echo (int)$item["quantity"]; ?></div>
              <?php if (!empty($item["options"])): ?>
                <div style="color:#6b7280; font-size:14px;">
                  <?php foreach ($item["options"] as $optionName => $value): ?>
                    <div><?php echo ucfirst(htmlspecialchars($optionName)); ?>: <?php echo htmlspecialchars($value); ?></div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
              <div style="margin-top:6px;"><?php echo formatPrice($item["price"] * $item["quantity"]); ?></div>
            </div>
          <?php endforeach; ?>

          <div class="summary-row"><span>Subtotal</span><span><?php echo formatPrice($subtotal); ?></span></div>
          <div class="summary-row"><span>Shipping</span><span><?php echo formatPrice($shipping); ?></span></div>
          <div class="summary-total"><span>Total</span><span><?php echo formatPrice($total); ?></span></div>
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