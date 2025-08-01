 <script type="module" src="/js/theme.js"></script>

 <?php
    if (is_array($scripts)):
        foreach ($scripts as $script):
            [$url, $query] = explode("?", $script);

    ?>
         <script
             src="<?= $url ?? "" ?>"
             <?php if (!empty($query)) {
                    $attributes = explode("&", $query);
                    array_walk($attributes, function ($attribute) {
                        [$attName, $attValue] = explode("=", $attribute);
                        echo "$attName='$attValue'";
                    }, array_keys($attributes));
                }
                ?>></script>
 <?php endforeach;
    endif; ?>