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
<body>

<?php
  $navItems = $site->navigation()->toStructure();
  $siteName  = $site->siteName()->or('Zenmatters');
?>

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
        <a href="<?= html($item->href()) ?>" class="site-header__nav-link">
          <?= html($item->label()) ?>
        </a>
      <?php endforeach ?>
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
        <a href="<?= html($item->href()) ?>" class="mobile-menu-dropdown__link">
          <?= html($item->label()) ?>
        </a>
      </div>
    <?php endforeach ?>
  </div>
</header>
