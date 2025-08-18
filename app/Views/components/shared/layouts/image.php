<img component='image'
   class="w-full h-full <?= $class ?? "" ?>"
    default="<?= $default ?>"
    src="<?= base_url($src) ?>"
    alt="<?= $alt ?? "" ?>"
    onerror="this.onerror=null;this.src='<?= $default ?>';"
    <?= getAttributes($attributes) ?>>