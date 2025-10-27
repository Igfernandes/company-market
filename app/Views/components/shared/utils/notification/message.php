<div component="notification:message">
    <hr>
    <div class="py-2 px-2">
        <div class="content">
            <?php if (isset($author)): ?>
                <div class="author text-right">
                    <span class="text-theme  text-sm"> <strong> Autor:</strong> <i component='notification:author'><?= $author ?></i></span>
                </div>
            <?php endif; ?>
            <strong component='notification:title'></strong>
            <span component='notification:message-content' class="text-sm font-poppins line-clamp-2 line-[1.2]">
                <?= $message ?>
            </span>
        </div>
        <?php if (isset($link)): ?>
            <div class="link">
                <a href="<?= $link ?>" component='notification:link'>
                    <u>Acessar</u>
                </a>
            </div>
        <?php endif; ?>
        <div class="hour text-right line-[1.2]">
            <span class="text-xs">
                <i component='notification:datetime'>
                    <?php
                    $datetime = new Datetime($datetime);

                    echo $datetime->format("H:i");
                    ?>
                </i>
            </span>
        </div>
    </div>
</div>