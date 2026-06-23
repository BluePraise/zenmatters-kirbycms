<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $page->isHomePage()
    ? html($site->siteName()->or('Zenmatters')) . ' – massagepraktijk aan huis'
    : html($page->title()) . ' – ' . html($site->siteName()->or('Zenmatters'))
  ?></title>
  <meta name="description" content="Kleinschalige massagepraktijk in Baarn. Ontspanningsmassage, rug-, nek- en schoudermassage, en massage bij fibromyalgie en chronische pijn.">
  <meta name="robots" content="index, follow">
  <link rel="stylesheet" href="<?= url('assets/css/main.css') ?>">
</head>
<?php
  $navItems   = $site->navigation()->toStructure();
  $siteName   = $site->siteName()->or('Zenmatters');
  $navCtaLabel = $site->navCtaLabel();
  $navCtaHref  = $site->navCtaHref()->or('#contact');

  // Anchor-only hrefs (e.g. #naomi) only work on the homepage, so on other
  // pages they need to point back to the homepage first.
  $resolveHref = function (string $href) use ($page, $site) {
    if (!str_starts_with($href, '#')) {
      return $href;
    }
    return $page->isHomePage() ? $href : $site->homePage()->url() . $href;
  };
  $navCtaHref = $resolveHref($navCtaHref);

  $notificationActive = $site->notificationActive()->toBool();
  $notificationText   = $site->notificationText();
  $showNotification   = $notificationActive && $notificationText->isNotEmpty();
?>
<body<?= $showNotification ? ' class="has-notification"' : '' ?>>

<?php if ($showNotification): ?>
  <div class="notification-bar">
    <p class="notification-bar__text"><?= html($notificationText) ?></p>
  </div>
<?php endif ?>

<header class="site-header">
  <div class="container-wide site-header__inner">
    <a href="<?= url('/') ?>" class="site-header__logo">
      <img
        src="<?= url('assets/images/logo-xs.png') ?>"
        alt="Zenmatters logo"
        width="40"
        height="40"
        class="site-header__logo-img"
      >
      <span class="site-header__logo-text wordmark"><?= html($siteName) ?></span>
    </a>

    <nav aria-label="Hoofdnavigatie" class="site-header__nav">
      <?php foreach ($navItems as $item): ?>
        <a href="<?= html($resolveHref($item->href())) ?>" class="site-header__nav-link">
          <?= html($item->label()) ?>
        </a>
      <?php endforeach ?>
      <?php if ($navCtaLabel->isNotEmpty()): ?>
        <a href="<?= html($navCtaHref) ?>" class="btn-primary btn-primary--sm">
          <?= html($navCtaLabel) ?>
        </a>
      <?php endif ?>
    </nav>

    <button
      class="mobile-menu-toggle"
      id="mobile-menu-toggle"
      aria-label="Menu openen"
      aria-expanded="false"
      aria-controls="mobile-menu-dropdown"
    >
      <span class="mobile-menu-toggle__bar mobile-menu-toggle__bar--top"></span>
      <span class="mobile-menu-toggle__bar mobile-menu-toggle__bar--middle"></span>
      <span class="mobile-menu-toggle__bar mobile-menu-toggle__bar--bottom"></span>
    </button>
  </div>

  <div class="mobile-menu-dropdown" id="mobile-menu-dropdown" hidden>
    <?php foreach ($navItems as $item): ?>
      <div class="mobile-menu-dropdown__item">
        <a href="<?= html($resolveHref($item->href())) ?>" class="mobile-menu-dropdown__link">
          <?= html($item->label()) ?>
        </a>
      </div>
    <?php endforeach ?>
    <?php if ($navCtaLabel->isNotEmpty()): ?>
      <div class="mobile-menu-dropdown__item mobile-menu-dropdown__item--cta">
        <a href="<?= html($navCtaHref) ?>" class="mobile-menu-dropdown__cta">
          <?= html($navCtaLabel) ?>
        </a>
      </div>
    <?php endif ?>
  </div>
</header>
