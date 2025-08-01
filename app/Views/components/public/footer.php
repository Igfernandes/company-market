<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Scripts\Scripts;
?>
<footer>
    <?= Scripts::render(); ?>
    <div class="gtranslate_wrapper"></div>
    <script>
        window.gtranslateSettings = {
            "default_language": "pt",
            "native_language_names": true,
            "detect_browser_language": true,
            "wrapper_selector": ".gtranslate_wrapper",
            "switcher_horizontal_position": "right",
            "float_switcher_open_direction": "top",
            "alt_flags": {
                "pt": "brazil",
                "en": "usa",
                "es": "colombia",
                "fr": "quebec"
            }
        }
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
</footer>