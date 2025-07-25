<?php
$session = session();
$storeValue = $session->get("register");

if (isset($_GET['account']))
    $account = $_GET['account'];
elseif (isset($storeValue['account']))
    $account = $storeValue['account'];
?>

<div class="cards_account mt-2 <?= !isset($account) ? 'active-scenes' : null ?>" data-scenes="switchAccount">
    <div class="cards_account-title">
        <h3><strong><?= lang('Register.switchAccount.title') ?></strong></h3>
    </div>
    <div class="cards_account-group">
        <div class="cards_account-box">
            <div class="cards_account-type" data-action-scenes data-target-scenes="affiliateFields">
                <div class="cards_account-type-icon">
                    <input type="radio" name="account" value="affiliate" <?= isset($account) && $account == 'affiliate' ? 'checked' : null ?>>
                    <img src="/img/icons/athlete.png" alt="icon of Athlete">
                </div>
            </div>
            <div class="cards_account-describe">
                <div class="cards_account-describe-text">
                    <p><?= lang("Register.switchAccount.athlete_describe") ?></p>
                </div>
            </div>
        </div>
        <div class="cards_account-box">
            <div class="cards_account-type" data-action-scenes data-target-scenes="clubFields">
                <div class="cards_account-type-icon">
                    <input type="radio" name="account" value="club" <?= isset($account) && $account == 'club' ? 'checked' : null ?>>
                    <img src="/img/icons/club.png" alt="icon of club">
                </div>
            </div>
            <div class="cards_account-describe">
                <div class="cards_account-describe-text">
                    <p><?= lang("Register.switchAccount.club_describe") ?></p>
                </div>
            </div>
        </div>
        <div class="cards_account-box">
            <div class="cards_account-type" data-action-scenes data-target-scenes="federationFields">
                <div class="cards_account-type-icon">
                    <input type="radio" name="account" value="federation" <?= isset($account) && $account == 'federation' ? 'checked' : null ?>>
                    <img src="/img/icons/federation.png" alt="icon of federation">
                </div>
            </div>
            <div class="cards_account-describe">
                <div class="cards_account-describe-text">
                    <p><?= lang("Register.switchAccount.federation_describe") ?></p>
                </div>
            </div>
        </div>
    </div>
</div>