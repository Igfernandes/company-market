<!-- Modal -->
<div class="modal fade" id="cardCreditModal" tabindex="-1" role="dialog" aria-labelledby="cardCreditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #64ad2f;color: #ffff;">
                <h5 class="modal-title" id="cardCreditModalLongTitle"><strong>Informações do Cartão:</strong></h5>
            </div>
            <div class="modal-body step" data-modal="cardcredit">
                <div class="modal-text text-center" style="font-size: 1.2rem;">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="input-group-text" for="nome_card">Nome do Cartão:</label>
                                <input disabled type="text" name="holder" class="form-control rounded-0" id="nome_card" aria-describedby="nome_card" required>
                                <div class="invalid-feedback">Esse campo não pode ficar vazio!</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="input-group-text" for="number_card">Número do cartão:</label>
                                <input disabled type="text" name="number" class="form-control rounded-0" id="number_card" aria-describedby="number_card" required>
                                <div class="invalid-feedback">Esse campo não pode ficar vazio!</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="input-group-text" for="code_secutiry">Código de Segurança:</label>
                                <input disabled type="text" name="securityCode" class="form-control rounded-0 js-mask-code" id="code_secutiry" aria-describedby="code_secutiry" placeholder="000" required>
                                <div class="invalid-feedback">Esse campo não pode ficar vazio!</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-group-text" for="validate_card">Validade do Cartão(Mês):</label>
                                <input disabled type="text" name="expMonth" class="form-control rounded-0 js-mask-mes" id="validate_card" placeholder="00" minlength="2" required>
                                <div class="invalid-feedback">Esse campo não pode ficar vazio!</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-group-text" for="validate_card">Validade do Cartão(Ano):</label>
                                <input disabled type="text" name="expYear" class="form-control rounded-0 js-mask-ano" id="validate_card" placeholder="0000" minlength="4" required>
                                <div class="invalid-feedback">Esse campo não pode ficar vazio!</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="font-size: .8rem;">
                            <span class="messagem-card-credit text-red"></span>
                        </div>
                    </div>
                    
                    <div class="form-btn mt-3">
                        <a class="btn btn-success cardcredit-submit">Adicionar</a>
                    </div>
                    <div class="msg mt-4">
                        <span class="danger-msg  text-danger" style="font-size: .9rem;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let select = document.querySelector("[name='metodo_pagamento']")
    let inputs = document.querySelectorAll("[name='cardcredit[]']");
    if (select) {

        select.onchange = function() {

            if (select.value == 'Cartao') {
                $('#cardCreditModal').modal('show')

                for (let input of document.querySelectorAll("#cardCreditModal input")) {
                    input.disabled = false;
                }
            } else {
                for (let input of document.querySelectorAll("#cardCreditModal input")) {
                    input.disabled = true;
                }
                $('#collapseCardCredt').collapse('hide')
            }
        }
    }
</script>