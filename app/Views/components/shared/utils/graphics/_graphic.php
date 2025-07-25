<div class="card">
    <div class="card-header">
        <h5 class="card-title">Controle Cadastral Semestral</h5>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <div class="btn-group">
                <!-- <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-wrench"></i>
                </button> -->
                <!-- <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a href="#" class="dropdown-item">Action</a>
                    <a href="#" class="dropdown-item">Another action</a>
                    <a href="#" class="dropdown-item">Something else here</a>
                    <a class="dropdown-divider"></a>
                    <a href="#" class="dropdown-item">Separated link</a>
                </div> -->
            </div>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="text-center">
                    <strong>Atualmente
                        <?php setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                        date_default_timezone_set('America/Sao_Paulo');
                        echo utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today'))) ?>
                    </strong>
                </p>

                <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" height="180" style="height: 180px;">
                    </canvas>
                </div>
                <!-- /.chart-toolonsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <?= view("components/shared/utils/graphics/_progress") ?>

                <!-- /.progress-group -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- ./card-body -->
    <div class="card-footer ">
        <div class="row justify-content-end">
            <div class="col-sm-4 col-4">
                <div class="description-block border-right">
                    <span class="description-percentage "> 0%</span>
                    <br>
                    <span class="description-text">AUMENTO MENSAL (<?= 0 ?>) </span>
                </div>
                <!-- /.description-block -->
            </div>

            <div class="col-sm-4 col-4" data-mapabrasil='bonus'>
                <div class="description-block border-right">
                    <span class="description-percentage "><i class="fas "></i> %</span>
                    <br>
                    <span class="description-text">AUMENTO MENSAL () </span>
                </div>
                <!-- /.description-block -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card-footer -->
</div>