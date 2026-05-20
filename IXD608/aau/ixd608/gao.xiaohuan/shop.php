<?php
session_start();

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = [];
}

$cartCount = 0;
foreach ($_SESSION["cart"] as $cartItem) {
  $cartCount += (int)$cartItem["quantity"];
}

$products = [
  [
    "id" => 0,
    "name" => "Grass-Fed Dog Food",
    "price" => "$85",
    "category" => "Nutrition",
    "img" => "img/grass dog food.jpg",
    "description" => "A premium dry food made with grass-fed ingredients to support strong muscles, healthy digestion, and everyday energy for adult dogs."
  ],
  [
    "id" => 1,
    "name" => "Cat Toy Set",
    "price" => "$22",
    "category" => "Play",
    "img" => "img/cat toy set.jpg",
    "description" => "A fun bundle of soft and interactive toys designed to keep cats active, curious, and entertained throughout the day."
  ],
  [
    "id" => 2,
    "name" => "Interactive Cat Ball",
    "price" => "$18",
    "category" => "Play",
    "img" => "img/cat ball.jpg",
    "description" => "A lightweight rolling toy that encourages chasing, batting, and independent play for energetic cats."
  ],
  [
    "id" => 3,
    "name" => "Soft Cat Bed",
    "price" => "$35",
    "category" => "Home",
    "img" => "img/cat bed.jpg",
    "description" => "A plush and cozy bed with soft padding that gives cats a warm, secure place to nap and relax."
  ],
  [
    "id" => 4,
    "name" => "Dog Leash",
    "price" => "$20",
    "category" => "Walk",
    "img" => "img/dog leash.jpg",
    "description" => "A durable everyday leash made for comfortable walks, reliable control, and easy handling."
  ],
  [
    "id" => 5,
    "name" => "Dog Harness",
    "price" => "$28",
    "category" => "Walk",
    "img" => "img/dog harness.jpg",
    "description" => "A supportive harness that helps distribute pressure more evenly for safer and more comfortable walks."
  ],
  [
    "id" => 6,
    "name" => "Orthopedic Dog Bed",
    "price" => "$40",
    "category" => "Home",
    "img" => "img/dog bed.jpg",
    "description" => "A supportive orthopedic bed designed to cushion joints and provide extra comfort for resting dogs."
  ],
  [
    "id" => 7,
    "name" => "Dog Toy Pack",
    "price" => "$25",
    "category" => "Play",
    "img" => "img/dog toys.jpg",
    "description" => "A playful set of chew and toss toys made to keep dogs engaged, active, and mentally stimulated."
  ],
  [
    "id" => 8,
    "name" => "Classic Pet Bed",
    "price" => "$30",
    "category" => "Home",
    "img" => "img/bed.jpg",
    "description" => "A simple, comfortable pet bed that fits easily into any room and gives pets a soft place to rest."
  ],
  [
    "id" => 9,
    "name" => "Stoneware Feeding Bowl",
    "price" => "$18",
    "category" => "Feeding",
    "img" => "img/Stoneware Feeding Bowl.jpg",
    "description" => "A sturdy stoneware bowl with a clean modern look, ideal for serving food or water every day."
  ]
];

$categories = [];

foreach ($products as $item) {
  if (!in_array($item["category"], $categories)) {
    $categories[] = $item["category"];
  }
}

sort($categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop | Paws &amp; Whiskers</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="lib/css/styleguide.css">
  <link rel="stylesheet" href="lib/css/gridsystem.css">
  <link rel="stylesheet" href="css/storetheme.css">

  <style>
    .shop-page {
      padding: 60px 0 80px;
    }

    .shop-intro {
      text-align: center;
      margin-bottom: 36px;
    }

    .shop-intro h1 {
      font-family: "Fraunces", serif;
      font-size: 48px;
      color: #34425c;
      margin-bottom: 12px;
    }

    .shop-intro p {
      max-width: 700px;
      margin: 0 auto;
      color: #6b7280;
      font-size: 18px;
    }

    .shop-controls {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      padding: 20px;
      margin-bottom: 32px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }

    .controls-form {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr auto;
      gap: 16px;
      align-items: end;
    }

    .control-group label {
      display: block;
      margin-bottom: 8px;
      color: #34425c;
      font-weight: 700;
      font-size: 14px;
    }

    .control-group input,
    .control-group select {
      width: 100%;
      min-height: 48px;
      border: 1px solid #d1d5db;
      border-radius: 999px;
      padding: 0 16px;
      font-family: "Inter", sans-serif;
      font-size: 15px;
      color: #1f2933;
      background: #fff;
    }

    .control-buttons {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .control-buttons .btn {
      white-space: nowrap;
    }

    .results-count {
      margin-top: 16px;
      color: #6b7280;
      font-size: 15px;
    }

    .shop-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      align-items: stretch;
    }

    .product-card {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      padding: 18px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .product-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 14px;
      display: block;
    }

    .product-card h3 {
      font-family: "Fraunces", serif;
      font-size: 18px;
      line-height: 1.2;
      color: #34425c;
      margin-bottom: 8px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .product-card .category {
      min-height: 28px;
      margin-bottom: 12px;
      color: #6b7280;
      font-size: 18px;
    }

    .product-card .price {
      min-height: 36px;
      display: block;
      margin-bottom: 16px;
      color: #111827;
      font-size: 18px;
      font-weight: 700;
    }

    .product-card .btn {
      margin-top: auto;
      align-self: flex-start;
    }

    .empty-results {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      padding: 36px;
      text-align: center;
      color: #6b7280;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
      grid-column: 1 / -1;
    }

    .empty-results h2 {
      font-family: "Fraunces", serif;
      color: #34425c;
      margin-bottom: 10px;
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

    @media (max-width: 1100px) {
      .shop-grid {
        grid-template-columns: repeat(3, 1fr);
      }

      .controls-form {
        grid-template-columns: 1fr 1fr;
      }

      .control-buttons {
        grid-column: 1 / -1;
      }
    }

    @media (max-width: 900px) {
      .shop-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .shop-intro h1 {
        font-size: 40px;
      }
    }

    @media (max-width: 600px) {
      .shop-grid,
      .controls-form {
        grid-template-columns: 1fr;
      }

      .shop-intro h1 {
        font-size: 34px;
      }

      .control-buttons {
        flex-direction: column;
        align-items: stretch;
      }

      .control-buttons .btn {
        width: 100%;
        text-align: center;
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

  <main class="shop-page">
    <div class="container">
      <section class="shop-intro">
        <h1>Shop Our Favorites</h1>
        <p>Premium food, toys, beds, and essentials for dogs and cats.</p>
      </section>

      <section class="shop-controls">
        <form class="controls-form">
          <div class="control-group">
            <label for="search">Search Products</label>
            <input
              type="search"
              id="search"
              name="search"
              placeholder="Search food, toys, beds..."
            >
          </div>

          <div class="control-group">
            <label for="category">Filter by Category</label>
            <select id="category" name="category">
              <option value="all">All Categories</option>
              <?php foreach ($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars($cat); ?>">
                  <?php echo htmlspecialchars($cat); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="control-group">
            <label for="sort">Sort Products</label>
            <select id="sort" name="sort">
              <option value="default">Default</option>
              <option value="price-low">Price: Low to High</option>
              <option value="price-high">Price: High to Low</option>
              <option value="name-az">Name: A to Z</option>
              <option value="name-za">Name: Z to A</option>
            </select>
          </div>

          <div class="control-buttons">
            <button type="submit" class="btn primary">Apply</button>
            <a href="shop.php" class="btn secondary">Reset</a>
          </div>
        </form>

        <p class="results-count">
          Showing <?php echo count($products); ?> of <?php echo count($products); ?> products
        </p>
      </section>

      <section class="shop-grid">
        <?php foreach ($products as $item): ?>
          <article 
            class="product-card"
            data-name="<?php echo htmlspecialchars($item["name"]); ?>"
            data-category="<?php echo htmlspecialchars($item["category"]); ?>"
            data-price="<?php echo htmlspecialchars(str_replace(["$", ","], "", $item["price"])); ?>"
            data-description="<?php echo htmlspecialchars($item["description"]); ?>"
          >
            <img 
              src="<?php echo htmlspecialchars($item["img"]); ?>" 
              alt="<?php echo htmlspecialchars($item["name"]); ?>"
            >

            <h3><?php echo htmlspecialchars($item["name"]); ?></h3>

            <p class="category">
              <?php echo htmlspecialchars($item["category"]); ?>
            </p>

            <p class="price">
              <?php echo htmlspecialchars($item["price"]); ?>
            </p>

            <a href="product.php?id=<?php echo (int)$item["id"]; ?>" class="btn secondary">
              View Product
            </a>
          </article>
        <?php endforeach; ?>
      </section>
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

  <script src="js/product_list.js"></script>
</body>
</html>