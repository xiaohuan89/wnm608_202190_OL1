<?php
$pageTitle = 'Paws & Whiskers | Home';
$currentPage = 'home';
include __DIR__ . '/parts/site-head.php';
include __DIR__ . '/parts/site-header.php';
?>
<main>
  <section class="hero">
    <div class="container hero-grid">
      <div class="hero-copy">
        <p class="eyebrow">Curated pet care, elevated</p>
        <h1>Thoughtful picks for dogs, cats, and the people who adore them.</h1>
        <p class="hero-text">
          Premium nutrition, playful enrichment, and design-forward essentials selected to make daily pet care feel simple and joyful.
        </p>

        <div class="hero-actions">
          <a class="btn btn-primary" href="shop.php">Shop Best Sellers</a>
          <a class="btn btn-outline" href="about.php">Why Pet Parents Choose Us</a>
        </div>

        <div class="hero-metrics" aria-label="Store highlights">
          <div>
            <strong>5k+</strong>
            <span>orders fulfilled</span>
          </div>
          <div>
            <strong>24 hrs</strong>
            <span>dispatch on essentials</span>
          </div>
          <div>
            <strong>4.9/5</strong>
            <span>average customer rating</span>
          </div>
        </div>
      </div>

      <div class="hero-card">
        <div class="hero-art">
          <img class="hero-image" src="img/window-image.png" alt="Pet store products arranged on a wooden table">
          <div class="art-badge badge-top">Vet-informed picks</div>
          <div class="art-panel panel-main">
            <span class="pet-icon">&#128054;</span>
            <div>
              <p>Daily Wellness Box</p>
              <strong>Food, treats, and calming care in one subscription.</strong>
            </div>
          </div>
          <div class="art-panel panel-side">
            <span class="pet-icon">&#128049;</span>
            <div>
              <p>Indoor Cat Edit</p>
              <strong>Toys, scratchers, and cozy rest spots.</strong>
            </div>
          </div>
          <div class="art-badge badge-bottom">Free shipping over $50</div>
        </div>
      </div>
    </div>
  </section>

  <section class="trust-strip" aria-label="Key selling points">
    <div class="container trust-grid">
      <div>Natural ingredients</div>
      <div>Groomer-approved tools</div>
      <div>Fast nationwide shipping</div>
      <div>Easy returns</div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-heading split">
        <div>
          <p class="eyebrow">Start here</p>
          <h2>Browse the store by section.</h2>
        </div>
        <a class="text-link" href="categories.php">See all categories</a>
      </div>

      <div class="category-grid">
        <article class="category-card accent-sage">
          <p class="category-label">Nutrition</p>
          <h3>Meals and treats</h3>
          <p>Everyday food, training treats, and wellness-focused formulas.</p>
        </article>
        <article class="category-card accent-peach">
          <p class="category-label">Play</p>
          <h3>Toys and enrichment</h3>
          <p>Interactive picks for indoor cats, curious pups, and busy minds.</p>
        </article>
        <article class="category-card accent-slate">
          <p class="category-label">Home</p>
          <h3>Beds, bowls, and care</h3>
          <p>Home essentials that feel durable, clean, and easy to live with.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="section section-soft">
    <div class="container">
      <div class="section-heading split">
        <div>
          <p class="eyebrow">Best sellers</p>
          <h2>Shop the products pet parents reach for most.</h2>
        </div>
        <a class="text-link" href="shop.php">Go to shop</a>
      </div>

      <div class="product-grid">
        <article class="product-card">
          <span class="product-badge">Best seller</span>
          <figure class="product-visual">
            <img src="https://images.unsplash.com/photo-1589924691995-400dc9ecc119?auto=format&fit=crop&w=900&q=80" alt="Bowl of premium dog food">
          </figure>
          <h3>Grass-Fed Dog Food</h3>
          <p>Protein-rich dry food with probiotics and omega support.</p>
          <div class="product-meta">
            <strong>$25</strong>
            <a href="shop.php">View product</a>
          </div>
        </article>

        <article class="product-card">
          <span class="product-badge">New</span>
          <figure class="product-visual">
            <img src="https://images.unsplash.com/photo-1545249390-6bdfa286032f?auto=format&fit=crop&w=900&q=80" alt="Colorful cat toy set">
          </figure>
          <h3>Interactive Cat Toy Set</h3>
          <p>Feather wand, puzzle ball, and crinkle toy trio for indoor cats.</p>
          <div class="product-meta">
            <strong>$12</strong>
            <a href="shop.php">View product</a>
          </div>
        </article>

        <article class="product-card">
          <span class="product-badge">Top rated</span>
          <figure class="product-visual">
            <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?auto=format&fit=crop&w=900&q=80" alt="Soft orthopedic pet bed">
          </figure>
          <h3>Orthopedic Pet Bed</h3>
          <p>Supportive memory foam comfort with a washable cover.</p>
          <div class="product-meta">
            <strong>$40</strong>
            <a href="shop.php">View product</a>
          </div>
        </article>

        <article class="product-card">
          <span class="product-badge">Editor pick</span>
          <figure class="product-visual">
            <img src="https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&w=900&q=80" alt="Stoneware pet feeding bowl">
          </figure>
          <h3>Stoneware Feeding Bowl</h3>
          <p>Durable, easy-clean bowl with a stable anti-slip base.</p>
          <div class="product-meta">
            <strong>$18</strong>
            <a href="shop.php">View product</a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container promo-panel">
      <div>
        <p class="eyebrow">Plan your visit</p>
        <h2>Use the navigation above to move through the full store experience.</h2>
      </div>
      <a class="btn btn-secondary" href="contact.php">Contact the shop</a>
    </div>
  </section>
</main>

<?php include("parts/footer.php"); ?>
