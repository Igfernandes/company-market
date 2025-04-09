<?= view('mails/_header') ?>
<tbody>
    <tr>
        <td style="
                    padding: 2rem 2rem 3rem;
                ">
            <div style="max-width: 390px;margin: 0 auto;">
                <h1 style="
                        font-size: 1.2rem;
                        margin-bottom: 0;
                    "> <?= str_replace("{name}", $name, lang("Mails.alter_password.title")) ?></h1>
            </div>
            <div style="
                    max-width: 390px;
                    margin: 0 auto;
                ">
                <p style="
                        font-size: .8rem;
                        color: #646464;
                        margin-top: .3rem;
                    ">
                    <?= lang("Mails.alter_password.subtitle") ?>
                </p>
            </div>
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
                    <?= lang("Mails.alter_password.text_about_date_created") . " " . date(lang('masks.date'), strtotime($createdAt)) . " às " . date(lang('masks.time'), strtotime($createdAt)) ?>
                </p>
            </div>
            <div style="
                    max-width: 390px;
                    color: #646464;
                    margin: 0 auto;
                ">
                <p style="font-size: .8rem;">
                    <?= lang("Words.country_region") ?>
                    <br>
                    <span><?= $country ?></span>
                </p>
                <div style="
                    max-width: 390px;
                    color: #646464;
                    margin: 0 auto;
                ">
                    <p style="font-size: .8rem;">
                        <?= lang("Words.platform") ?>
                        <br>
                        <span><?= $platform ?></span>
                    </p>
                </div>
                <div style="
                    max-width: 390px;
                    color: #646464;
                    margin: 0 auto;
                ">
                    <p style="font-size: .8rem;">
                        <?= lang("Words.browser") ?>
                        <br>
                        <span><?= $browser ?></span>
                    </p>
                </div>
                <div style="
                    max-width: 390px;
                    color: #646464;
                    margin: 0 auto;
                ">
                    <p style="font-size: .8rem;">
                        <?= lang("Words.address_ip") ?>
                        <br>
                        <span><?= $ipAddress ?></span>
                    </p>
                </div>
                <div style="
                    max-width: 390px;
                    color: #646464;
                    margin: 0 auto;
                ">
                    <p style="font-size: .8rem;">
                        <?= lang("Mails.alter_password.alert_about_email") ?>
                    </p>
                </div>
            </div>
        </td>
    </tr>
</tbody>
<?= view('mails/_footer') ?>