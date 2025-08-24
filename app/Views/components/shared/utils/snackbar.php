<div component='snackbar' class="snackbar fixed top-5 z-max right-2 bg-green min-w-[18rem] w-[25vw] bg-white rounded-lg shadow-md">
    <div class="flex">
        <div class="w-15 text-center pt-2">
            <?php if ($type === "SUCCESS"): ?>
                <div class="success header-md">
                    <i class="bi bi-bookmark-check-fill text-green-400"></i>
                </div>
            <?php elseif ($type === "FAIL"): ?>
                <div class="failed header-md">
                    <i class="bi bi-bookmark-x-fill text-red-400"></i>
                </div>
            <?php elseif ($type === "NOTICE"): ?>
                <div class="notice header-md is-feedback">
                    <i class="bi bi-bookmark-dash-fill text-yellow-400"></i>
                </div>
            <?php endif; ?>
        </div>
        <div class="w-85 pt-2 pb-3 px-2">
            <div class="flex justify-between">
                <div>
                    <span>
                        <strong data-component="snackbar:title">
                            <?= $title ?>
                        </strong>
                    </span>
                </div>
                <div class="btn-dismiss me-2" data-component='snackbar:close'>
                    <button class="btn text-xl">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
            <div class="line-[1.2] text-sm">
                <p data-component="snackbar:message"> <?= $message ?></p>
            </div>
            <div class="box-buttons flex justify-end">
                <?php if (!empty($action)): ?>
                    <div class="btn ms-2 bg-accent btn-action" data-component="snackbar:action">
                        <?= $action ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>