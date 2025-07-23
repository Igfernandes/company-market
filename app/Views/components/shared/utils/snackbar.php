<div class="snackbar fixed top-0 right-4 bg-green w-[25vw] bg-white rounded-2 shadow-md">
    <div class="d-flex">
        <div class="w-15 text-center pt-2">
            <div class="success header-md">
                <i class="bi bi-bookmark-check-fill text-green-400"></i>
            </div>
            <div class="failed header-md">
                <i class="bi bi-bookmark-x-fill text-red-400"></i>
            </div>
            <div class="notice header-md is-feedback">
                <i class="bi bi-bookmark-dash-fill text-yellow-400"></i>
            </div>
        </div>
        <div class="w-85 py-2 px-2">
            <div>
                <span><strong data-component="snackbar:title">{title}</strong></span>
            </div>
            <div>
                <p data-component="snackbar:message">{message}</p>
            </div>
            <div class="box-buttons d-flex justify-content-end w">
                <div class="btn-dismiss me-2">
                    <button class="btn">
                        fechar
                    </button>
                </div>
                <div class="btn ms-2 bg-accent btn-action" data-component="snackbar:action">
                    {action}
                </div>
            </div>
        </div>
    </div>
</div>