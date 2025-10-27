<div component='collapse'>
    <div class="px-1 md:px-3" component='collapse:box'>
        <?php foreach ($contents as $tab => $content): ?>
            <div component="collapse:ask" class="collapse-box mb-2">
                <div collapse-target='<?= $tab ?>' component="collapse:header"
                    class="text-sm md:text-lg collapse-header flex justify-between font-semibold shadow-lg
                  cursor-pointer py-2 px-4 <?= $default === $tab ? "active" : "" ?>">
                    <span> <?= $tab ?></span>
                    <i class="collapse-arrow bi bi-chevron-up font-semibold"></i>
                </div>
                <div component="collapse:content" class="collapse-content text-sm md:text-md text-justify md:text-left pt-2 px-4">
                    <p> <?= $content ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>