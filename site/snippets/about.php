<?php
$heading  = $page->aboutHeading();
$body     = $page->aboutBody();
$image    = $page->aboutImage()->toFile();
$ctaLabel = $page->aboutCtaLabel();
?>

<section class="section section--paper">
  <div class="container-wide split split--reverse">
      <div class="split__content">
        <?php if ($heading->isNotEmpty()): ?>
          <h2 class="section__heading"><?= html($heading) ?></h2>
        <?php endif ?>

        <?php if ($body->isNotEmpty()): ?>
          <div class="richtext"><?= $body ?></div>
        <?php endif ?>

        <?php if ($ctaLabel->isNotEmpty()): ?>
          <div>
            <a href="#contact" class="btn-primary"><?= html($ctaLabel) ?></a>
          </div>
        <?php endif ?>
      </div>

      <?php if ($image): ?>
        <div class="split__image">
          <img
            src="<?= $image->thumb(['width' => 900, 'quality' => 85])->url() ?>"
            alt="<?= html($image->alt()->or('')) ?>">
        </div>
      <?php endif ?>
  </div>
</section>