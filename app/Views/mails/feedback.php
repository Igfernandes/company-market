<?= view('mails/_header') ?>
<tbody>
    <tr>
        <td style="
                    padding: 2rem 2rem 3rem;
                ">
            <div style="text-align: center;">
                <h1 style="
                        font-size: 2rem;
                        margin-bottom: 0;
                    "> Novo cliente vinculado</h1>
            </div>
        </td>
    </tr>
    <tr>
        <td style="background: #F5F5F5;padding: 1rem 2rem;">
            <h3>Dados do Cliente</h3>
            <p>Nome: <?= $name ?? "" ?></p> <br>
            <p>E-mail: <?= $email ?? "" ?></p> <br>
            <p>Assunto: <?= $subject ?? "" ?></p> <br>
            <p>Mensagem: <?= $message ?? "" ?></p> <br>
        </td>
    </tr>
</tbody>
<?= view('mails/_footer') ?>