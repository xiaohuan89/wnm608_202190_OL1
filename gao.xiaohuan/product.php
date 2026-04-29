<?php
session_start();
require_once "data products.php";

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = [];
}

/* Cart badge count */
$cartCount = 0;
foreach ($_SESSION["cart"] as $cartItem) {
  $cartCount += (int)$cartItem["quantity"];
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

  <title>
    <?php echo $product ? htmlspecialchars($product["name"]) . " | Paws &amp; Whiskers" : "Product Not Found"; ?>
  </title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="lib/css/styleguide.css">
  <link rel="stylesheet" href="lib/css/gridsystem.css">
  <link rel="stylesheet" href="css/storetheme.css">

  <style>
    .product-page {
      padding: 60px 0 80px;
    }

    .product-layout {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: start;
    }

    .product-image img {
      width: 100%;
      border-radius: 18px;
      display: block;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }

    .product-category {
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: .08em;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .product-info h1,
    .not-found h1 {
      font-family: "Fraunces", serif;
      font-size: 42px;
      color: #34425c;
      margin-bottom: 12px;
    }

    .product-price {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 18px;
      color: #111827;
    }

    .product-description {
      font-size: 18px;
      color: #4b5563;
      margin-bottom: 28px;
      line-height: 1.6;
    }

    .form-block {
      margin-bottom: 18px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #34425c;
    }

    select,
    input[type="number"] {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #d1d5db;
      border-radius: 12px;
      font-size: 16px;
      background: #fff;
      font-family: "Inter", sans-serif;
    }

    .product-actions {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      margin-top: 20px;
    }

    .not-found {
      text-align: center;
      padding: 80px 20px;
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }

    .not-found p {
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
      .product-layout {
        grid-template-columns: 1fr;
      }

      .product-info h1,
      .not-found h1 {
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

  <main class="product-page">
    <div class="container">
      <?php if ($product): ?>
        <div class="product-layout">
          <div class="product-image">
            <img 
              src="<?php echo htmlspecialchars($product["img"]); ?>" 
              alt="<?php echo htmlspecialchars($product["name"]); ?>"
            >
          </div>

          <div class="product-info">
            <p class="product-category">
              <?php echo htmlspecialchars($product["category"]); ?>
            </p>

            <h1><?php echo htmlspecialchars($product["name"]); ?></h1>

            <p class="product-price">
              <?php echo formatPrice($product["price"]); ?>
            </p>

            <p class="product-description">
              <?php echo htmlspecialchars($product["description"]); ?>
            </p>

            <form method="post" action="product.php?id=<?php echo (int)$product["id"]; ?>">
              <?php if (!empty($product["options"])): ?>
                <?php foreach ($product["options"] as $optionName => $choices): ?>
                  <div class="form-block">
                    <label for="option-<?php echo htmlspecialchars($optionName); ?>">
                      <?php echo ucfirst(htmlspecialchars($optionName)); ?>
                    </label>

                    <select 
                      name="options[<?php echo htmlspecialchars($optionName); ?>]" 
                      id="option-<?php echo htmlspecialchars($optionName); ?>"
                    >
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