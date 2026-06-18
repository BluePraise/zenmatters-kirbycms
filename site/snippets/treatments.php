<?php
$treatments = $page->treatments()->toStructure();
if ($treatments->count() === 0) return;

$promoActive = $page->promoActive()->toBool();
$promoText   = $page->promoText();

function parseDurations(string $raw): array {
  $lines = [];
  foreach (explode("\n", trim($raw)) as $line) {
    $line = trim($line);
    if ($line === '') continue;
    $parts = explode('|', $line, 2);
    $lines[] = [
      'duration' => trim($parts[0] ?? ''),
      'price'    => trim($parts[1] ?? ''),
    ];
  }
  return $lines;
}
?>

<section id="behandelingen" class="section section--paper">
  <div class="container-wide">
    <h2 class="section__heading" style="margin-bottom:3rem;">Behandelingen</h2>

    <?php if ($promoActive && $promoText->isNotEmpty()): ?>
      <p class="treatments__promo-banner"><?= html($promoText) ?></p>
    <?php endif ?>

    <div class="treatment-cards">
      <?php foreach ($treatments as $t): ?>
        <?php
          $img           = $t->image()->toFile();
          $regularLines  = parseDurations($t->durations()->value());
          $promoLines    = $promoActive ? parseDurations($t->promoDurations()->value()) : [];
          $showPromo     = $promoActive && count($promoLines) === count($regularLines) && count($regularLines) > 0;
        ?>
        <article class="treatment-card">
          <?php if ($img): ?>
            <div class="treatment-card__image">
              <img
                src="<?= $img->thumb(['width' => 600, 'height' => 400, 'crop' => true])->url() ?>"
                alt="<?= html($img->alt()->or($t->name())) ?>"
                loading="lazy"
                width="600"
                height="400"
              >
            </div>
          <?php endif ?>
          <div class="treatment-card__body">
            <h3 class="treatment-card__name">
              <?= html($t->name()) ?>
              <?php if ($t->forMenToo()->toBool()): ?>
                <span class="treatment__badge">(ook voor mannen)</span>
              <?php endif ?>
            </h3>

            <?php if (count($regularLines) > 0): ?>
              <ul class="treatment-card__durations">
                <?php foreach ($regularLines as $i => $row): ?>
                  <li class="treatment-card__duration">
                    <span class="treatment-card__dur-label"><?= html($row['duration']) ?></span>
                    <span class="treatment-card__dur-prices">
                      <?php if ($showPromo): ?>
                        <span class="treatment-card__dur-price--original"><?= html($row['price']) ?></span>
                        <span class="treatment-card__dur-price--promo"><?= html($promoLines[$i]['price']) ?></span>
                      <?php else: ?>
                        <span class="treatment-card__dur-price"><?= html($row['price']) ?></span>
                      <?php endif ?>
                    </span>
                  </li>
                <?php endforeach ?>
              </ul>
            <?php endif ?>

            <?php if ($t->description()->isNotEmpty()): ?>
              <div class="treatment-card__desc richtext"><?= $t->description() ?></div>
            <?php endif ?>
            <?php if ($t->note()->isNotEmpty()): ?>
              <p class="treatment-card__note"><?= html($t->note()) ?></p>
            <?php endif ?>
            <a href="#contact" class="btn-primary btn-primary--sm treatment-card__cta">
              <?= html($t->ctaLabel()->or('Maak een afspraak')) ?>
            </a>
          </div>
        </article>
      <?php endforeach ?>
    </div>
  </div>
</section>
