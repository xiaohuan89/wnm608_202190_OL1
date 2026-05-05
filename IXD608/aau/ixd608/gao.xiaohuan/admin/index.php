<?php
$products = [
  [
    "id" => 1,
    "name" => "Grass-Fed Dog Food",
    "category" => "Nutrition",
    "price" => 85.00,
    "sizes" => "4 lb, 12 lb, 24 lb",
    "stock" => 24,
    "status" => "Active",
    "img" => "../img/grass dog food.jpg"
  ],
  [
    "id" => 2,
    "name" => "Cat Ball",
    "category" => "Toys",
    "price" => 18.00,
    "sizes" => "One Size",
    "stock" => 18,
    "status" => "Active",
    "img" => "../img/cat ball.jpg"
  ],
  [
    "id" => 3,
    "name" => "Dog Leash",
    "category" => "Accessories",
    "price" => 20.00,
    "sizes" => "One Size",
    "stock" => 9,
    "status" => "Low Stock",
    "img" => "../img/dog leash.jpg"
  ],
  [
    "id" => 4,
    "name" => "Cat Toy Set",
    "category" => "Toys",
    "price" => 22.00,
    "sizes" => "Small, Large",
    "stock" => 15,
    "status" => "Active",
    "img" => "../img/cat toy set.jpg"
  ],
  [
    "id" => 5,
    "name" => "Soft Cat Bed",
    "category" => "Accessories",
    "price" => 18.00,
    "sizes" => "One Size",
    "stock" => 18,
    "status" => "Active",
    "img" => "../img/cat bed.jpg"
  ],
  [
    "id" => 6,
    "name" => "Dog Harness",
    "category" => "Accessories",
    "price" => 28.00,
    "sizes" => "One Size",
    "stock" => 18,
    "status" => "Active",
    "img" => "../img/dog harness.jpg"
  ],
  [
    "id" => 7,
    "name" => "Orthopedic Dog Bed",
    "category" => "Accessories",
    "price" => 40.00,
    "sizes" => "One Size",
    "stock" => 11,
    "status" => "Active",
    "img" => "../img/dog bed.jpg"
  ]
];

$totalProductsCount = count($products);
$activeProductsCount = 0;
$lowStockProductsCount = 0;
$categories = [];

foreach ($products as $product) {
  if ($product["status"] === "Active") {
    $activeProductsCount++;
  }

  if ($product["status"] === "Low Stock") {
    $lowStockProductsCount++;
  }

  $categories[] = $product["category"];
}

$categoryCount = count(array_unique($categories));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Admin | Paws & Whiskers</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../lib/css/styleguide.css">
  <link rel="stylesheet" href="../lib/css/gridsystem.css">
  <link rel="stylesheet" href="../css/storetheme.css">

  <style>
    .admin-page {
      background: #f6f3ee;
      padding: 50px 0 80px;
    }

    .admin-header-block {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 24px;
      margin-bottom: 28px;
    }

    .admin-header-block h1 {
      font-family: "Fraunces", serif;
      font-size: 42px;
      color: #34425c;
      margin-bottom: 10px;
    }

    .admin-header-block p {
      color: #6b7280;
      font-size: 17px;
      line-height: 1.6;
    }

    .admin-note {
      display: inline-block;
      background: #fff7d6;
      color: #34425c;
      padding: 8px 14px;
      border-radius: 999px;
      font-size: 14px;
      font-weight: 700;
      margin-bottom: 16px;
    }

    .admin-warning {
      background: #fff7d6;
      border: 1px solid #f4c542;
      color: #34425c;
      padding: 16px 18px;
      border-radius: 16px;
      margin-bottom: 28px;
      line-height: 1.5;
    }

    .summary-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px;
      margin-bottom: 28px;
    }

    .summary-card {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      padding: 22px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }

    .summary-card span {
      display: block;
      color: #6b7280;
      font-size: 14px;
      margin-bottom: 8px;
    }

    .summary-card strong {
      font-size: 30px;
      color: #34425c;
      font-family: "Fraunces", serif;
    }

    .admin-panel {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      padding: 28px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
      margin-bottom: 28px;
    }

    .panel-header {
      margin-bottom: 24px;
    }

    .panel-header h2 {
      font-family: "Fraunces", serif;
      color: #34425c;
      font-size: 28px;
      margin-bottom: 8px;
    }

    .panel-header p {
      color: #6b7280;
      line-height: 1.5;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 18px;
    }

    .form-block {
      margin-bottom: 0;
    }

    .form-block.full {
      grid-column: span 2;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #34425c;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #d1d5db;
      border-radius: 12px;
      font-size: 16px;
      background: #fff;
      font-family: "Inter", sans-serif;
    }

    textarea {
      min-height: 120px;
      resize: vertical;
    }

    input:focus,
    select:focus,
    textarea:focus {
      outline: 2px solid #f4c542;
      border-color: #f4c542;
    }

    .form-actions {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      margin-top: 22px;
    }

    .table-wrapper {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 900px;
    }

    th {
      text-align: left;
      background: #f3f4f6;
      color: #34425c;
      padding: 14px;
      font-size: 14px;
    }

    td {
      padding: 14px;
      border-bottom: 1px solid #e5e7eb;
      color: #374151;
      font-size: 14px;
      vertical-align: middle;
    }

    .product-cell {
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 700;
      color: #34425c;
    }

    .product-cell img {
      width: 54px;
      height: 54px;
      object-fit: cover;
      border-radius: 12px;
      background: #f3f4f6;
    }

    .status {
      display: inline-block;
      padding: 7px 11px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 700;
    }

    .status.active {
      background: #dff3e3;
      color: #28723c;
    }

    .status.low-stock {
      background: #fff0c9;
      color: #946600;
    }

    .status.hidden {
      background: #e7e7e7;
      color: #555;
    }

    .status.out-of-stock {
      background: #ffe0dc;
      color: #a93425;
    }

    .action-buttons {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .mini-btn {
      border: none;
      border-radius: 10px;
      padding: 8px 11px;
      font-weight: 700;
      cursor: pointer;
      font-family: "Inter", sans-serif;
    }

    .edit-btn {
      background: #e8f0ff;
      color: #34425c;
    }

    .hide-btn {
      background: #fff0c9;
      color: #946600;
    }

    .delete-btn {
      background: #ffe0dc;
      color: #a93425;
    }

    .edit-btn:hover,
    .hide-btn:hover,
    .delete-btn:hover {
      opacity: 0.8;
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
      .admin-header-block {
        flex-direction: column;
        align-items: flex-start;
      }

      .summary-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .form-block.full {
        grid-column: span 1;
      }
    }

    @media (max-width: 600px) {
      .summary-grid {
        grid-template-columns: 1fr;
      }

      .admin-header-block h1 {
        font-size: 34px;
      }
    }
  </style>
</head>

<body>

  <header class="site-header">
    <div class="container nav-shell">
      <a class="brand" href="../index.php#top" aria-label="Paws and Whiskers home">
        <span class="brand-mark">PW</span>
        <span class="brand-copy">
          <strong>Paws &amp; Whiskers</strong>
          <span>Modern essentials for happy pets</span>
        </span>
      </a>

      <nav class="site-nav" aria-label="Primary">
        <a href="../index.php#shop">Shop</a>
        <a href="../index.php#categories">Categories</a>
        <a href="../index.php#about">About</a>
        <a href="../checkout.php">Checkout</a>
        <a href="../index.php#contact">Contact</a>
      </nav>

      <a class="nav-cta" href="../cart.php">
        View Cart
      </a>
    </div>
  </header>

  <main class="admin-page">
    <div class="container">

      <section class="admin-header-block">
        <div>
          <h1>Product Administration</h1>
        </div>

        <button class="btn primary" type="button">+ Add New Product</button>
      </section>

      <section class="summary-grid">
        <div class="summary-card">
          <span>Total Products</span>
          <strong id="totalProducts">3</strong>
        </div>

        <div class="summary-card">
          <span>Active Products</span>
          <strong id="activeProducts">2</strong>
        </div>

        <div class="summary-card">
          <span>Low Stock</span>
          <strong id="lowStockProducts">1</strong>
        </div>

        <div class="summary-card">
          <span>Categories</span>
          <strong>3</strong>
        </div>
      </section>

      <section class="admin-panel">
        <div class="panel-header">
          <h2>Add / Edit Product</h2>
          <p>This form represents the product fields that connect to the database.</p>
        </div>

        <form class="product-form" id="productForm">
          <div class="form-grid">

            <div class="form-block">
              <label for="product-name">Product Name</label>
              <input id="product-name" type="text" placeholder="Example: Grass-Fed Dog Food">
            </div>

            <div class="form-block">
              <label for="category">Category</label>
              <select id="category">
                <option>Nutrition</option>
                <option>Toys</option>
                <option>Grooming</option>
                <option>Accessories</option>
                <option>Health</option>
              </select>
            </div>

            <div class="form-block">
              <label for="price">Base Price</label>
              <input id="price" type="number" placeholder="85.00">
            </div>

            <div class="form-block">
              <label for="stock">Stock Quantity</label>
              <input id="stock" type="number" placeholder="24">
            </div>

            <div class="form-block">
              <label for="size">Size / Option</label>
              <input id="size" type="text" placeholder="4 lb, 12 lb, 24 lb">
            </div>

            <div class="form-block">
              <label for="status">Status</label>
              <select id="status">
                <option>Active</option>
                <option>Hidden</option>
                <option>Low Stock</option>
                <option>Out of Stock</option>
              </select>
            </div>

            <div class="form-block full">
              <label for="image">Image Path</label>
              <input id="image" type="text" placeholder="../img/product-name.jpg">
            </div>

            <div class="form-block full">
              <label for="description">Description</label>
              <textarea id="description" placeholder="Write product description for the customer-facing product page."></textarea>
            </div>

          </div>

          <div class="form-actions">
            <button type="submit" class="btn primary">Save Product</button>
            <button type="reset" class="btn secondary">Clear Form</button>
          </div>
        </form>
      </section>

      <section class="admin-panel">
        <div class="panel-header">
          <h2>Product Database Table</h2>
          <p>Admin view for editing, hiding, or deleting products.</p>
        </div>

        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Options</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Admin Actions</th>
              </tr>
            </thead>

            <tbody id="productTableBody">
              <?php foreach ($products as $product): ?>
                <tr>
                  <td>#<?php echo $product["id"]; ?></td>

                  <td>
                    <div class="product-cell">
                      <img src="<?php echo htmlspecialchars($product["img"]); ?>" alt="<?php echo htmlspecialchars($product["name"]); ?>">
                      <span><?php echo htmlspecialchars($product["name"]); ?></span>
                    </div>
                  </td>

                  <td><?php echo htmlspecialchars($product["category"]); ?></td>

                  <td>$<?php echo number_format($product["price"], 2); ?></td>

                  <td><?php echo htmlspecialchars($product["sizes"]); ?></td>

                  <td><?php echo htmlspecialchars($product["stock"]); ?></td>

                  <td>
                    <span class="status <?php echo strtolower(str_replace(' ', '-', $product["status"])); ?>">
                      <?php echo htmlspecialchars($product["status"]); ?>
                    </span>
                  </td>

                  <td>
                    <div class="action-buttons">
                      <button class="mini-btn edit-btn" type="button">Edit</button>
                      <button class="mini-btn hide-btn" type="button">Hide</button>
                      <button class="mini-btn delete-btn" type="button">Delete</button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </section>

    </div>
  </main>

  <footer class="site-footer" id="contact">
    <div class="container footer-grid">
      <div>
        <a class="brand footer-brand" href="../index.php#top">
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
        <a href="../index.php#shop">Shop</a>
        <a href="../index.php#categories">Categories</a>
        <a href="../index.php#about">About</a>
      </div>

      <div>
        <h3>Follow</h3>
        <p>Instagram</p>
        <p>Facebook</p>
        <p>TikTok</p>
      </div>
    </div>
  </footer>

  <script>
    const productNameInput = document.getElementById("product-name");
    const categoryInput = document.getElementById("category");
    const priceInput = document.getElementById("price");
    const stockInput = document.getElementById("stock");
    const sizeInput = document.getElementById("size");
    const statusInput = document.getElementById("status");
    const imageInput = document.getElementById("image");
    const descriptionInput = document.getElementById("description");
    const productForm = document.getElementById("productForm");

    const totalProducts = document.getElementById("totalProducts");
    const activeProducts = document.getElementById("activeProducts");
    const lowStockProducts = document.getElementById("lowStockProducts");

    function updateSummaryCards() {
      const rows = document.querySelectorAll("#productTableBody tr");
      let total = rows.length;
      let active = 0;
      let lowStock = 0;

      rows.forEach(function(row) {
        const statusText = row.querySelector(".status").textContent.trim();

        if (statusText === "Active") {
          active++;
        }

        if (statusText === "Low Stock") {
          lowStock++;
        }
      });

      totalProducts.textContent = total;
      activeProducts.textContent = active;
      lowStockProducts.textContent = lowStock;
    }

    function attachAdminButtons() {
      const editButtons = document.querySelectorAll(".edit-btn");
      const hideButtons = document.querySelectorAll(".hide-btn");
      const deleteButtons = document.querySelectorAll(".delete-btn");

      editButtons.forEach(function(button) {
        button.onclick = function() {
          const row = button.closest("tr");

          const productName = row.querySelector(".product-cell span").textContent;
          const imagePath = row.querySelector(".product-cell img").getAttribute("src");
          const category = row.children[2].textContent.trim();
          const price = row.children[3].textContent.replace("$", "").trim();
          const options = row.children[4].textContent.trim();
          const stock = row.children[5].textContent.trim();
          const status = row.querySelector(".status").textContent.trim();

          productNameInput.value = productName;
          categoryInput.value = category;
          priceInput.value = price;
          stockInput.value = stock;
          sizeInput.value = options;
          statusInput.value = status;
          imageInput.value = imagePath;
          descriptionInput.value = "Edit description for " + productName + ".";

          window.scrollTo({
            top: productForm.offsetTop - 120,
            behavior: "smooth"
          });
        };
      });

      hideButtons.forEach(function(button) {
        button.onclick = function() {
          const row = button.closest("tr");
          const statusBadge = row.querySelector(".status");

          statusBadge.textContent = "Hidden";
          statusBadge.className = "status hidden";

          updateSummaryCards();
        };
      });

      deleteButtons.forEach(function(button) {
        button.onclick = function() {
          const row = button.closest("tr");
          const productName = row.querySelector(".product-cell span").textContent;

          const confirmDelete = confirm("Delete " + productName + "?");

          if (confirmDelete) {
            row.remove();
            updateSummaryCards();
          }
        };
      });
    }

    productForm.addEventListener("submit", function(event) {
      event.preventDefault();

      alert("Product saved for demo. To save permanently, connect this form to your database.");
    });

    attachAdminButtons();
    updateSummaryCards();
  </script>

</body>
</html>