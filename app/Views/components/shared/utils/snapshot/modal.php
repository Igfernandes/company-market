<div component='snapshot-modal' snapshot-step='upload' snapshot-loading='false'>
    <div component='snapshot-modal:upload' class="py-4">
        <div component='snapshot-modal:upload-empty'>
            <div class="relative text-center border-2 border-dashed p-4 py-12">
                <input type="file" class="absolute top-0 left-0 opacity-0 w-full h-full" accept=".jpg,.jpge,.png">
                <i class="bi bi-cloud-upload header-lg"></i>
                <p>Clique para adicionar uma imagem</p>
            </div>
            <div class="flex mt-2">
                <div class="w-100 md:w-50">
                    <small class="alert-texts">Formatos Aceitos: PDF, PNG, JPEG</small>
                </div>
                <div class="w-100 md:w-50 text-right">
                    <small class="alert-texts">Tamanho máximo aceito: 5MB</small>
                </div>
            </div>
        </div>
        <div component='snapshot-modal:upload-loading'>
            <div class="relative text-center border-2 border-dashed p-4 py-12">
                <i class="bi bi-cloud-upload header-lg"></i>
                <p>Aguarde enquanto estamos carregando</p>
                <div class="progress-container mt-2">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>
            </div>
        </div>
    </div>
    <div component='snapshot-modal:preview' class="w-100 md:w-[50vw]">
    </div>
</div>