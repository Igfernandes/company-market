<?php

/**
 * Type: Modal de Preview Arquivos
 * 
 * - Está sendo utilizado nas páginas referentes a edição para que seja possível previsualizar arquivos ou outros conteúdos.
 */
?>
<!-- Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #64ad2f;color: #ffff;">
        <h5 class="modal-title" id="previewModalLongTitle" style="word-wrap: break-word; width: 90%;">Conteúdo: <span class="title" style="font-size: 1rem;"></span></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-message">
          <p>Clique no arquivo para baixá-lo:</p>
        </div>
        <div class="modal-text p-3 text-center" style="font-size: 1.2rem;">
          <a href="" download data-file-preview-target='link'>
            <embed src="" type="" data-file-preview-target='embed'>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>