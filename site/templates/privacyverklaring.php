<?php snippet('header') ?>

<main style="padding-top:4rem;">
  <section class="section section--paper">
    <div class="container-prose">
      <h1 style="font-size:clamp(1.875rem,5vw,2.5rem);margin-bottom:2rem;">
        <?= html($page->title()->or('Privacyverklaring')) ?>
      </h1>

      <?php if ($page->body()->isNotEmpty()): ?>
        <div class="privacy__body richtext"><?= $page->body() ?></div>
      <?php else: ?>
        <div class="privacy__body">
          <p>Deze website verzamelt geen persoonsgegevens, gebruikt geen cookies en bevat geen tracking of analytics.</p>
          <p>Als je contact opneemt via telefoon, Signal, WhatsApp of e-mail, worden je gegevens alleen gebruikt om je bericht te beantwoorden en eventueel een afspraak te plannen. Ze worden niet gedeeld met derden.</p>
          <p>Vragen over privacy? Stuur een bericht via de contactgegevens op de homepage.</p>
        </div>
      <?php endif ?>

      <p class="privacy__back">
        <a href="<?= url('/') ?>">← Terug naar de homepage</a>
      </p>
    </div>
  </section>
</main>

<?php snippet('footer') ?>
