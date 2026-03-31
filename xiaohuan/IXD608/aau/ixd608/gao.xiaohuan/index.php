<?php
// Example product data (can later come from database)
$products = [
  ["name" => "Dog Toy", "price" => "$12", "img" => "img/dog1.jpg"],
  ["name" => "Cat Bed", "price" => "$35", "img" => "img/cat1.jpg"],
  ["name" => "Dog Food", "price" => "$25", "img" => "img/dog2.jpg"],
  ["name" => "Pet Bowl", "price" => "$15", "img" => "img/bowl.jpg"]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Paws & Whiskers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="../lib/css/styleguide.css" />
  <link rel="stylesheet" href="../lib/css/gridsystem.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>

<!-- NAVBAR -->
<header class="navbar">
  <div class="container nav-flex">
    <div class="logo">🐾 Logo</div>

    <nav>
      <a href="#">Shop</a>
      <a href="#">Categories</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
    </nav>

    <div class="cart">🛒 Cart</div>
  </div>
</header>


<!-- HERO SECTION -->
<section class="hero">
  <div class="container hero-content">
    <h1>Welcome to Paws & Whiskers!</h1>
    <p>Everything Your Pet Needs.</p>
    <a href="#" class="btn">Shop Now</a>
  </div>
</section>


<!-- FEATURED PRODUCTS -->
<section class="container">
  <h2 class="section-title">Featured Products</h2>

  <div class="product-grid">
    <?php foreach($products as $product): ?>
      <div class="product-card">
        <img src="<?php echo $product['img']; ?>" alt="">
        <h3><?php echo $product['name']; ?></h3>
        <p><?php echo $product['price']; ?></p>
        <button class="btn small">View Product</button>
      </div>
    <?php endforeach; ?>
  </div>
</section>


<!-- BENEFITS -->
<section class="benefits">
  <div class="container benefit-grid">
    <div>🌿 Natural Ingredients</div>
    <div>✔ Vet Recommended</div>
    <div>🚚 Fast Shipping</div>
    <div>↩ Easy Returns</div>
  </div>
</section>


<!-- PROMO -->
<section class="promo">
  <p>Special Offer – Shop Now & Save!</p>
</section>


<!-- FOOTER -->
<footer class="footer">
  <div class="container footer-grid">
    <div>
      <h4>Links</h4>
      <p>Shop</p>
      <p>About</p>
      <p>Contact</p>
    </div>

    <div>
      <h4>Contact Info</h4>
      <p>Email: info@paws.com</p>
      <p>Phone: (123) 456-7890</p>
    </div>

    <div>
      <h4>Social</h4>
      <p>Instagram</p>
      <p>Facebook</p>
      <p>Twitter</p>
    </div>
  </div>
</footer>

</body>
</html>