<?php
$cart = [
  [
    "name" => "Grass-Fed Dog Food",
    "price" => 85,
    "quantity" => 1,
    "img" => "img/grass dog food.jpg"
  ],
  [
    "name" => "Cat Toy Set",
    "price" => 22,
    "quantity" => 1,
    "img" => "img/cat 1.jpg"
  ],
  [
    "name" => "Stoneware Feeding Bowl",
    "price" => 18,
    "quantity" => 2,
    "img" => "img/Stoneware Feeding Bowl.jpg"
  ]
];

$subtotal = 0;
foreach ($cart as $item) {
  $subtotal += $item["price"] * $item["quantity"];
}

$shipping = 10;
$tax = round($subtotal * 0.08, 2);
$total = $subtotal + $shipping + $tax;
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
      padding: 70px 0;
      background: #f9fafb;
    }

    .checkout-header {
      text-align: center;
      margin-bottom: 50px;
    }

    .checkout-header h1 {
      font-family: "Fraunces", serif;
      font-size: 48px;
      color: #34425c;
      margin-bottom: 12px;
    }

    .checkout-header p {
      color: #6b7280;
      font-size: 18px;
    }

    .checkout-layout {
      display: grid;
      grid-template-columns: 1.4fr 0.9fr;
      gap: 32px;
      align-items: start;
    }

    .checkout-card,
    .summary-card {
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      padding: 28px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }

    .section-title {
      font-family: "Fraunces", serif;
      font-size: 28px;
      color: #34425c;
      margin-bottom: 24px;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 18px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-bottom: 18px;
    }

    .form-group.full {
      grid-column: 1 / -1;
    }

    .form-group label {
      font-weight: 600;
      color: #34425c;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 14px 16px;
      border: 1px solid #d1d5db;
      border-radius: 10px;
      font-size: 15px;
      outline: none;
      background: #fff;
    }

    .form-group input:focus,
    .form-group select:focus {
      border-color: #34425c;
    }

    .cart-item {
      display: grid;
      grid-template-columns: 86px 1fr auto;
      gap: 16px;
      align-items: center;
      padding: 16px 0;
      border-bottom: 1px solid #e5e7eb;
    }

    .cart-item:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .cart-item img {
      width: 86px;
      height: 86px;
      object-fit: cover;
      border-radius: 12px;
      display: block;
    }

    .cart-item h3 {
      font-size: 20px;
      color: #34425c;
      margin-bottom: 6px;
      font-family: "Fraunces", serif;
    }

    .cart-item p {
      color: #6b7280;
      margin: 0;
    }

    .item-total {
      font-weight: 700;
      color: #111827;
      font-size: 18px;
    }

    .summary-lines {
      margin-top: 22px;
    }

    .summary-line,
    .summary-total {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
    }

    .summary-line {
      color: #4b5563;
      border-bottom: 1px solid #e5e7eb;
    }

    .summary-total {
      font-size: 22px;
      font-weight: 700;
      color: #111827;
      margin-top: 8px;
    }

    .btn-row {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      margin-top: 28px;
    }

    .btn-custom {
      display: inline-block;
      padding: 14px 24px;
      border-radius: 10px;
      font-weight: 700;
      text-decoration: none;
      border: none;
      cursor: pointer;
      font-size: 16px;
    }

    .btn-primary-custom {
      background: #34425c;
      color: #fff;
    }

    .btn-secondary-custom {
      background: #e5e7eb;
      color: #111827;
    }

    .secure-note {
      margin-top: 18px;
      font-size: 14px;
      color: #6b7280;
    }

    @media (max-width: 900px) {
      .checkout-layout {
        grid-template-columns: 1fr;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .checkout-header h1 {
        font-size: 38px;
      }
    }

    @media (max-width: 600px) {
      .cart-item {
        grid-template-columns: 1fr;
        text-align: center;
      }

      .cart-item img {
        margin: 0 auto;
      }

      .item-total {
        margin-top: 8px;
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

  <main class="checkout-page">
    <div class="container">
      <div class="checkout-header">
        <h1>Checkout</h1>
        <p>Complete your order and bring home the best for your pet.</p>
      </div>

      <div class="checkout-layout">

        <section class="checkout-card">
          <h2 class="section-title">Shipping Information</h2>

          <form action="confirmation.php" method="get">
            <div class="form-grid">
              <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first_name" placeholder="First name" required>
              </div>

              <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last_name" placeholder="Last name" required>
              </div>

              <div class="form-group full">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Email address" required>
              </div>

              <div class="form-group full">
                <label for="address">Street Address</label>
                <input type="text" id="address" name="address" placeholder="Street address" required>
              </div>

              <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder="City" required>
              </div>

              <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="State" required>
              </div>

              <div class="form-group">
                <label for="zip">ZIP Code</label>
                <input type="text" id="zip" name="zip" placeholder="ZIP code" required>
              </div>

              <div class="form-group">
                <label for="country">Country</label>
                <select id="country" name="country" required>
                  <option value="">Select country</option>
                  <option value="USA">United States</option>
                  <option value="Canada">Canada</option>
                </select>
              </div>

              <div class="form-group full">
                <label for="card">Card Number</label>
                <input type="text" id="card" name="card" placeholder="1234 5678 9012 3456" required>
              </div>

              <div class="form-group">
                <label for="expiry">Expiration Date</label>
                <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
              </div>

              <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="123" required>
              </div>
            </div>

            <div class="btn-row">
              <button type="submit" class="btn-custom btn-primary-custom">Place Order</button>
              <a href="cart.php" class="btn-custom btn-secondary-custom">Back to Cart</a>
            </div>

            <p class="secure-note">Secure checkout • Encrypted payment • Fast delivery</p>
          </form>
        </section>

        <aside class="summary-card">
          <h2 class="section-title">Order Summary</h2>

          <?php foreach ($cart as $item): ?>
            <div class="cart-item">
              <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>">
              <div>
                <h3><?php echo $item['name']; ?></h3>
                <p>Qty: <?php echo $item['quantity']; ?></p>
                <p>$<?php echo number_format($item['price'], 2); ?></p>
              </div>
              <div class="item-total">
                $<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
              </div>
            </div>
          <?php endforeach; ?>

          <div class="summary-lines">
            <div class="summary-line">
              <span>Subtotal</span>
              <span>$<?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="summary-line">
              <span>Shipping</span>
              <span>$<?php echo number_format($shipping, 2); ?></span>
            </div>
            <div class="summary-line">
              <span>Tax</span>
              <span>$<?php echo number_format($tax, 2); ?></span>
            </div>
            <div class="summary-total">
              <span>Total</span>
              <span>$<?php echo number_format($total, 2); ?></span>
            </div>
          </div>
        </aside>

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