<?= view('mails/_header') ?>
<tbody>
    <tr>
        <td style="padding: 2rem 2rem 3rem;">
            <?php if (isset($image)): ?>
                <div>
                    <img src="<?= $image ?>" style="width: 100%;height: 200px; object-fit: cover;" alt="Image service">
                </div>
            <?php endif; ?>
            <div style="max-width: 390px;margin: 0 auto;">
                <h1 style="
                        font-size: 1.2rem;
                        margin-bottom: 0;
                    "><?= $title ?? "[title]" ?></h1>
            </div>
        </td>
    </tr>
    <tr>
        <td style="
                background: #F5F5F5;
                padding: 3.5rem 0;
            ">

            <div style=" margin: 1.75rem auto;">
                <p><?= $description ?? "[description]" ?></p>
            </div>
            <div style="
                    max-width: 390px;
                    margin: 1.75rem auto;
                ">
                <a href="<?= $link ?? "[link]"; ?>" target="_blank" rel="noopener noreferrer"
                    style="
                        background: #BC2224;
                        padding: .75rem 5rem;
                        color: #fff;
                        text-decoration: none;
                        border-radius: .75rem;
                        display: inline-block;
                    ">
                    <?= lang("Mails.service.text_button") ?>
                </a>
            </div>
            <div style="
                    max-width: 390px;
                    color: #646464;
                    margin: 0 auto;
                ">
                <p style="font-size: .8rem;"> <?= lang("Mails.charges.text_about_problems_button") ?></p>
            </div>
            <div style="
                    max-width: 390px;
                    margin: 0 auto;
                    ">
                <a href="<?= $link ?? "[link]"; ?>" target="_blank" rel="noopener noreferrer"
                    style="
                        color: #101010;
                        text-decoration: none;
                        font-size: .8rem;">
                    <?= $link ?? "[link]";  ?>
                </a>
            </div>
        </td>
    </tr>
</tbody>
<?= view('mails/_footer') ?>