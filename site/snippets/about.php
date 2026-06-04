<?php
  $heading  = $page->aboutHeading();
  $body     = $page->aboutBody();
  $ctaLabel = $page->aboutCtaLabel();
?>

<section class="section section--paper">
  <div class="container-prose">
    <?php if ($heading->isNotEmpty()): ?>
      <h2 class="section__heading"><?= html($heading) ?></h2>
    <?php endif ?>

    <?php if ($body->isNotEmpty()): ?>
      <div class="richtext"><?= $body ?></div>
    <?php endif ?>

    <?php if ($ctaLabel->isNotEmpty()): ?>
      <a href="#contact" class="btn-primary about__cta"><?= html($ctaLabel) ?></a>
    <?php endif ?>
  </div>
</section>
