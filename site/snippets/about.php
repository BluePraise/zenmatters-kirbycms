<?php
$heading  = $page->aboutHeading();
$body     = $page->aboutBody();
$ctaLabel = $page->aboutCtaLabel();

$slides = [
  ['file' => $page->aboutGalleryLandscapeTop()->toFile(),    'orientation' => 'landscape'],
  ['file' => $page->aboutGalleryPortraitLeft()->toFile(),    'orientation' => 'portrait'],
  ['file' => $page->aboutGalleryLandscapeBottom()->toFile(), 'orientation' => 'landscape'],
  ['file' => $page->aboutGalleryPortraitRight()->toFile(),   'orientation' => 'portrait'],
];
$slides = array_filter($slides, fn ($slide) => $slide['file'] !== null);
?>

<section class="section section--paper">
  <div class="container-wide split split--reverse">
      <div class="split__content">
        <?php if ($heading->isNotEmpty()): ?>
          <h2 class="section__heading"><?= html($heading) ?></h2>
        <?php endif ?>

        <?php if ($body->isNotEmpty()): ?>
          <div class="richtext"><?= $body ?></div>
        <?php endif ?>

        <?php if ($ctaLabel->isNotEmpty()): ?>
          <div>
            <a href="#contact" class="btn-primary"><?= html($ctaLabel) ?></a>
          </div>
        <?php endif ?>
      </div>

      <?php if (!empty($slides)): ?>
        <div class="split__image about-slider" data-lightbox-group="about-gallery">
          <?php foreach ($slides as $i => $slide): $file = $slide['file']; ?>
            <button
              type="button"
              class="about-slider__slide about-slider__slide--<?= html($slide['orientation']) ?><?= $i === 0 ? ' is-active' : '' ?>"
              data-lightbox-src="<?= $file->thumb(['width' => 1800, 'quality' => 85])->url() ?>"
              data-lightbox-alt="<?= html($file->alt()->or('')) ?>"
            >
              <img
                src="<?= $file->thumb(['width' => 900, 'quality' => 85])->url() ?>"
                alt="<?= html($file->alt()->or('')) ?>"
                loading="<?= $i === 0 ? 'eager' : 'lazy' ?>">
            </button>
          <?php endforeach ?>

          <?php if (count($slides) > 1): ?>
            <div class="about-slider__dots">
              <?php foreach ($slides as $i => $slide): ?>
                <button
                  type="button"
                  class="about-slider__dot<?= $i === 0 ? ' is-active' : '' ?>"
                  data-slide-index="<?= $i ?>"
                  aria-label="Ga naar foto <?= $i + 1 ?>"></button>
              <?php endforeach ?>
            </div>
          <?php endif ?>
        </div>
      <?php endif ?>
  </div>
</section>

<?php if (!empty($slides)): ?>
  <div class="lightbox" id="about-gallery-lightbox" hidden>
    <button type="button" class="lightbox__close" aria-label="Sluiten">&times;</button>
    <button type="button" class="lightbox__nav lightbox__nav--prev" aria-label="Vorige foto">&lsaquo;</button>
    <img class="lightbox__image" src="" alt="">
    <button type="button" class="lightbox__nav lightbox__nav--next" aria-label="Volgende foto">&rsaquo;</button>
  </div>

  <script>
    (function () {
      var slider = document.querySelector('[data-lightbox-group="about-gallery"]');
      if (!slider) return;

      var slides = Array.prototype.slice.call(slider.querySelectorAll('.about-slider__slide'));
      var dots = Array.prototype.slice.call(slider.querySelectorAll('.about-slider__dot'));
      var current = 0;
      var timer = null;
      var AUTOPLAY_MS = 5000;

      function goTo(index) {
        current = (index + slides.length) % slides.length;
        slides.forEach(function (slide, i) {
          slide.classList.toggle('is-active', i === current);
        });
        dots.forEach(function (dot, i) {
          dot.classList.toggle('is-active', i === current);
        });
      }

      function startAutoplay() {
        stopAutoplay();
        if (slides.length > 1) {
          timer = window.setInterval(function () { goTo(current + 1); }, AUTOPLAY_MS);
        }
      }

      function stopAutoplay() {
        if (timer) {
          window.clearInterval(timer);
          timer = null;
        }
      }

      dots.forEach(function (dot, index) {
        dot.addEventListener('click', function () {
          goTo(index);
          startAutoplay();
        });
      });

      startAutoplay();

      // Lightbox
      var lightbox = document.getElementById('about-gallery-lightbox');
      if (!lightbox) return;

      var image = lightbox.querySelector('.lightbox__image');
      var closeBtn = lightbox.querySelector('.lightbox__close');
      var prevBtn = lightbox.querySelector('.lightbox__nav--prev');
      var nextBtn = lightbox.querySelector('.lightbox__nav--next');

      function showInLightbox(index) {
        current = (index + slides.length) % slides.length;
        var slide = slides[current];
        image.src = slide.getAttribute('data-lightbox-src');
        image.alt = slide.getAttribute('data-lightbox-alt') || '';
      }

      function openLightbox(index) {
        stopAutoplay();
        showInLightbox(index);
        lightbox.hidden = false;
        closeBtn.focus();
      }

      function closeLightbox() {
        lightbox.hidden = true;
        image.src = '';
        goTo(current);
        startAutoplay();
      }

      slides.forEach(function (slide, index) {
        slide.addEventListener('click', function () {
          openLightbox(index);
        });
      });

      closeBtn.addEventListener('click', closeLightbox);
      prevBtn.addEventListener('click', function () { showInLightbox(current - 1); });
      nextBtn.addEventListener('click', function () { showInLightbox(current + 1); });

      lightbox.addEventListener('click', function (event) {
        if (event.target === lightbox) closeLightbox();
      });

      document.addEventListener('keydown', function (event) {
        if (lightbox.hidden) return;
        if (event.key === 'Escape') closeLightbox();
        if (event.key === 'ArrowLeft') showInLightbox(current - 1);
        if (event.key === 'ArrowRight') showInLightbox(current + 1);
      });
    })();
  </script>
<?php endif ?>
