<?php
$pageTitle = 'Paws & Whiskers | About';
$currentPage = 'about';
include __DIR__ . '/parts/site-head.php';
include __DIR__ . '/parts/site-header.php';
?>
<main>
  <section class="section page-hero">
    <div class="container">
      <p class="eyebrow">About</p>
      <h1 class="page-title">A friendly, curated pet store with a calm browsing experience.</h1>
      <p class="page-intro">This page gives the brand story a home while keeping navigation and trust-building content easy to scan.</p>
    </div>
  </section>

  <section class="section">
    <div class="container story-grid">
      <div class="story-card">
        <p class="eyebrow">Our approach</p>
        <h2>We select products for comfort, function, and everyday reliability.</h2>
        <p>Paws &amp; Whiskers is designed to feel approachable and curated, so shoppers can move from discovery to purchase without digging through cluttered pages.</p>
      </div>

      <div class="story-points">
        <article>
          <h3>Curated with purpose</h3>
          <p>Fewer products, clearer recommendations, and a simpler path through the store.</p>
        </article>
        <article>
          <h3>Supportive guidance</h3>
          <p>Helpful information for new pet parents and longtime owners alike.</p>
        </article>
        <article>
          <h3>Designed for everyday life</h3>
          <p>Products and page structure that fit naturally into modern home routines.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="section section-soft">
    <div class="container info-grid">
      <article class="detail-card">
        <p class="eyebrow">What this page does</p>
        <h3>Builds trust</h3>
        <p>It explains the shop voice, values, and product philosophy before customers buy.</p>
      </article>
      <article class="detail-card">
        <p class="eyebrow">How it connects</p>
        <h3>Links deeper into the store</h3>
        <p>From here, customers can return to the shop, browse categories, or contact the team.</p>
      </article>
      <article class="detail-card">
        <p class="eyebrow">What comes next</p>
        <h3>Add testimonials or sourcing</h3>
        <p>Those sections can be layered in later without changing the shared navigation structure.</p>
      </article>
    </div>
  </section>
</main>
<?php include("parts/footer.php"); ?>