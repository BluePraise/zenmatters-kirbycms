<?php
  $heading            = $site->contactHeading();
  $intro              = $site->contactIntro();
  $phone              = $site->phone();
  $email              = $site->email();
  $address            = $site->address();
  $chamberOfCommerce  = $site->chamberOfCommerce();
  $cancellationPolicy = $site->cancellationPolicy();

  $phoneDigits = preg_replace('/[^\d+]/', '', $phone->value());
  $waNumber    = ltrim($phoneDigits, '+');

  $contactMethods = [
    [
      'active' => $site->contactBellenActive()->toBool(),
      'label'  => 'Bellen',
      'href'   => 'tel:' . $phoneDigits,
    ],
    [
      'active' => $site->contactSmsActive()->toBool(),
      'label'  => 'SMS',
      'href'   => 'sms:' . $phoneDigits,
    ],
    [
      'active' => $site->contactWhatsappActive()->toBool(),
      'label'  => 'WhatsApp',
      'href'   => 'https://wa.me/' . $waNumber,
    ],
    [
      'active' => $site->contactSignalActive()->toBool(),
      'label'  => 'Signal',
      'href'   => 'https://signal.me/#p/' . $phoneDigits,
    ],
  ];
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

    <?php if ($phone->isNotEmpty()): ?>
      <ul class="contact__methods">
        <?php foreach ($contactMethods as $method): ?>
          <?php if ($method['active']): ?>
            <li class="contact__method">
              <a href="<?= html($method['href']) ?>" class="contact__link contact__link--method">
                <?= html($method['label']) ?>
              </a>
            </li>
          <?php endif ?>
        <?php endforeach ?>
      </ul>
    <?php endif ?>

    <dl class="contact__dl">
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

      <?php if ($chamberOfCommerce->isNotEmpty()): ?>
        <div class="contact__row">
          <dt class="contact__dt">KvK</dt>
          <dd><?= html($chamberOfCommerce) ?></dd>
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
