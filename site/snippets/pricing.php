<?php $pricingGroups = $page->pricing()->toStructure() ?>
<?php if ($pricingGroups->count() === 0) return ?>

<section id="tarieven" class="section section--sand-100">
  <div class="container-wide">
    <h2 class="section__heading" style="margin-bottom:3rem;">Tarieven</h2>
    <div class="pricing__grid">
      <?php foreach ($pricingGroups as $group): ?>
        <div>
          <h3 class="pricing__category"><?= html($group->category()) ?></h3>
          <?php if ($group->note()->isNotEmpty()): ?>
            <p class="pricing__note"><?= html($group->note()) ?></p>
          <?php endif ?>
          <ul class="pricing__list">
            <?php foreach (explode("\n", trim($group->items()->value())) as $line):
              $line = trim($line);
              if ($line === '') continue;
              $parts    = explode('|', $line, 2);
              $duration = trim($parts[0] ?? '');
              $price    = trim($parts[1] ?? '');
            ?>
              <li>
                <span><?= html($duration) ?></span>
                <span class="pricing__price"><?= html($price) ?></span>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
