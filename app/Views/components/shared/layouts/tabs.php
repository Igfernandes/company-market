<div component='tabs'>
    <ul class="flex" component='tabs:header'>
        <?php
        $tabs = array_keys($contents);
        foreach ($tabs as $tab): ?>
            <li
                class="text-lg font-semibold text-gray-400 cursor-pointer px-3 <?= $default === $tab ? "active" : "" ?>"
                tab='<?= $tab ?>'>
                <?= $tab ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="px-3">
        <?php foreach ($contents as $tab => $content): ?>
            <div class="<?= $default === $tab ? "active" : "" ?>" tab-target="<?= $tab ?>">
                <?= $content ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
