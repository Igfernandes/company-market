<div component='settings:board' target-popup='settings' class="absolute right-1 top-100 min-w-[16rem] shadow bg-light pt-4 pb-8 px-3 border-accent border-2 shadow rounded-md">
    <div class="board-menu">
        <ul class="flex border-b-2 border-accent">
            <?php foreach ($tabs as $index => $tab):  ?>
                <li component='settings:tab-option' tab-index='<?= $index ?>' class="p-2 cursor-pointer <?= $index == 0 ? "active" : "" ?>">
                    <?= $tab ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="board-content px-2">
        <?php foreach ($boards as $index => $board):  ?>
            <div class="board-item <?= $index == 0 ? "active" : "" ?>" tab-target='<?= $index ?>'>
                <ul class="mt-3">
                    <?php foreach ($board as $tab): ?>
                        <li class="my-1">
                            <a href="<?= $tab['slug'] ?>"><?= isset($tab['icon']) ? $tab['icon'] : '-' ?>
                                <span class="ml-1">
                                    <?= $tab['text'] ?>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>

    </div>

</div>