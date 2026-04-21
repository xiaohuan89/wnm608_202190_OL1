<?php
session_start();
require_once "data products.php";

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
  <style>
    * { box-sizing:border-box; margin:0; padding:0; }
    body { font-family:"Inter",sans-serif; background:#f9fafb; color:#1f2933; }
    .container { max-width:900px; margin:0 auto; padding:0 20px; }
    .confirm-page { padding:80px 0; }
    .card {
      background:#fff; border:1px solid #e5e7eb; border-radius:24px; padding:36px;
    }
    h1 { font-family:"Fraunces",serif; font-size:42px; color:#34425c; margin-bottom:14px; }
    p { margin-bottom:12px; color:#4b5563; }
    .order-line { padding:12px 0; border-bottom:1px solid #e5e7eb; }
    .btn {
      display:inline-block; margin-top:24px; padding:12px 18px; border-radius:999px;
      background:#34425c; color:#fff; text-decoration:none; font-weight:600;
    }
  </style>
</head>
<body>
<main class="confirm-page">
  <div class="container">
    <div class="card">
      <h1>Thank you for your order!</h1>
      <p>Your order has been placed successfully.</p>
      <p><strong>Name:</strong> <?php echo htmlspecialchars($order["name"]); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($order["email"]); ?></p>
      <p><strong>Shipping Address:</strong>
        <?php
          echo htmlspecialchars(
            $order["address"] . ", " . $order["city"] . ", " . $order["state"] . " " . $order["zip"]
          );
        ?>
      </p>

      <div style="margin-top:24px;">
        <?php foreach ($order["items"] as $item): ?>
          <div class="order-line">
            <div><strong><?php echo htmlspecialchars($item["name"]); ?></strong></div>
            <div>Qty: <?php echo (int)$item["quantity"]; ?></div>
            <?php if (!empty($item["options"])): ?>
              <?php foreach ($item["options"] as $optionName => $value): ?>
                <div><?php echo ucfirst(htmlspecialchars($optionName)); ?>: <?php echo htmlspecialchars($value); ?></div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>

      <p style="margin-top:20px;"><strong>Total:</strong> <?php echo formatPrice($order["total"]); ?></p>

      <a class="btn" href="shop.php">Continue Shopping</a>
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