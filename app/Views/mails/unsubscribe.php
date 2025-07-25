<?= view('mails/_header') ?>
<tbody>
    <tr>
        <td style="
                    padding: 2rem ;
                ">
            <div style="max-width: 390px;margin: 0 auto;">
                <h1 style="
                        font-size: 1.4rem;
                        margin-bottom: 0;
                    "> <?= lang("Mails.unsubscribe.title") ?></h1>
            </div>
            <div style="max-width: 390px;margin: 0 auto;">
                <h1 style="
                        font-size: 1rem;
                        color: #d12d2d;
                        margin: 0;
                    "> <?= lang("Mails.unsubscribe.subtitle") ?></h1>
            </div>
            <div style="
                    margin: 20px auto 0;
                ">
                <p style="
                        font-size: 1.1rem;
                        color: #646464;
                        margin-top: .3rem;
                    ">
                    <?= $service->getName() ?>
                </p>
            </div>
        </td>
    </tr>
    <tr>
        <td style="padding: 0 1rem 1rem;">
            <ul style="list-style: none; text-align: left; padding: 0;">
                <?php if (!empty($service->getRealizedAt())): ?>
                    <li style="margin: 5px 0;">
                        🗓️ <strong><?= lang("Words.date") ?></strong>: <?= date("d/m/Y H:i", strtotime($service->getRealizedAt())) ?>
                        <?php
                        if (!empty($service->getExpiredAt())): ?>
                            Até <?= date("d/m/Y H:i", strtotime($service->getExpiredAt())) ?>
                        <?php endif; ?>
                    </li>
                <?php endif;

                if (!empty($client)): ?>
                    <li style="margin: 5px 0;">
                        👉🏽 <strong><?= lang("Words.name") ?></strong>: <?= $client ?>
                    </li>
                <?php endif; ?>
            </ul>
        </td>
    </tr>
    <tr>
        <td style="
                background: #F5F5F5;
                padding: 3.5rem 0;
            ">
            <div style="
                    max-width: 390px;
                    color: #646464;
                    margin: 0 auto;
                ">
                <p style="font-size: .8rem;">
                    <?= lang("Mails.unsubscribe.text_contact") ?>
                </p>
            </div>
        </td>
    </tr>
</tbody>
<?= view('mails/_footer') ?>