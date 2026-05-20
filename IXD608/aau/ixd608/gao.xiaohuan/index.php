<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paws &amp; Whiskers</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="lib/css/styleguide.css">
  <link rel="stylesheet" href="lib/css/gridsystem.css">
  <link rel="stylesheet" href="css/storetheme.css">


    <style>
    .product-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 28px;
      align-items: stretch;
    }

    .product-card {
      display: flex;
      flex-direction: column;
      height: 100%;
      text-align: center;
    }

    .product-card img {
      width: 100%;
      height: 225px;
      object-fit: cover;
      display: block;
    }

    .product-card h3 {
      min-height: 78px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      margin-bottom: 10px;
    }

    .product-card .price {
      min-height: 32px;
      margin-bottom: 24px;
    }

    .product-card .btn {
      margin-top: auto;
      align-self: center;
    }

    @media (max-width: 1000px) {
      .product-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .product-grid {
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
        <a href="shop.php#shop">Shop</a>
        <a href="index.php#categories">Categories</a>
        <a href="index.php#about">About</a>
        <a href="checkout.php">Checkout</a>
        <a href="index.php#contact">Contact</a>
      </nav>

      <a class="nav-cta" href="cart.php">View Cart</a>
    </div>
  </header>

  <section class="hero" id="top">
    <div class="container hero-content">
      <h1>Thoughtful Picks for Happy Pets</h1>
      <p>Premium food, toys, beds, and essentials for dogs and cats.</p>
      <a href="#shop" class="btn primary">Shop Now</a>
    </div>
  </section>

  <section class="section" id="categories">
    <div class="container">
      <h2 class="section-title">Popular Categories</h2>

      <div class="grid gap">
        <div class="grid-col-4">Dog Food</div>
        <div class="grid-col-4">Cat Toys</div>
        <div class="grid-col-4">Pet Beds</div>
      </div>
    </div>
  </section>

  <section class="section" id="shop">
    <div class="container">
      <h2 class="section-title">Featured Products</h2>

      <div class="product-grid">
        <div class="product-card">
          <img src="img/grass dog food.jpg" alt="Grass-Fed Dog Food">
          <h3>Grass-Fed Dog Food</h3>
          <p class="price">$85</p>
          <a href="product.php?id=0" class="btn secondary">View Product</a>
        </div>

        <div class="product-card">
          <img src="img/cat bed.jpg" alt="Soft Cat Bed">
          <h3>Soft Cat Bed</h3>
          <p class="price">$35</p>
          <a href="product.php?id=3" class="btn secondary">View Product</a>
        </div>

        <div class="product-card">
          <img src="img/dog bed.jpg" alt="Orthopedic Dog Bed">
          <h3>Orthopedic Dog Bed</h3>
          <p class="price">$40</p>
          <a href="product.php?id=6" class="btn secondary">View Product</a>
        </div>

        <div class="product-card">
          <img src="img/Stoneware Feeding Bowl.jpg" alt="Stoneware Feeding Bowl">
          <h3>Stoneware Feeding Bowl</h3>
          <p class="price">$18</p>
          <a href="product.php?id=9" class="btn secondary">View Product</a>
        </div>
      </div>
    </div>
  </section>

  <section class="section benefits">
    <div class="container">
      <div class="flex-grid">
        <div class="flex-col-4">Natural Ingredients</div>
        <div class="flex-col-4">Fast Shipping</div>
        <div class="flex-col-4">Easy Returns</div>
      </div>
    </div>
  </section>

  <section class="section" id="about">
    <div class="container">
      <h2 class="section-title">About Us</h2>

      <p class="about-text">
        Paws &amp; Whiskers brings together stylish, practical, and trusted pet essentials
        to make everyday care easier for modern pet families.
      </p>
    </div>
  </section>

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
        <a href="shop.php">Shop</a>
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