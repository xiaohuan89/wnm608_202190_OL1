<?php
$pageTitle = 'Paws & Whiskers | Categories';
$currentPage = 'categories';
include __DIR__ . '/parts/site-head.php';
include __DIR__ . '/parts/site-header.php';
?>
<main>
  <section class="section page-hero">
    <div class="container">
      <p class="eyebrow">Categories</p>
      <h1 class="page-title">Organize the shop around clear customer paths.</h1>
      <p class="page-intro">These category blocks help shoppers understand the site structure quickly before you design detailed product pages.</p>
    </div>
  </section>

  <section class="section">
    <div class="container category-grid">
      <article class="category-card accent-sage">
        <p class="category-label">Nutrition</p>
        <h3>Food, treats, and supplements</h3>
        <p>Everyday feeding essentials for puppies, adult pets, seniors, and special diets.</p>
      </article>
      <article class="category-card accent-peach">
        <p class="category-label">Play</p>
        <h3>Toys, puzzles, and enrichment</h3>
        <p>Interactive products designed to support exercise, focus, and indoor activity.</p>
      </article>
      <article class="category-card accent-slate">
        <p class="category-label">Home</p>
        <h3>Beds, bowls, and setup basics</h3>
        <p>Comfortable, durable essentials for feeding, sleeping, and organizing pet spaces.</p>
      </article>
      <article class="category-card accent-peach">
        <p class="category-label">Grooming</p>
        <h3>Brushes, shampoos, and care tools</h3>
        <p>Simple grooming routines for clean coats, healthy skin, and low-stress upkeep.</p>
      </article>
      <article class="category-card accent-sage">
        <p class="category-label">Walking</p>
        <h3>Leashes, harnesses, and travel</h3>
        <p>Outdoor gear for daily walks, quick trips, and safe movement on the go.</p>
      </article>
      <article class="category-card accent-slate">
        <p class="category-label">Wellness</p>
        <h3>Calming care and support</h3>
        <p>Helpful picks for digestion, joint support, and low-stress home routines.</p>
      </article>
    </div>
  </section>

  <section class="section section-soft">
    <div class="container split-panel">
      <div class="story-card">
        <p class="eyebrow">Navigation-first planning</p>
        <h2>Each category can later branch into product listing pages.</h2>
        <p>For now, this page creates the category map, gives your visitors clear wayfinding, and supports stronger site architecture.</p>
      </div>
      <div class="story-points">
        <article>
          <h3>Shop page</h3>
          <p>Use it as the product hub with featured items and future filters.</p>
        </article>
        <article>
          <h3>About page</h3>
          <p>Use it to explain brand values, sourcing, and customer trust.</p>
        </article>
        <article>
          <h3>Contact page</h3>
          <p>Use it for support, store details, and shopping guidance.</p>
        </article>
      </div>
    </div>
  </section>
</main>
<?php include("parts/footer.php"); ?>