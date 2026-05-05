<?php
$pageTitle = 'Paws & Whiskers | Contact';
$currentPage = 'contact';
include __DIR__ . '/parts/site-head.php';
include __DIR__ . '/parts/site-header.php';
?>
<main>
  <section class="section page-hero">
    <div class="container">
      <p class="eyebrow">Contact</p>
      <h1 class="page-title">Keep help easy to find from anywhere on the site.</h1>
      <p class="page-intro">This page gives customers a direct way to reach the shop and supports the rest of the site navigation with practical next steps.</p>
    </div>
  </section>

  <section class="section">
    <div class="container contact-grid">
      <div class="contact-card">
        <p class="eyebrow">Store details</p>
        <h3>Visit or get in touch</h3>
        <ul class="list-clean">
          <li>Email: hello@pawsandwhiskers.com</li>
          <li>Phone: (123) 456-7890</li>
          <li>Hours: Mon-Sat, 9am-6pm</li>
          <li>Location: 18 Market Street, Pasadena, CA</li>
        </ul>
      </div>

      <form class="form-shell" action="#" method="post">
        <p class="eyebrow">Message the team</p>
        <h3>Ask about products, shipping, or recommendations.</h3>
        <div class="field-list">
          <label>
            Name
            <input type="text" name="name" placeholder="Your name">
          </label>
          <label>
            Email
            <input type="email" name="email" placeholder="you@example.com">
          </label>
          <label>
            Message
            <textarea name="message" rows="5" placeholder="Tell us what you need help with"></textarea>
          </label>
        </div>
        <button class="btn btn-primary" type="submit">Send Message</button>
      </form>
    </div>
  </section>

  <section class="section section-soft">
    <div class="container info-grid">
      <article class="detail-card">
        <p class="eyebrow">Shop next</p>
        <h3>Return to products</h3>
        <p>Once customers get help, they should have a fast path back into shopping.</p>
        <a class="text-link" href="shop.php">Go to shop</a>
      </article>
      <article class="detail-card">
        <p class="eyebrow">Explore</p>
        <h3>Browse categories</h3>
        <p>Category navigation stays visible and consistent for easier browsing.</p>
        <a class="text-link" href="categories.php">View categories</a>
      </article>
      <article class="detail-card">
        <p class="eyebrow">Review cart</p>
        <h3>Keep checkout nearby</h3>
        <p>Customers can move from support to cart without losing their place in the site.</p>
        <a class="text-link" href="cart.php">Open cart</a>
      </article>
    </div>
  </section>
</main>

<?php include("parts/footer.php"); ?>