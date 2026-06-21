<?php snippet('header') ?>

<main style="padding-top:calc(4rem + var(--notification-height, 0px));">
  <section class="section section--paper">
    <div class="container-prose">
      <h1 style="font-size:clamp(1.875rem,5vw,2.5rem);margin-bottom:2rem;">
        <?= html($page->title()) ?>
      </h1>
    </div>
  </section>
</main>

<?php snippet('footer') ?>
