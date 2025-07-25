
<!-- Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="<?= $_GET['feedback'] == 'success' || $_GET['feedback'] == 'sucess' ? 'background: #64ad2f;' : 'background: #dc3545;' ?>color: #ffff;">
        <h5 class="modal-title" id="feedbackModalLongTitle"><?= $_GET['feedback'] == 'success' || $_GET['feedback'] == 'sucess' ? 'Atualização Concluída' : 'Ops! Aconteceu algum erro ' ?></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-text text-center" style="font-size: 1.2rem;">
          <p><?= isset($_GET['response']) ? $_GET['response'] : null  ?> </p>
          
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  let urlParams3 = new URLSearchParams(window.location.search);
  let get = urlParams3.get('feedback');
  if (get) {
    $('#feedbackModal').modal('show')

    setTimeout(()=>{
      $('#feedbackModal').modal('hide')
    }, 6000)
  }
</script>