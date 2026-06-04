<?php if (!$page->summerActive()->toBool()) return ?>

<?php
  $heading      = $page->summerHeading();
  $validityNote = $page->summerValidityNote();
  $body         = $page->summerBody();
  $prices       = $page->summerPrices()->toStructure();
?>

<section class="section section--navy">
  <div class="container-prose">
    <?php if ($heading->isNotEmpty()): ?>
      <h2 class="summer__heading" style="font-size:clamp(1.875rem,4vw,2.25rem);">
        <?= html($heading) ?>
      </h2>
    <?php endif ?>

    <?php if ($validityNote->isNotEmpty()): ?>
      <p class="summer__validity"><?= html($validityNote) ?></p>
    <?php endif ?>

    <?php if ($body->isNotEmpty()): ?>
      <p class="summer__body"><?= html($body) ?></p>
    <?php endif ?>

    <?php if ($prices->count() > 0): ?>
      <ul class="summer__list">
        <?php foreach ($prices as $p): ?>
          <li>
            <span><?= html($p->duration()) ?></span>
            <span style="font-weight:500;"><?= html($p->price()) ?></span>
          </li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>
  </div>
</section>
