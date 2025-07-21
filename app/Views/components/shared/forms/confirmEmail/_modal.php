<!-- Modal -->
<div class="modal fade" id="emailConfirmModal" tabindex="-1" role="dialog" aria-labelledby="emailConfirmModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header" style="background: #64ad2f;color: #ffff;">
        <h5 class="modal-title" id="emailConfirmModalLongTitle">Token de Confirmação de E-mail</h5>
      </div>
      <div class="modal-body" data-confirm-email="form">
        <div class="form-group">
          <div class="disabled-item"></div>
          <?= view("components/shared/forms/InputGroup", [
            "form" => "confirmToken",
            "type" => "text",
            "name" => "token",
            "id" => "token",
            "label" => ucfirst(lang("Words.insert_token")),
            "placeholder" => "xxxx-xxxx-xxxx-xxxx",
            "required" => true,
            "attributes" => [
              "minlength" => "19",
              "maxlength" => "19"
            ]
          ]) ?>
        </div>
      </div>
      <div class="modal-footer">
        <a data-confirm-email="submit" class="btn btn-primary">Validar</a>
      </div>
    </div>
  </div>
</div>