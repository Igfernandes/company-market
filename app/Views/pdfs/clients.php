<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 100px 50px;
            /* espaço para cabeçalho e rodapé */
        }

        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 60px;
            text-align: center;
            line-height: 35px;
            font-size: 18px;
            border-bottom: 1px solid #000;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            font-size: 14px;
            border-top: 1px solid #000;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>

<body>

    <header>
        Cabeçalho do Documento
    </header>

    <footer>
        Rodapé - Página {PAGE_NUM} de {PAGE_COUNT}
    </footer>

    <main>
        <h1>Conteúdo principal</h1>
        <p>Texto repetido para testar a quebra de página...</p>
        ' . str_repeat("<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>", 50) . '
    </main>

</body>

</html>