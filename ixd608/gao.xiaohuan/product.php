<?php
session_start();
require_once "data products.php";

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = [];
}

$id = isset($_GET["id"]) ? (int)$_GET["id"] : -1;
$product = getProductById($id, $products);

if (!$product) {
  http_response_code(404);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $product) {
  $quantity = isset($_POST["quantity"]) ? max(1, (int)$_POST["quantity"]) : 1;

  $selectedOptions = [];
  if (!empty($product["options"])) {
    foreach ($product["options"] as $optionName => $choices) {
      $postedValue = $_POST["options"][$optionName] ?? "";
      if (in_array($postedValue, $choices, true)) {
        $selectedOptions[$optionName] = $postedValue;
      } else {
        $selectedOptions[$optionName] = $choices[0];
      }
    }
  }

  $cartKey = $product["id"] . "_" . md5(json_encode($selectedOptions));

  if (isset($_SESSION["cart"][$cartKey])) {
    $_SESSION["cart"][$cartKey]["quantity"] += $quantity;
  } else {
    $_SESSION["cart"][$cartKey] = [
      "key" => $cartKey,
      "id" => $product["id"],
      "name" => $product["name"],
      "price" => (float)$product["price"],
      "img" => $product["img"],
      "quantity" => $quantity,
      "options" => $selectedOptions
    ];
  }

  header("Location: cart.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $product ? htmlspecialchars($product["name"]) . " | Paws &amp; Whiskers" : "Product Not Found"; ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * { box-sizing:border-box; margin:0; padding:0; }
    body { font-family:"Inter",sans-serif; color:#1f2933; background:#f9fafb; }
    .container { max-width:1200px; margin:0 auto; padding:0 20px; }
    .site-header,.site-footer { background:#fff; border-bottom:1px solid #e5e7eb; }
    .site-footer { border-top:1px solid #e5e7eb; border-bottom:none; margin-top:70px; }
    .nav-shell,.footer-grid { display:flex; justify-content:space-between; align-items:center; gap:20px; padding:18px 0; flex-wrap:wrap; }
    .site-nav { display:flex; gap:20px; flex-wrap:wrap; }
    a { text-decoration:none; color:#34425c; }
    .nav-cta,.btn {
      display:inline-block; padding:12px 18px; border-radius:999px; font-weight:600;
      border:1px solid #34425c; cursor:pointer;
    }
    .btn.primary,.nav-cta { background:#34425c; color:#fff; }
    .btn.secondary { background:#fff; color:#34425c; }
    .product-page { padding:60px 0; }
    .product-layout { display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start; }
    .product-image img { width:100%; border-radius:18px; display:block; }
    .product-category { color:#6b7280; text-transform:uppercase; letter-spacing:.08em; font-size:14px; margin-bottom:10px; }
    h1 { font-family:"Fraunces",serif; font-size:42px; color:#34425c; margin-bottom:12px; }
    .product-price { font-size:28px; font-weight:700; margin-bottom:18px; }
    .product-description { font-size:18px; color:#4b5563; margin-bottom:28px; line-height:1.6; }
    .form-block { margin-bottom:18px; }
    label { display:block; margin-bottom:8px; font-weight:600; }
    select,input[type="number"] {
      width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; font-size:16px;
      background:#fff;
    }
    .product-actions { display:flex; gap:14px; flex-wrap:wrap; margin-top:20px; }
    .not-found { text-align:center; padding:80px 20px; }
    @media (max-width:900px){
      .product-layout { grid-template-columns:1fr; }
      h1 { font-size:34px; }
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
    <a class="nav-cta" href="cart.php">View Cart</a>
  </div>
</header>

<main class="product-page">
  <div class="container">
    <?php if ($product): ?>
      <div class="product-layout">
        <div class="product-image">
          <img src="<?php echo htmlspecialchars($product["img"]); ?>" alt="<?php echo htmlspecialchars($product["name"]); ?>">
        </div>

        <div class="product-info">
          <p class="product-category"><?php echo htmlspecialchars($product["category"]); ?></p>
          <h1><?php echo htmlspecialchars($product["name"]); ?></h1>
          <p class="product-price"><?php echo formatPrice($product["price"]); ?></p>
          <p class="product-description"><?php echo htmlspecialchars($product["description"]); ?></p>

          <form method="post">
            <?php if (!empty($product["options"])): ?>
              <?php foreach ($product["options"] as $optionName => $choices): ?>
                <div class="form-block">
                  <label for="option-<?php echo htmlspecialchars($optionName); ?>">
                    <?php echo ucfirst(htmlspecialchars($optionName)); ?>
                  </label>
                  <select name="options[<?php echo htmlspecialchars($optionName); ?>]" id="option-<?php echo htmlspecialchars($optionName); ?>">
                    <?php foreach ($choices as $choice): ?>
                      <option value="<?php echo htmlspecialchars($choice); ?>">
                        <?php echo htmlspecialchars($choice); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

            <div class="form-block">
              <label for="quantity">Quantity</label>
              <input type="number" name="quantity" id="quantity" min="1" value="1">
            </div>

            <div class="product-actions">
              <button type="submit" class="btn primary">Add to Cart</button>
              <a href="shop.php" class="btn secondary">Back to Shop</a>
            </div>
          </form>
        </div>
      </div>
    <?php else: ?>
      <section class="not-found">
        <h1>Product Not Found</h1>
        <p>The product you selected does not exist.</p>
        <a href="shop.php" class="btn secondary">Return to Shop</a>
      </section>
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