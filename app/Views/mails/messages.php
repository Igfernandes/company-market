<?= view('mails/_header') ?>
<tbody>
    <tr>
        <td style="background: #F5F5F5;padding: 3.5rem 0;">
            <div style=" margin: 1.75rem auto;">
                <p><?= $content ?? "[description]" ?></p>
            </div>
        </td>
    </tr>
</tbody>
<?= view('mails/_footer') ?>