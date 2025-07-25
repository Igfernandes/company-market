<?php

declare(strict_types=1);

?>
<?= view('components/public/header/index') ?>
<div class="laboratory bg-laboratory">

   <?= view("laboratory/header") ?>
   <div class="content d-flex">
      <?= view("laboratory/sidebar") ?>
      <?= view("laboratory/preview") ?>
   </div>
</div>

<script type="module" src="/js/tests/execute.js"></script>
<?=
view('components/public/footer/index') ?>