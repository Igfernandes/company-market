<div class="fixed top-0 left-0 Z-[99999] w-full px-4 md:px-0 h-full bg-[#00000059] flex justify-center items-center" component='modal'>
    <div class="modal bg-white fade show bg-white w-[25vw] pl-5 pb-1 px-4 shadow-md rounded-sm justify-center items-center">
        <div class="modal-header text-xl py-2 text-secondary flex justify-between">
            <span>
                <span class="text-xll"><strong><?= $title ?></strong></span>
            </span>
            <div class="btn-dismiss" data-component='modal:close'>
                <button class="btn text-xll">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
        <hr>
        <div class="mb-2 mt-2">
            <div class="items-center justify-center">
                <div class="text-justify md:text-center">
                    <span class="text-xl text-secondary"><?= $subtitle ?></span>
                </div>
                <div class="text-justify md:text-center">
                    <p class="text-md"><?= $message ?></p>
                </div>
            </div>
        </div>
        <?php if ($action): ?>
            <hr>
            <?= $action ?>
        <?php endif; ?>
    </div>
</div>