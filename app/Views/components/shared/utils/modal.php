<div id="modal_<?= $type ?>" component='modal' class="fixed top-0 left-0 Z-[99999] w-full px-4 md:px-0 h-full bg-[#00000059] flex justify-center items-center">
    <div class="modal bg-white fade show bg-white w-[25vw] pl-5 pb-1 px-4 shadow-md rounded-sm justify-center items-center">
        <div class="modal-header text-xl py-2 text-secondary flex justify-between">
            <span data-component='modal:title'>
                <span class="text-xll"><strong><?= $title ?></strong></span>
            </span>
            <div class="btn-dismiss" data-component='modal:close'>
                <button class="btn text-xll">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
        <hr>
        <div class="modal-content mb-2 mt-2">
            <div class="items-center justify-center">
                <div class="text-justify md:text-center" data-component='modal:subtitle'>
                    <span class="text-xl text-secondary"><?= $subtitle ?></span>
                </div>
            </div>
            <?php if(!empty($content)): ?>
                <div><?= $content ?></div>
            <?php endif; ?>
        </div>
        <?php if (!empty($left) || !empty($right)): ?>
            <hr>
            <div>
                <?php if (!empty($left)): ?>
                    <div class="row mb-2 mt-2 flex justify-end">
                        <div class="relative w-45">
                            <button class="border border-secondary px-4 block active:scale-[95%] min-w-20 duration-75 w-full min-h-[48px] rounded-md mx-auto 
                        disabled:bg-disable disabled:text-disabled cursor-pointer p-2"
                                data-component="btn_left">
                                <span class="px-2 mb-2 mt-2"><?= $left ?></span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($right)): ?>
                        <div class="relative w-45 ml-10">
                            <button class="bg-accent text-white px-4 block active:scale-[95%] min-w-20 duration-75 w-full min-h-[48px] rounded-md mx-auto 
                        disabled:bg-disable disabled:text-disabled cursor-pointer p-2"
                                data-component="btn_right">
                                <span class="px-2 mb-2 mt-2"><?= $right ?></span>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>