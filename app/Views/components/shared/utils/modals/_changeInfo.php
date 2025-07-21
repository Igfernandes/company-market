<!-- Modal -->
<div class="modal fade" id="ChangeModal" tabindex="-1" role="dialog" aria-labelledby="ChangeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="color: #ffff;">
                <h5 class="modal-title" id="ChangeModalLongTitle"><strong>Atualização de Informações:</strong></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-text text-right" style="font-size: 1.2rem;">
                    <form data-infochange data-code='30d9ad4ff0d94f2b0dc77d2fdedc56f8'>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="input-group-text" for="nome_card">Novo E-mail:</label>
                                    <input type="email" name="newemail" class="form-control rounded-0" id="nome_card" aria-describedby="email" placeholder="seuemail@mail.com" required>
                                    <div class="invalid-feedback">Esse campo não pode ficar vazio!</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="col-8 msg text-left">
                                <span class="danger-msg  text-danger" style="font-size: .9rem;"></span>
                            </div>
                            <div class="col-4 form-btn mt-1">
                                <button class="btn btn-primary" type="submit">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>