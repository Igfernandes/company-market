<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= !empty($title) ? $title : getenv("globals.company.name") ?></title>
    <meta name="description" content="<?= $description ?? "" ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= base_url($path ?? "") ?>">
    <meta name="author" content="Nautisys">

    <!-- Open Graph -->
    <meta property="og:title" content="Passeios Náuticos com a Nautisys">
    <meta property="og:description" content="Alugue barcos e viva experiências no mar com a Nautisys.">
    <meta property="og:image" content="<?= base_url("/imgs/nautisys-logotype.png") ?>">
    <meta property="og:url" content="<?= base_url($path ?? "") ?>">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Passeios Náuticos com a Nautisys">
    <meta name="twitter:description" content="Alugue barcos e viva experiências incríveis no mar.">
    <meta name="twitter:image" content="<?= base_url("/imgs/nautisys-logotype.png") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <!-- Favicon padrão -->
    <link rel="icon" type="image/x-icon" href="<?= base_url("/imgs/favicon.ico") ?>">

    <!-- PNGs para dispositivos modernos -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url("/imgs/favicon-180x180.png") ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url("/imgs/favicon-192x192.png") ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?= base_url("/imgs/favicon-512x512.png") ?>">

    <!-- Meta para Android/Chrome -->
    <meta name="theme-color" content="#ffffff">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Nautisys">

    <!-- Tailwind -->
    <link rel="stylesheet" href="/css/tailwind.min.css">

    <!-- Formio -->
    <link rel="stylesheet" href="/css/formio.full.min.css">

    <!-- Fslightbox -->
    <link rel="stylesheet" href="/css/fslightbox.min.css">

    <!-- IntlTelInput -->
    <link rel="stylesheet" href="/css/intlTelInput.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="/css/swiper-bundle.min.css">

    <link rel="stylesheet" href="/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/theme.css">
    <!-- Dev (Vite) -->
    <?php if (ENVIRONMENT === 'development'): ?>
        <script type="module" src="http://localhost:3000/@vite/client"></script>
    <?php else: ?>
        <!-- Produção (build do dist) -->
        <link rel="stylesheet" href="/dist/assets/app.css">
        <script type="module" src="/dist/assets/app.js"></script>
    <?php endif; ?>


    <!-- JQuery -->
    <script src="/js/libraries/JQuery/jquery-3.7.1.min.js"></script>
    <script src="/js/libraries/Mask/jquery.mask.min.js"></script>
    <script src="/js/libraries/IntlTelInput/intlTelInput.min.js"></script>


    <link rel="stylesheet" href="/css/dataTables/dataTables.css" />
  <link rel="stylesheet" href="/css/dataTables/responsive.dataTables.css" />

<body>