<!-- Modal -->
<?php if (isset($_GET['success']) || isset($_GET['failed'])) :  ?>
    <div class="modal fade" id="ResponseModal" tabindex="-1" role="dialog" aria-labelledby="ResponseModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="<?= isset($_GET['success']) || isset($_GET['boleto']) ? 'background: #64ad2f;' : 'background: #dc3545;' ?>color: #ffff;">
                    <h5 class="modal-title" id="ResponseModalLongTitle"><?= isset($_GET['success'])  || isset($_GET['boleto']) ? 'Ação concluída!' : 'Ops! Algo deu errado' ?> </h5>
                    <button type="button" class="close text-white" style="<?= isset($_GET['success']) || isset($_GET['boleto']) ? 'background: #64ad2f;' : 'background: #dc3545;' ?>border: none;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if (isset($_GET['boleto'])) { ?>
                    <div class="modal-body">
                        <div class="modal-text" style="font-size: 1.2rem;">
                            <p>Clique no botão para gerar o seu boleto: </p>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= $_GET['boleto'] ?>" target="_blank" class="btn btn-secondary">Gerar Boleto</a>
                    </div>
                <?php } elseif (isset($_GET['success'])) { ?>
                    <div class="modal-body">
                        <div class="modal-text" style="font-size: 1.2rem;">
                            <p><?php
                                if (isset($_GET['response'])) {
                                    $text = explode("Chave Pix:", $_GET['response']);
                                    echo $text[0] . "<br> <strong style='font-size: 1.5rem'>Chave Pix: <br><span style='font-size: 1.3rem;color:#0172a9;'>" . $text[1] . "</span></strong>";
                                } elseif (isset($_GET['response']) && empty($_GET['response'])) {
                                    echo 'Algo deu errado na transição de pagamento selecionado.<br>Acesse o painel administrativo com seu email e senha para tentar novamente.';
                                } else {
                                    echo '<p style="text-align: center;display:block">' . $_GET['success'] . '</p>';
                                }
                                ?></p>

                        </div>
                    </div>
                <?php } else { ?>
                    <div class="modal-body">
                        <div class="modal-text" style="font-size: 1.2rem;">
                            <p style="font-size: 1.2rem;"><?= $_GET['failed'] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        let urlParams4 = new URLSearchParams(window.location.search);
        let success = urlParams4.get('success');
        let failed = urlParams4.get('failed');
        let boleto = urlParams4.get('boleto');
        if (success || failed || boleto) {
            $('#ResponseModal').modal('show')

            <?php if (isset($_GET['boleto']) && !$_GET['boleto']) {

            ?>
                setTimeout(() => {
                    $('#ResponseModal').modal('hide')
                }, 2000)
            <?php        } ?>
        }
    </script>
<?php endif; ?>