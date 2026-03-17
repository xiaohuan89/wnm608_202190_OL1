<?php include("parts/header.php"); ?>
<?php include("parts/nav.php"); ?>

<div class="container">
  <h2>Checkout</h2>

  <div class="grid gap">

    <!-- Form -->
    <div class="col-8">
      <form>
        <input type="text" placeholder="Full Name" class="form-input">
        <input type="text" placeholder="Address" class="form-input">
        <input type="email" placeholder="Email" class="form-input">
      </form>
    </div>

    <!-- Summary -->
    <div class="col-4">
      <?php include("parts/order-summary.php"); ?>
    </div>

  </div>

  <a href="confirmation.php" class="btn primary">Place Order</a>
</div>

<?php include("parts/footer.php"); ?>