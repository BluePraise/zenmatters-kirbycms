<?php
  $portrait  = $page->heroPortrait()->toFile();
  $heading   = $page->heroTitle()->or($site->siteName())->or('Zenmatters');
  $tagline   = $page->heroTagline();
  $ctaLabel  = $page->heroCtaLabel();
?>

<section class="hero">
  <?php if ($portrait): ?>
    <div class="hero__bg-image">
      <img
        src="<?= $portrait->thumb(['width' => 800, 'quality' => 80])->url() ?>"
        alt="<?= html($portrait->alt()->or('')) ?>"
        style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:top;"
      >
      <div class="hero__bg-overlay"></div>
    </div>
  <?php endif ?>

  <div class="hero__grid">
    <div class="hero__text">
      <div class="hero__logo">
        <img
          src="<?= url('assets/images/logo-small.png') ?>"
          width="300"
          alt="Zenmatters logo"
          class="hero__logo-img"
        >
      </div>
      <h1 class="hero__heading wordmark"><?= html($heading) ?></h1>
      <?php if ($tagline->isNotEmpty()): ?>
        <p class="hero__tagline"><?= html($tagline) ?></p>
      <?php endif ?>
      <?php if ($ctaLabel->isNotEmpty()): ?>
        <div class="hero__cta">
          <a href="#contact" class="btn-primary"><?= html($ctaLabel) ?></a>
        </div>
      <?php endif ?>
    </div>

    <?php if ($portrait): ?>
      <div class="hero__photo">
        <img
          src="<?= $portrait->thumb(['width' => 1200, 'quality' => 85])->url() ?>"
          alt="<?= html($portrait->alt()->or('')) ?>"
          style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:top;"
        >
      </div>
    <?php endif ?>
  </div>

  <a href="#naomi" class="hero__scroll-hint" aria-label="Scroll omlaag">
    <span>LEES MEER</span>
    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <polyline points="6 9 12 15 18 9"></polyline>
    </svg>
  </a>
</section>
