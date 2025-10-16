<img component='image'
   skeleton='false' 
   class="w-full h-full <?= $class ?? "" ?>"
   default="<?= $default ?>"
   src="<?= $src ?>"
   alt="<?= $alt ?? "" ?>"
   onerror="this.onerror=null;this.src='<?= $default ?>';"
   <?= getAttributes($attributes) ?>>