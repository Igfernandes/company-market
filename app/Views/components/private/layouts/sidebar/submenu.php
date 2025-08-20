<?php
if (isset($topic) && isset($submenu[$topic])):
?>
    <div class="submenu">
        <ul class="px-2 rounded-xs">
            <?php foreach ($submenu[$topic] as $slug => $item): ?>
                <li class="text-white-800 text-sm ">
                    <i class="bi bi-caret-right-fill"></i> 
                    <a class="font-arial  ml-1" href="/dashboard/<?= $slug ?>"> <?= $item ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php
endif;
?>