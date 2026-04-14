<?php
$pageTitle = 'Paws & Whiskers | Cart';
$currentPage = 'cart';
include __DIR__ . '/parts/site-head.php';
include __DIR__ . '/parts/site-header.php';
?>
<main>
  <section class="section page-hero">
    <div class="container">
      <p class="eyebrow">Cart</p>
      <h1 class="page-title">A clear review step between browsing and checkout.</h1>
      <p class="page-intro">This simple cart page keeps the site flow connected while you build out future checkout functionality.</p>
    </div>
  </section>

  <section class="section">
    <div class="container cart-grid">
      <div class="story-card">
        <p class="eyebrow">Your items</p>
        <h2>Current cart summary.</h2>
        <ul class="list-clean mini-list">
          <li><span>Grass-Fed Dog Food</span><strong>$25</strong></li>
          <li><span>Interactive Cat Toy Set</span><strong>$12</strong></li>
          <li><span>Stoneware Feeding Bowl</span><strong>$18</strong></li>
        </ul>
      </div>

      <div class="detail-card">
        <p class="eyebrow">Order total</p>
        <h3>$55</h3>
        <p>Shipping is free on orders over $50, so this sample cart already qualifies.</p>
        <div class="stack-actions">
          <a class="btn btn-primary" href="contact.php">Checkout Help</a>
          <a class="btn btn-outline" href="shop.php">Continue Shopping</a>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include("parts/footer.php"); ?>