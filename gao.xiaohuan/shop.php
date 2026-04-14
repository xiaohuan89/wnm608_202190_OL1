<?php
$products = [
  [
    "name" => "Grass-Fed Dog Food",
    "price" => "$85",
    "category" => "Nutrition",
    "img" => "img/grass dog food.jpg",
    "id" => 0
  ],
  [
    "name" => "Cat Toy Set",
    "price" => "$22",
    "category" => "Play",
    "img" => "img/cat toy set.jpg",
    "id" => 1
  ],
  [
    "name" => "Interactive Cat Ball",
    "price" => "$18",
    "category" => "Play",
    "img" => "img/cat ball.jpg",
    "id" => 2
  ],
  [
    "name" => "Soft Cat Bed",
    "price" => "$35",
    "category" => "Home",
    "img" => "img/cat bed.jpg",
    "id" => 3
  ],
  [
    "name" => "Dog Leash",
    "price" => "$20",
    "category" => "Walk",
    "img" => "img/dog leash.jpg",
    "id" => 4
  ],
  [
    "name" => "Dog Harness",
    "price" => "$28",
    "category" => "Walk",
    "img" => "img/dog harness.jpg",
    "id" => 5
  ],
  [
    "name" => "Orthopedic Dog Bed",
    "price" => "$40",
    "category" => "Home",
    "img" => "img/dog bed.jpg",
    "id" => 6
  ],
  [
    "name" => "Dog Toy Pack",
    "price" => "$25",
    "category" => "Play",
    "img" => "img/dog toys.jpg",
    "id" => 7
  ],
  [
    "name" => "Classic Pet Bed",
    "price" => "$30",
    "category" => "Home",
    "img" => "img/bed.jpg",
    "id" => 8
  ],
  [
    "name" => "Stoneware Feeding Bowl",
    "price" => "$18",
    "category" => "Feeding",
    "img" => "img/Stoneware Feeding Bowl.jpg",
    "id" => 9
  ]
];
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
      margin-bottom: 40px;
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
      font-size: 28px;
      line-height: 1.2;
      color: #34425c;
      min-height: 68px;
      margin-bottom: 8px;
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

    .logo,
    .cart,
    .logo a,
    .cart a {
      text-decoration: none;
      color: #3c4b68;
    }

    .footer a {
      color: #555;
      text-decoration: none;
      display: block;
      margin-bottom: 10px;
    }

    .footer a:hover,
    .nav-links a:hover,
    .cart a:hover {
      text-decoration: underline;
    }

    @media (max-width: 1100px) {
      .shop-grid {
        grid-template-columns: repeat(3, 1fr);
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
      .shop-grid {
        grid-template-columns: 1fr;
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

      <a class="nav-cta" href="cart.php">View Cart</a>
    </div>
  </header>


  <main class="shop-page">
    <div class="container">
      <section class="shop-intro">
        <h1>Shop Our Favorites</h1>
        <p>Premium food, toys, beds, and essentials for dogs and cats.</p>
      </section>

      <section class="shop-grid">
        <?php foreach ($products as $item): ?>
          <article class="product-card">
            <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>">
            <h3><?php echo $item['name']; ?></h3>
            <p class="category"><?php echo $item['category']; ?></p>
            <p class="price"><?php echo $item['price']; ?></p>
            <a href="product.php?id=<?php echo $item['id']; ?>" class="btn secondary">View Product</a>
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


</body>
</html>