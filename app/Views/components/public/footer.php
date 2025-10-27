<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Scripts\Scripts;
?>
<footer>
    <div class="content bg-black-800 py-4">
        <div class="container text-center mx-auto">
            <p class="text-white">©2025 Desenvolvido pela <strong>Company Market</strong>. Todos os <strong>direitos reservados</strong> a Company Market.</p>
        </div>
    </div>
    <div class="action-button fixed z-999 bottom-15 right-2">
        <div class="ballon none md:block absolute right-90 bottom-100 bg-white w-[12rem] p-2 rounded-md shadow-lg">
            <span>Hey! Precisa de Ajuda?</span>
        </div>
        <a target="_blank" href="https://wa.me/5521981325543?text=Ol%C3%A1.%20Estou%20interessado%20em%20saber%20mais%20sobre%20os%20produtos%20e%20servi%C3%A7os%20da%20company%20market."
            class="shake bg-red-400 header-xl p-4 rounded-full text-white">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

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