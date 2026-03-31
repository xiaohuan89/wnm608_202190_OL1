
<?php include("parts/header.php"); ?>
<?php include("parts/nav.php"); ?>

<div class="container">
  <h2>Shop All Products</h2>

  <div class="grid gap">

    <!-- Sidebar -->
    <div class="col-4">
      <div class="card">
        <h3>Filters</h3>
        <p>Category / Price / Type</p>
      </div>
    </div>

    <!-- Products -->
    <div class="col-8">
      <div class="grid gap">
        <div class="col-4"><?php include("parts/product-card.php"); ?></div>
        <div class="col-4"><?php include("parts/product-card.php"); ?></div>
        <div class="col-4"><?php include("parts/product-card.php"); ?></div>
      </div>
    </div>

  </div>
</div>

<?php include("parts/footer.php"); ?>