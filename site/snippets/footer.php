<?php
  $navItems = $site->navigation()->toStructure();
  $siteName  = $site->siteName()->or('Zenmatters');
?>

<footer class="site-footer">
  <div class="container-wide site-footer__inner">
    <p class="site-footer__copyright">
      © <?= date('Y') ?> <?= html($siteName) ?>
    </p>
    <nav aria-label="Footer-navigatie" class="site-footer__nav">
      <?php foreach ($navItems as $item): ?>
        <a href="<?= html($item->href()) ?>" class="site-footer__nav-link">
          <?= html($item->label()) ?>
        </a>
      <?php endforeach ?>
      <a href="<?= page('privacyverklaring')->url() ?>" class="site-footer__nav-link">
        Privacyverklaring
      </a>
    </nav>
  </div>
</footer>

<script>
  (function () {
    var toggle = document.getElementById('mobile-menu-toggle');
    var dropdown = document.getElementById('mobile-menu-dropdown');
    if (!toggle || !dropdown) return;

    toggle.addEventListener('click', function () {
      var isOpen = !dropdown.hidden;
      dropdown.hidden = isOpen;
      toggle.setAttribute('aria-expanded', String(!isOpen));
      toggle.querySelectorAll('.mobile-menu-toggle__bar').forEach(function (bar) {
        bar.classList.toggle('is-open', !isOpen);
      });
    });

    dropdown.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        dropdown.hidden = true;
        toggle.setAttribute('aria-expanded', 'false');
        toggle.querySelectorAll('.mobile-menu-toggle__bar').forEach(function (bar) {
          bar.classList.remove('is-open');
        });
      });
    });
  })();
</script>

</body>
</html>
