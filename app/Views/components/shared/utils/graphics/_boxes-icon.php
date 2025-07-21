<div class="row justify-content-around">
    <?php
    if (isset($counters) && is_array($counters)) :
        foreach ($counters as $counter) : ?>
            <div class="info-column box-counters">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text"><?= lang($counter->title) ?></span>
                        <span class="info-box-icon <?= isset($counter->bgClass) ? $counter->bgClass : 'bg-info' ?> elevation-1 w-100"> <?= $counter->amount; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
    <?php endforeach;
    endif; ?>
</div>