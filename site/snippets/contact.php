<?php
  $heading            = $site->contactHeading();
  $intro              = $site->contactIntro();
  $phone              = $site->phone();
  $email              = $site->email();
  $address            = $site->address();
  $cancellationPolicy = $site->cancellationPolicy();
?>

<section id="contact" class="section section--navy">
  <div class="container-prose">
    <?php if ($heading->isNotEmpty()): ?>
      <h2 class="contact__heading" style="font-size:clamp(1.875rem,4vw,2.25rem);">
        <?= html($heading) ?>
      </h2>
    <?php endif ?>

    <?php if ($intro->isNotEmpty()): ?>
      <p class="contact__intro"><?= html($intro) ?></p>
    <?php endif ?>

    <dl class="contact__dl">
      <?php if ($phone->isNotEmpty()): ?>
        <div class="contact__row">
          <dt class="contact__dt">Telefoon / Signal / WhatsApp</dt>
          <dd>
            <a href="tel:<?= html(preg_replace('/\s+/', '', $phone->value())) ?>" class="contact__link">
              <?= html($phone) ?>
            </a>
          </dd>
        </div>
      <?php endif ?>

      <?php if ($email->isNotEmpty()): ?>
        <div class="contact__row">
          <dt class="contact__dt">E-mail</dt>
          <dd>
            <a href="mailto:<?= html($email) ?>" class="contact__link">
              <?= html($email) ?>
            </a>
          </dd>
        </div>
      <?php endif ?>

      <?php if ($address->isNotEmpty()): ?>
        <div class="contact__row">
          <dt class="contact__dt">Praktijkadres</dt>
          <dd><?= html($address) ?></dd>
        </div>
      <?php endif ?>
    </dl>

    <?php if ($cancellationPolicy->isNotEmpty()): ?>
      <div class="contact__cancellation">
        <h3 class="contact__cancellation-heading">Annulering</h3>
        <p class="contact__cancellation-body"><?= html($cancellationPolicy) ?></p>
      </div>
    <?php endif ?>
  </div>
</section>
