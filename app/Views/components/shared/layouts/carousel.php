  <!-- Swiper -->
  <div class="swiper h-100 <?= $class ?>" data-component="carousel" id="carousel_<?= (new DateTime())->getTimestamp(); ?>">
      <div class="swiper-wrapper">
          <?php
            if (is_array($slides)):
                foreach ($slides as $slide): ?>
                  <div class="swiper-slide">
                      <img src="<?= $slide ?>" class="h-100 w-100 object-contain" alt="slide carousel" />
                  </div>
          <?php endforeach;
            endif; ?>
      </div>
  </div>