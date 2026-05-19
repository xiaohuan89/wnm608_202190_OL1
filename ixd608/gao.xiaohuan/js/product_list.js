document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("search");
  const categorySelect = document.getElementById("category");
  const sortSelect = document.getElementById("sort");
  const controlsForm = document.querySelector(".controls-form");
  const productGrid = document.querySelector(".shop-grid");
  const resultsCount = document.querySelector(".results-count");

  const productCards = Array.from(document.querySelectorAll(".product-card"));

  if (!searchInput || !categorySelect || !sortSelect || !controlsForm || !productGrid) {
    console.log("Search, filter, sort, or product grid is missing.");
    return;
  }

  const products = productCards.map(function (card) {
    const name = card.dataset.name || "";
    const category = card.dataset.category || "";
    const description = card.dataset.description || "";
    const price = parseFloat(card.dataset.price || "0");

    return {
      card: card,
      name: name,
      category: category,
      description: description,
      price: price
    };
  });

  function updateProducts() {
    const searchValue = searchInput.value.toLowerCase().trim();
    const categoryValue = categorySelect.value;
    const sortValue = sortSelect.value;

    let filteredProducts = products.filter(function (product) {
      const productText = (
        product.name + " " +
        product.category + " " +
        product.description
      ).toLowerCase();

      const matchesSearch =
        searchValue === "" || productText.includes(searchValue);

      const matchesCategory =
        categoryValue === "all" || product.category === categoryValue;

      return matchesSearch && matchesCategory;
    });

    if (sortValue === "price-low") {
      filteredProducts.sort(function (a, b) {
        return a.price - b.price;
      });
    } else if (sortValue === "price-high") {
      filteredProducts.sort(function (a, b) {
        return b.price - a.price;
      });
    } else if (sortValue === "name-az") {
      filteredProducts.sort(function (a, b) {
        return a.name.localeCompare(b.name);
      });
    } else if (sortValue === "name-za") {
      filteredProducts.sort(function (a, b) {
        return b.name.localeCompare(a.name);
      });
    }

    productGrid.innerHTML = "";

    if (filteredProducts.length === 0) {
      const emptyMessage = document.createElement("div");
      emptyMessage.className = "empty-results";
      emptyMessage.innerHTML = `
        <h2>No products found</h2>
        <p>Try a different search term, category, or sort option.</p>
      `;
      productGrid.appendChild(emptyMessage);
    } else {
      filteredProducts.forEach(function (product) {
        productGrid.appendChild(product.card);
      });
    }

    if (resultsCount) {
      resultsCount.textContent =
        "Showing " + filteredProducts.length + " of " + products.length + " products";
    }
  }

  controlsForm.addEventListener("submit", function (event) {
    event.preventDefault();
    updateProducts();
  });

  searchInput.addEventListener("input", updateProducts);
  categorySelect.addEventListener("change", updateProducts);
  sortSelect.addEventListener("change", updateProducts);

  updateProducts();
});