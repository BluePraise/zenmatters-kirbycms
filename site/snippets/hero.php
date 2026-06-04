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
          src="<?= url('assets/images/logo-xl.png') ?>"
          alt="Zenmatters logo"
          width="160"
          height="160"
          class="hero__logo-img"
        >
      </div>
      <h1 class="hero__heading"><?= html($heading) ?></h1>
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
</section>
