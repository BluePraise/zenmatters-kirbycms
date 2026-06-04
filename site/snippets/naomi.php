<?php
  $heading          = $page->naomiHeading();
  $portrait         = $page->naomiPortrait()->toFile();
  $body             = $page->naomiBody();
  $certifications   = $page->naomiCertifications()->toStructure();
?>

<section id="naomi" class="section section--sand">
  <div class="container-wide naomi__grid">
    <?php if ($portrait): ?>
      <div class="naomi__portrait-wrap">
        <img
          src="<?= $portrait->thumb(['width' => 800])->url() ?>"
          alt="<?= html($portrait->alt()->or('')) ?>"
          class="naomi__portrait"
          style="width:100%;height:100%;object-fit:cover;"
        >
      </div>
    <?php endif ?>

    <div>
      <?php if ($heading->isNotEmpty()): ?>
        <h2 class="section__heading"><?= html($heading) ?></h2>
      <?php endif ?>

      <?php if ($body->isNotEmpty()): ?>
        <div class="richtext"><?= $body ?></div>
      <?php endif ?>

      <?php if ($certifications->count() > 0): ?>
        <div style="margin-top:2rem;">
          <p class="naomi__certs-label">Certificaten</p>
          <ul class="naomi__certs-list">
            <?php foreach ($certifications as $cert): ?>
              <li>— <?= html($cert->item()) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>
    </div>
  </div>
</section>
