<?php

/**
 * Type: Modal de Exportação
 * 
 */
?>
<!-- Modal -->
<div class="modal fade" id="exportingModal" tabindex="-1" role="dialog" aria-labelledby="exportingModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90vw;">
    <div class="modal-content">
      <div class="modal-header" style="background: #64ad2f;color: #ffff;">
        <h5 class="modal-title" id="previewModalLongTitle">LISTA DE INSCRITOS: <span class="title"></span></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Main content -->
        <section class="content home">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="form-filter" data-filter='form'>
                      <div class="title">
                        <h2>FILTROS:</h2>
                      </div>
                      <div class="container">
                        <div class="row">
                          <div class="col-12 col-md-5">
                            <div class="form-group">
                              <label for="filter_federacao">Federações</label>
                              <select name="filter_federacao" class="form-control" id="filter_federacao">
                                <option value="">Selecione a federação</option>
                                <?php foreach ($filter['federacoes'] as $federacao) : ?>
                                  <option value="<?= $federacao['id_institucional'] ?>"><?= $federacao['nome_institucional'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-4">
                            <div class="form-group">
                              <label for="filter_clube">Clubes</label>
                              <select name="filter_clube" class="form-control" id="filter_clube">
                                <option value="">Selecione a clube</option>
                                <?php foreach ($filter['clubes'] as $clubes) : ?>
                                  <option value="<?= $clubes['id_institucional'] ?>"><?= $clubes['nome_institucional'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="form-group">
                              <label for="filter_provas">Provas</label>
                              <select name="filter_provas" class="form-control" id="filter_provas">
                                <option value="">Selecione a Prova</option>
                                <?php foreach ($filter['eventos'] as $evento) : ?>
                                  <option value="<?= $evento['id_eventos'] ?>"><?=  $evento['nome']  ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4">
                            <div class="form-group">
                              <label>Estado:</label>
                              <select name="filter_estado" class="form-control select2" id="estado" style="width: 100%;" data-estado="<?= isset($user['endereco'][0]['estado']) ? $user['endereco'][0]['estado'] : '' ?>">
                                <option selected="selected">Selecione o Estado</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-4">
                            <div class="form-group">
                              <label>Cidade:</label>
                              <select name="filter_cidade" id="cidade" class="form-control select2" style="width: 100%;" data-cidade="<?= isset($user['endereco'][0]['cidade']) ? $user['endereco'][0]['cidade'] : '' ?>">
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-btn text-right">
                      <a class="btn btn-success"  data-filter='submit'>Filtrar</a>
                      <a class="btn btn-primary" data-table='export_excel_btn'>Exportar</a>
                    </div>
                    <table id="exportingTable" class="table table-bordered table-striped" data-table='export_excel' data-export='tabela_de_inscritos'>
                      <thead>
                        <tr>
                          <th style="width: 5%"></th>
                          <th style="width: 25%">Nome</th>
                          <th style="width: 10%">Matricula</th>
                          <th style="width: 25%">Endereço</th>
                          <th style="width: 10%">Prova</th>
                          <th style="width: 15%;">Incrição</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($inscricoes as $isc) : ?>
                          <tr>
                            <td><input type="checkbox" name="isSelected"></td>
                            <td data-filter="column-nome"><?= $isc['nome_inscrito'] ?></td>
                            <td data-filter="column-matricula"><?= $isc['matricula'] ?></td>
                            <td data-filter="column-endereco"><?= $isc['logadouro'] . ", " . $isc['complemento'] . ", " . $isc['bairro'] . ", " . $isc['cidade'] . " - " . $isc['estado'] ?></td>
                            <td data-filter="column-prova"><?= $isc['nome_prova'] ?></td>
                            <td data-filter="column-inscricao"><?= $isc['data_inscricao'] ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th style="width: 5%"></th>
                          <th style="width: 25%">Nome</th>
                          <th style="width: 10%">Matricula</th>
                          <th style="width: 25%">Endereço</th>
                          <th style="width: 20%">Prova</th>
                          <th style="width: 15%;">Incrição</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->


        <script>
          document.addEventListener("DOMContentLoaded", () => {
            $(function() {
              $("#exportingTable").DataTable({
                "ordering": false,
                "filter": false,
                "responsive": true,
                "lengthChange": false,
                "searching": false,
                "autoWidth": false,
              });

            });
          })
        </script>
      </div>
    </div>
  </div>
</div>