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
                    "> <?= lang("Mails.inscribes.title") ?></h1>
            </div>
            <div style="max-width: 390px;margin: 0 auto;">
                <h1 style="
                        font-size: 1rem;
                        color: #d12d2d;
                        margin: 0;
                    "> <?= lang("Mails.inscribes.subtitle") ?></h1>
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

                if (!empty($service->getAddress())): ?>
                    <li style="margin: 5px 0;">
                        📍<strong><?= lang("Words.meeting_point") ?></strong>: <?= $service->getAddress() ?>
                    </li>
                <?php endif;
                if (!empty($client)): ?>
                    <li style="margin: 5px 0;">
                        👉🏽<strong><?= lang("Words.name") ?></strong>: <?= $client ?>
                    </li>
                <?php endif; ?>
            </ul>
            <?php
            if (!empty($service->getAlerts())): ?>
                <div style="font-size: .8rem;text-align: left;margin: 1rem 0;">
                    <h2 style="text-align: center;color: red;"><u>AVISOS</u></h2>
                    <?= $service->getAlerts() ?>
                </div>
            <?php endif; ?>
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
                    <?= lang("Mails.inscribes.text_about_button") ?>
                </p>
            </div>
            <div style="
                    max-width: 390px;
                    margin: 1.75rem auto;
                ">
                <a href="<?= getenv('globals.href.frontend') ?>/services/confirmation?key=<?= $service->getId() ?>" target="_blank" rel="noopener noreferrer"
                    style="
                        background: #BC2224;
                        padding: .75rem 5rem;
                        color: #fff;
                        text-decoration: none;
                        border-radius: .75rem;
                        display: inline-block;
                    ">
                    <?= lang("Mails.inscribes.text_button") ?>
                </a>
            </div>
            <div style="
                    max-width: 390px;
                    color: #646464;
                    margin: 0 auto;
                ">
                <p style="font-size: .8rem;"> <?= lang("Mails.inscribes.text_about_problems_button") ?></p>
            </div>
            <div style="
                    max-width: 390px;
                    margin: 0 auto;
                    ">
                <a href="<?= getenv('globals.href.frontend') ?>/services/confirmation?key=<?= $service->getId() ?>" target="_blank" rel="noopener noreferrer"
                    style="
                        color: #101010;
                        text-decoration: none;
                        font-size: .8rem;">
                    <?= getenv('globals.href.frontend') ?>/services?key=<?= $service->getId() ?>
                </a>
            </div>
        </td>
    </tr>
</tbody>
<?= view('mails/_footer') ?>