<div class="link">
    <a href="<?= esc($href ?? "") ?>" 
        readonly="<?= $readonly ?? "" ?>"
        name = "<?= esc($name ?? "") ?>"
        id="<?= esc($id ?? $name) ?>"
        class="hover:text-white text-accent <?= esc($className ?? "") ?>"
        >
        <strong><?= esc($label ?? "") ?> <i class="bi bi-link-45deg"></i></i></strong>
    </a>
</div>