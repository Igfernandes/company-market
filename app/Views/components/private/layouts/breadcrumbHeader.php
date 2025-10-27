<div component='breadcrumb-header'>
    <div class="flex items-center my-4 mx-4 py-6 px-4 bg-content rounded-xs shadow">
        <div class="icon text-center w-5 min-w-[3rem]">
            <span class="text-xxl border-2 py-2 px-3 text-theme border-theme rounded-sm shadow">
                <?= $icon ?>
            </span>
        </div>
        <div class="content w-90 px-4">
            <div class="title">
                <h1 class="font-poppins mb-0"><?= $title ?></h1>
            </div>
            <div class="text">
                <p class="text-sm line-1">
                    <?= $text ?>
                </p>
            </div>
        </div>
        <?php if (current_url() != previous_url()): ?>
            <div class="link w-5 min-w-[3rem] ml-auto">
                <a class="bg-gray-200 text-center py-1 pl-3 pr-2 inline-block shadow" href="<?= previous_url() ?>">
                    <i class="bi bi-box-arrow-in-left"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>