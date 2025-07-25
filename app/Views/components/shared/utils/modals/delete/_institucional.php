<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #64ad2f;color: #ffff;">
        <h5 class="modal-title" id="deleteModalLongTitle">Faça uma ação com os dados:</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <div class="disabled-item"></div>
              <label>Cadastro Selecionado:</label>
              <input type="hidden" value="" name="from" required>
              <input type="text" name="name_del" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label>Destino:</label>
              <select name="to" class="form-control select2" style="width: 100%;">
                <option value="">Selecione:</option>
                <?php foreach ($institutions as $intitution) :
                  if (!empty($intitution)) : ?>
                    <option value="<?= $intitution["id"] ?>"><?= $intitution['name'] ?></option>
                <?php endif;
                endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="card card-default">
          <div class="card-header">
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>TRANSFERÊNCIA:</label>
                  <select class="duallistbox-delete" name="transferencias[]" multiple="multiple">
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.card -->
      </div>
      <div class="modal-footer">
        <button type="button" data-delete-action="transfer" class="btn btn-secondary">Transferência</button>
        <button type="button" data-delete-action="delete" class="btn btn-secondary">Excluir</button>
        <button type="button" data-delete-action="transfer/delete" class="btn btn-secondary">Transferir/Excluir</button>
      </div>
    </div>
  </div>
</div>