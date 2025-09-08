<img component='image'
   class="w-full h-full <?= $class ?? "" ?>"
    default="<?= $default ?>"
    src="<?= $src ?>"
    alt="<?= $alt ?? "" ?>"
    onerror="this.onerror=null;this.src='<?= $default ?>';"
    <?= getAttributes($attributes) ?>>