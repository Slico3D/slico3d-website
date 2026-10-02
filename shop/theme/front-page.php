<?php
defined('ABSPATH') || exit;
get_header();
?>
<div id="primary" class="content-area slico-home">
  <main id="main" class="site-main">
    <section class="slico-hero" aria-labelledby="slico-title">
      <p class="slico-eyebrow">SLICO3D · Gedruckt in Bayern</p>
      <h1 id="slico-title">Kleine Lösungen.<br>Für deinen Alltag.</h1>
      <p>Praktische Halter und Zubehör aus dem 3D-Druck. Durchdacht, sorgfältig gefertigt und mit persönlichem Kontakt.</p>
      <div class="slico-actions">
        <a class="button" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">Zum Shop</a>
        <a class="button secondary" href="<?php echo esc_url(home_url('/ueber-slico3d/')); ?>">Über SLICO3D</a>
      </div>
    </section>
    <section class="slico-promises" aria-label="Über unsere Produkte">
      <article><h2>Praktisch gedacht</h2><p>Zubehör für kleine Aufgaben im Alltag und in der Werkstatt.</p></article>
      <article><h2>In Bayern gefertigt</h2><p>Unsere eigenen Druckprodukte entstehen hier vor Ort.</p></article>
      <article><h2>Persönlich erreichbar</h2><p>Eine Frage? Schreib uns. Wir helfen dir gerne weiter.</p></article>
    </section>
    <?php if (!wc_get_products(array('status' => 'publish', 'limit' => 1, 'return' => 'ids'))) : ?>
      <section class="slico-empty" aria-labelledby="slico-empty-title">
        <h2 id="slico-empty-title">Hier entsteht unser Sortiment.</h2>
        <p>Die ersten Produkte werden gerade vorbereitet. Schau bald wieder vorbei.</p>
      </section>
    <?php else : ?>
      <section aria-labelledby="slico-products-title">
        <h2 id="slico-products-title">Neu im Shop</h2>
        <?php echo do_shortcode('[products limit="4" columns="4" orderby="date" order="DESC"]'); ?>
      </section>
    <?php endif; ?>
  </main>
</div>
<?php get_footer(); ?>
