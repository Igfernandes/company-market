   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <?php echo form_open_multipart('/load/prove/inscription/store'); ?>
               <div class="modal-header">
                   <input type="hidden" name="preco" value="<?= $prova['taxa'] ?>">
                   <h5 class="modal-title" id="exampleModalLabel">Confirme seus dados</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body p-4">
                   <div class="row">
                       <div class="col-12 mt-5 mt-md-1">
                           <div class="row">
                               <div class="col-12 ">
                                   <div class="form-group">
                                       <label for="nome">Nome</label>
                                       <input type="text" name="nome" class="form-control rounded-0" id="nome" placeholder="Insira seu nome" value="<?= isset($usuario['nome']) ? $usuario['nome'] : null ?>" style="width: 50%;" required>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-12">

                           <div class="form-title mt-4 mb-3">
                               <h4><strong>CONTATO</strong></h4>
                           </div>
                           <hr>
                           <div class="row">
                               <div class="col-12 col-md-6">
                                   <div class="form-group">

                                       <label for="email">E-mail</label>
                                       <input type="email" name="email" class="form-control rounded-0" id="email" value="<?= isset($usuario['contato']['email']) ? $usuario['contato']['email'] : null ?>" placeholder="Insira seu e-mail" required>
                                   </div>
                               </div>
                               <div class="col-12 col-md-6">
                                   <div class="form-group">

                                       <label class="d-block" for="telefone">Telefone </label>
                                       <input type="text" name="telefone" class="form-control rounded-0 js-mask-celular" value="<?= isset($usuario['contato']['telefone']) ? $usuario['contato']['telefone'] : null ?>" id="telefone" required>
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-12 col-md-3">
                                   <div class="form-check ml-3">
                                       <input type="hidden" name="prova" value="<?= $provaId ?>" />
                                   </div>
                               </div>
                           </div>
                           <div class="form-title mt-4 mb-3">
                               <h4><strong>ENDEREÇO</strong></h4>
                           </div>
                           <hr>
                           <div class="row">
                               <div class="col-12 col-md-3">
                                   <div class="form-group">
                                       <label for="cep">CEP</label>
                                       <input type="text" name="cep" class="form-control rounded-0 js-mask-cep" id="cep" value="<?= isset($usuario['cep']) ? $usuario['cep'] : null ?>" placeholder="00000-000" required>
                                   </div>
                               </div>
                               <div class="col-12 col-md-3">
                                   <div class="form-group">
                                       <label>Estado:</label>
                                       <select name="estado" id="estado" class="form-control select2" style="width: 100%;" data-address='state' data-cep-field="uf" data-load-address="true" data-city-target="cidade" required data-estado="<?= isset($usuario['estado']) ? $usuario['estado'] : null ?>">
                                           <option selected="selected">Selecione o estado</option>
                                       </select>
                                   </div>
                               </div>
                               <div class="col-12 col-md-3">
                                   <div class="form-group">
                                       <label>Cidade:</label>
                                       <select name="cidade" id="cidade" class="form-control select2" style="width: 100%;"  required data-label="Cidade" data-cep-field="localidade" data-load-address="<?= isset($usuario['estado']) ? $usuario['estado'] : '' ?>" data-cidade="<?= isset($usuario['cidade']) ? $usuario['cidade'] : null ?>">
                                           <option selected="selected">Selecione o estado</option>
                                       </select>
                                   </div>
                               </div>
                               <div class="col-12 col-md-3">
                                   <div class="form-group">
                                       <label for="bairro">Bairro:</label>
                                       <input type="text" name="bairro" class="form-control rounded-0" id="bairro" value="<?= isset($usuario['bairro']) ? $usuario['bairro'] : null ?>" placeholder="Informe seu bairro" required>
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-12 col-md-4">
                                   <div class="form-group">
                                       <label for="logadouro">Logadouro</label>
                                       <input type="text" name="logadouro" class="form-control rounded-0" id="logadouro" value="<?= isset($usuario['logadouro']) ? $usuario['logadouro'] : null ?>" placeholder="Insira o logadouro" required>
                                   </div>
                               </div>
                               <div class="col-12 col-md-3">
                                   <div class="form-group">
                                       <label>Número:</label>
                                       <input type="number" name="numero" class="form-control rounded-0" id="numero" value="<?= isset($usuario['numero']) ? $usuario['numero'] : null ?>" placeholder="Insira o número" required>
                                   </div>
                               </div>
                               <div class="col-12 col-md-5">
                                   <div class="form-group">
                                       <label>Complemento:</label>
                                       <input type="text" name="complemento" class="form-control rounded-0" id="complemento" value="<?= isset($usuario['complemento']) ? $usuario['complemento'] : null ?>" placeholder="Insira um complemento" >
                                   </div>
                               </div>
                           </div>

                       </div>

                   </div>
                   <div class="row justify-content-center pb-5 mt-5">
                       <div class="col-12 mt-3">
                           <input type="hidden" name="perfil" value="#">
                           <input type="hidden" name="router" value="#">
                           <div class="form-btn submit text-center">
                               <button type="submit" name="update-brasilarco" class="btn btn-success col-12 col-md-3 ">Enviar</button>
                           </div>
                       </div>
                   </div>

               </div>
               <?= form_close() ?>
           </div>
       </div>
   </div>