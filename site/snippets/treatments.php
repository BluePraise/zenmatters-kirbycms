<?php $treatments = $page->treatments()->toStructure() ?>
<?php if ($treatments->count() === 0) return ?>

<section id="behandelingen" class="section section--paper">
  <div class="container-wide">
    <h2 class="section__heading" style="margin-bottom:3rem;">Behandelingen</h2>
    <div class="treatments__grid">
      <?php foreach ($treatments as $t): ?>
        <article>
          <h3 class="treatment__name">
            <?= html($t->name()) ?>
            <?php if ($t->forMenToo()->toBool()): ?>
              <span class="treatment__badge">(ook voor mannen)</span>
            <?php endif ?>
          </h3>
          <?php if ($t->description()->isNotEmpty()): ?>
            <div class="treatment__body richtext"><?= $t->description() ?></div>
          <?php endif ?>
        </article>
      <?php endforeach ?>
    </div>
  </div>
</section>
