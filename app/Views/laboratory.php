<?php
declare(strict_types=1);

use App\Components\Forms\Email;
echo view('components/public/header/index');

?>
<div class="laboratory bg-laboratory">

    <?php echo view("laboratory/header"); ?>
    <div class="content flex">
        <?php echo view("laboratory/sidebar"); ?>
        <?php echo view("laboratory/preview"); ?>
    </div>
</div>

<script type="module" src="/js/tests/execute.js"></script>
<?php echo view('components/public/footer/index'); ?>
