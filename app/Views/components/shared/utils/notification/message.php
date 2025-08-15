<div component="notification:message">
    <hr>
    <div class="flex justify-between text py-2 px-2">
        <div class="content">
            <?php if (isset($author)): ?>
                <div class="author">
                    <span class="text-accent"><strong><?= $author ?></strong></span>
                </div>
            <?php endif; ?>
            <span class="text-sm font-poppins line-clamp-2 line-[1.2]">
                <?= $message ?>
            </span>
        </div>
        <div class="hour">
            <span class="text-sm">
                <i>
                    <?php
                    $datetime = new Datetime($datetime);

                    echo $datetime->format("H:i");
                    ?>
                </i>
            </span>
        </div>
    </div>
</div>