<div id="modal_<?= $type ?>" modal='<?= $type ?>' component='modal' class="fixed top-0 left-0 z-max w-full px-4 md:px-0 h-full bg-overlay flex justify-center items-center <?= $isActive ? "" : "hidden" ?>">
    <div class="modal bg-white bg-white <?= $class ? $class  : "lg:min-w-[25rem]" ?>   pl-5 pb-1 px-4 shadow-md rounded-md justify-center items-center">
        <div class="modal-header text-xl py-4 text-secondary flex justify-between">
            <span component='modal:title'>
                <span class="text-xll"><strong><?= $title ?></strong></span>
            </span>
            <div class="btn-dismiss" component='modal:close'
                onclick="this.closest('#modal_<?= $type ?>').classList.add('hidden')">
                <button class="btn text-xll" type="button">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
        <hr>
        <div class="modal-content">
            <div class="my-4">
                <div class="text-justify md:text-center" component='modal:subtitle'>
                    <span class="text-xl text-secondary"><?= $subtitle ?></span>
                </div>
            </div>
            <?php if (!empty($content)): ?>
                <div class="text-justify line-[1.2] my-4"><?= $content ?></div>
            <?php endif; ?>
        </div>
        <?php if (!empty($left) || !empty($right)): ?>
            <hr>
            <div class="py-3">
                <div class="row mb-2 mt-2 flex justify-end">
                    <?php if (!empty($left)): ?>
                        <div class="relative w-45">
                            <button type="button"
                                class="border-2 border-secondary active:scale-95 px-4 block min-w-20 duration-75 w-full min-h-[48px] rounded-md mx-auto 
                        disabled:bg-disable disabled:text-disabled cursor-pointer p-2"
                                component='modal:left-btn'>
                                <span class="px-2 my-2">
                                    <strong><?= $left ?></strong>
                                </span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($right)): ?>
                        <div class="relative w-45 ml-10">
                            <button type="button" class="bg-theme text-white active:scale-95 px-4 block min-w-20 duration-75 w-full min-h-[48px] rounded-md mx-auto 
                        disabled:bg-disabled disabled:text-disabled cursor-pointer p-2 "
                                component="modal:right-btn">
                                <span class="px-2 my-2">
                                    <strong><?= $right ?></strong>
                                </span>
                            </button>
                            <div class="is-loading absolute w-6 top-20 right-4 spin text-lg font-semibold cursor-pointer">
                                <?= Component("/assets/icons/dark/loading", [
                                    "fill" => "#4d94ff"
                                ]) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>