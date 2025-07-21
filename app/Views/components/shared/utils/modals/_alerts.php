<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #64ad2f;color: #ffff;">
        <h5 class="modal-title" id="alertModalLongTitle">Ops! Algo está errado</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-text" style="font-size: 1.2rem;">
          <?php
          $alerts = fopen(APPPATH . 'Data/alerts.json', 'r');
          $rows = json_decode(stream_get_contents($alerts));

          foreach ($rows->system->external as $alert) {
            if (isset($_GET['failed']) && $alert->type == $_GET['failed']) {
              echo $alert->msg;
            }
          }

          fclose($alerts);

          ?>
        </div>
      </div>
      <div class="modal-footer">
       <a href="<?= site_url() ?>" class="btn btn-secondary" style="background: #014d7f;">Acessar</a>
      </div>
    </div>
  </div>
</div>

<script>
  let urlParams1 = new URLSearchParams(window.location.search);
  let get = urlParams1.get('failed');
  if (get) {
    $('#alertModal').modal('show')
  }
</script>