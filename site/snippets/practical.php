<?php
  $heading = $page->practicalHeading();
  $items   = $page->practicalItems()->toStructure();
  $note    = $page->practicalNote();
?>

<section class="section section--paper">
  <div class="container-prose">
    <?php if ($heading->isNotEmpty()): ?>
      <h2 class="section__heading"><?= html($heading) ?></h2>
    <?php endif ?>

    <?php if ($items->count() > 0): ?>
      <ul class="practical__list">
        <?php foreach ($items as $item): ?>
          <li>— <?= html($item->item()) ?></li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>

    <?php if ($note->isNotEmpty()): ?>
      <p class="practical__note"><?= html($note) ?></p>
    <?php endif ?>
  </div>
</section>
