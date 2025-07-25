<div class="card">
    <div class="card-header">
        <h3 class="card-title">Controle de Usuários</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-xl-7">
                <div class="chart-responsive">
                    <canvas id="graphicCircle" height="150" 
                    data-labels="<?= ucfirst(lang("Words.active")) . "s" ?>,<?= ucfirst(lang("Words.analysis")) . "s" ?>,<?= ucfirst(lang("Words.inactive"))  ?>" 
                    data-counters="<?= $statusCounters['active'] ?>,<?= $statusCounters['analysis'] ?>,<?= $statusCounters['inactive'] ?>" 
                    data-colors="#28a745,#ffc107,#dc3545">
                </canvas>
                </div>
                <!-- ./chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-xl-5">
                <ul class="chart-legend clearfix">
                    <li><i class="far fa-circle text-success"></i> <?= ucfirst(lang("Words.active")) . "s" ?></li>
                    <li><i class="far fa-circle text-warning"></i> <?= ucfirst(lang("Words.analysis")) . "s" ?></li>
                    <li><i class="far fa-circle text-danger"></i> <?= ucfirst(lang("Words.inactive"))  ?></li>
                </ul>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer p-0">
        <ul class="nav nav-pills flex-column" data-mapabrasil='circle'>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <?= ucfirst(lang("Words.active")) . "s" ?>
                    <span class="float-right"><?= $statusCounters['active'] ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <?= ucfirst(lang("Words.analysis")) . "s" ?>
                    <span class="float-right "><?= $statusCounters['analysis'] ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <?= ucfirst(lang("Words.inactive"))  ?>
                    <span class="float-right "><?= $statusCounters['inactive'] ?></span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.footer -->
</div>