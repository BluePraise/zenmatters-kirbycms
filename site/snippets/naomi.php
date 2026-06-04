<?php
  $heading        = $page->naomiHeading();
  $portrait       = $page->naomiPortrait()->toFile();
  $body           = $page->naomiBody();
  $certifications = $page->naomiCertifications()->toStructure();
?>

<section id="naomi" class="section section--sand">
  <div class="container-wide split">

      <div class="split__content">
        <?php if ($heading->isNotEmpty()): ?>
          <h2 class="section__heading"><?= html($heading) ?></h2>
        <?php endif ?>

        <?php if ($body->isNotEmpty()): ?>
          <div class="richtext"><?= $body ?></div>
        <?php endif ?>

        <?php if ($certifications->count() > 0): ?>
          <div>
            <p class="naomi__certs-label">Certificaten</p>
            <ul class="naomi__certs-list">
              <?php foreach ($certifications as $cert): ?>
                <li>— <?= html($cert->item()) ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        <?php endif ?>
      </div>

      <?php if ($portrait): ?>
        <div class="split__image">
          <img
            src="<?= $portrait->thumb(['width' => 900, 'quality' => 85])->url() ?>"
            alt="<?= html($portrait->alt()->or('')) ?>"
          >
        </div>
      <?php endif ?>
  </div>
</section>
