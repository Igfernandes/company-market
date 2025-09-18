<?php if (!empty($max) && $max > 0): ?>
    <div class="counter absolute bottom-4 right-3" counter-field='<?= $target ?? "" ?>' component='counter-field'>
        <p class="text-gray-600 text-xs">
            <span component='counter-field:value'><?= $initial ?? 0 ?></span>/<span component='counter-field:ref'><?= $max ?? 0 ?></span>
        </p>
    </div>
<?php endif; ?>