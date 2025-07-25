<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 700px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel"><strong>Políticas de Privacidade</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if (isset($policies) && is_array($policies)) :
          foreach ($policies as $policy) :  ?>
            <div class="form-terms">
              <div class="title">
                <h3><?= $policy['title'] ?>:</h3>
              </div>
              <div class="content">
                <?= $policy['describes'] ?>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="policy_privacy[]" id="<?= str_replace([" ", "@"], "_", $policy['title']) ?>" value="accept">
                <label for="<?= str_replace([" ", "@"], "_", $policy['title']) ?>">Eu aceito os termos e normas citadas acima</label>
              </div>
            </div>
        <?php
          endforeach;
        endif; ?>
      </div>
      <div class="modal-footer">
        <div class="d-flex w-100">
          <div class="alert-terms">
            <p class="text-sm text-danger"><i>**Ao clicar no botão de salvar, você aceita todos os nossos termos e políticas.</i></p>
          </div>
          <div class="btn-save">
            <a class="btn btn-success" data-dismiss="modal">
              <span class="me-1">Salvar</span>
              <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" fill="#fff" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const buttonSave = document.querySelector("a[data-dismiss='modal']")
    buttonSave.addEventListener("click", () => {
      const modal = buttonSave.closest(".modal")
      const inputs = modal.querySelectorAll("[name]")

      inputs.forEach((input) => input.checked = true)
    })
  })
</script>