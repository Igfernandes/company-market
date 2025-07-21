<!-- Modal -->
<?php if (isset($_GET['errors'])) :  ?>
    <div class="modal fade show" id="ErrorsModal" tabindex="-1" role="dialog" aria-labelledby="ErrorsModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #dc3545;color: #ffff;">
                    <h5 class="modal-title" id="ErrorsModalLongTitle">Existem alguns campos inválidos</h5>
                    <button type="button" class="close text-white" style="background: #dc3545;border: none;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-text" style="font-size: 1.2rem;">
                        <ul>
                            <?php foreach (explode(":", $_GET['errors']) as $error) : ?>
                                <li>
                                    <p class="mb-0"><?= $error ?> </p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
          $('#ErrorsModal').modal('show')
    </script>
<?php endif;  ?>