<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 35%;" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #64ad2f;color: #ffff;">
        <h5 class="modal-title" id="deleteModalLongTitle">Deseja excluir esse atleta?</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <div class="disabled-item"></div>
              <label>Cadastro Selecionado:</label>
              <input type="hidden" value="" name="from" required>
              <input type="text" name="name_del" class="form-control" disabled>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a data-delete="atleta" class="btn btn-secondary">Excluir</a>
      </div>
    </div>
  </div>
</div>