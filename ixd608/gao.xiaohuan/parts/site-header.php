<?php
$currentPage = $currentPage ?? 'home';

$navItems = [
    'home' => ['label' => 'Home', 'href' => 'index.php'],
    'shop' => ['label' => 'Shop', 'href' => 'shop.php'],
    'categories' => ['label' => 'Categories', 'href' => 'categories.php'],
    'about' => ['label' => 'About', 'href' => 'about.php'],
    'contact' => ['label' => 'Contact', 'href' => 'contact.php'],
];
?>
<header class="site-header">
  <div class="container nav-shell">
    <a class="brand" href="index.php" aria-label="Paws and Whiskers home">
      <span class="brand-mark">PW</span>
      <span class="brand-copy">
        <strong>Paws &amp; Whiskers</strong>
        <span>Modern essentials for happy pets</span>
      </span>
    </a>

    <nav class="site-nav" aria-label="Primary">
      <?php foreach ($navItems as $key => $item): ?>
        <a class="<?= $currentPage === $key ? 'is-active' : '' ?>" href="<?= htmlspecialchars($item['href']) ?>">
          <?= htmlspecialchars($item['label']) ?>
        </a>
      <?php endforeach; ?>
    </nav>

    <a class="nav-cta<?= $currentPage === 'cart' ? ' is-active' : '' ?>" href="cart.php">View Cart</a>
  </div>
</header>