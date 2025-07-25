<?php
echo form_open_multipart('/load/profile/update/', [
    "method" => "POST",
    "data-send" => "profileUpdate"
]);
?>
<div class="row">
    <div class="col-12">
        <div class="form-title mt-2 mb-3">
            <h5><i><u><strong><?= strtoupper(lang("Words.visibility")) ?></strong></u></i></h5>
        </div>
        <hr>
    </div>
</div>
<div class="form-row">
    <div class="col-12">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "name",
            "id" => "name",
            "className" => "",
            "disabled" => "",
            "value" => isset($profile['name']) ? $profile['name'] : null,
            "label" => ucfirst(lang("Words.name_complete")),
            "placeholder" => lang("Register.fields.name"),
            "icon" => view("assets/icons/dark/profile"),
            "required" => true,
            "attributes" => [
                "data-target-invalid" => "name"
            ]
        ]) ?>
    </div>
</div>
<div class="form-row mt-1">
    <div class="col-12">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "login",
            "id" => "login",
            "className" => "",
            "disabled" => "disabled",
            "value" => isset($profile['login']) ? $profile['login'] : null,
            "label" => ucfirst(lang("Words.login")),
            "icon" => view("assets/icons/dark/mail"),
            "required" => true,
            "attributes" => [
                "data-target-invalid" => "name"
            ]
        ]) ?>
    </div>
</div>
<div class="form-row mt-1">
    <div class="col-12">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "name" => "has_position",
            "id" => "hasPosition",
            "label" => ucfirst(lang("Words.role")),
            "icon" => view("assets/icons/dark/infoCard"),
            "disabled" => "disabled",
            "value" => isset($profile['role']) ? $profile['role'] : null,
            "attributes" => [
                "data-target-invalid" => "has_position",
            ]
        ]) ?>
    </div>
</div>

<div class="row mt-1">
    <div class="col-12">
        <hr>
        <div class="form-title mt-2 mb-3">
            <h5><i><u><strong><?= mb_strtoupper(lang("Words.documentation"), 'UTF-8') ?></strong></u></i></h5>
        </div>
        <hr>
    </div>
</div>
<div class="form-row mt-1 text-center">
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "cpf",
            "id" => "cpf",
            "column" => (object)[
                "label" => "col-md-2",
                "input" => "col-md-9"
            ],
            "className" => "js-mask-cpf",
            "disabled" => "disabled",
            "value" => isset($profile['cpf']) ? $profile['cpf'] : null,
            "label" => ucfirst(lang("Words.cpf")),
            "icon" => view("assets/icons/dark/infoCard"),
            "required" => true,
        ]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "rg",
            "id" => "rg",
            "column" => (object)[
                "label" => "col-md-2",
                "input" => "col-md-9"
            ],
            "disabled" => "disabled",
            "value" => isset($profile['rg']) ? $profile['rg'] : null,
            "label" => ucfirst(lang("Words.rg")),
            "icon" => view("assets/icons/dark/infoCard"),
            "required" => true
        ]) ?>
    </div>
</div>
<div class="form-row mt-1">
    <div class="col-12 col-md-10">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "birthdate",
            "id" => "birthdate",
            "className" => "js-mask-date",
            "column" => (object)[
                "label" => "col-md-3",
                "input" => "col-md-4"
            ],
            "value" => isset($profile['birthdate']) ? date("d/m/Y", strtotime($profile['birthdate'])) : null,
            "label" => ucfirst(lang("Words.birthdate")),
            "icon" => view("assets/icons/dark/date"),
            "required" => true
        ]) ?>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <hr>
        <div class="form-title mt-2 mb-3">
            <h5><i><u><strong><?= mb_strtoupper(lang("Words.kinship"), 'UTF-8') ?></strong></u></i></h5>
        </div>
        <hr>
    </div>
</div>

<div class="form-row justify-content-between">
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "mother",
            "id" => "mother",
            "value" => !empty($mother) ? $mother : '',
            "disabled" => "",
            "label" => ucfirst(lang("Words.name_mother")),
            "placeholder" => ucfirst(lang("Users.fields.kinship.mother")),
            "icon" => view("assets/icons/dark/infoCard"),
            "required" => true,
            "column" => (object)[
                "label" => "col-md-12",
                "input" => "col-md-12"
            ],
            "attributes" => []
        ]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "father",
            "id" => "father",
            "value" => !empty($father) ? $father : '',
            "className" => "",
            "label" => ucfirst(lang("Words.name_father")),
            "placeholder" => ucfirst(lang("Users.fields.kinship.father")),
            "icon" => view("assets/icons/dark/infoCard"),
            "required" => true,
            "column" => (object)[
                "label" => "col-md-12",
                "input" => "col-md-12"
            ],
            "attributes" => []
        ]) ?>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <hr>
        <div class="form-title mt-2 mb-3">
            <h5><i><u><strong><?= mb_strtoupper(lang("Words.address"), 'UTF-8') ?></strong></u></i></h5>
        </div>
        <hr>
    </div>
</div>
<div class="form-row justify-content-between">
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "zipcode",
            "id" => "zipcode",
            "label" => ucfirst(lang("Words.zipcode")),
            "column" => (object)[
                "label" => "col-md-3",
                "input" => "col-md-9"
            ],
            "className" => "js-mask-cep",
            "placeholder" => lang("Register.fields.zip_code"),
            "icon" => view("assets/icons/dark/infoCard"),
            "required" => "required",
            "value" => isset($profile['address']['zipcode']) ? $profile['address']['zipcode'] : null,
            "attributes" => [
                "data-cep" => "true",
                "data-auto-complete" => "true",
                "data-cep-target" => "state/city/district:bairro/street:logradouro/complement:complemento",
                "data-target-invalid" => "zipcode",
                "data-cep-enable-fields" => "true"
            ]
        ]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/SelectAdvanceGroup", [
            "form" => "profile.update",
            "name" => "country",
            "id" => "country",
            "className" => "",
            "label" => ucfirst(lang("Words.country")),
            "required" => "required",
            "options" => [],
            "column" => (object)[
                "label" => "col-md-3",
                "input" => "col-md-9"
            ],
            "icon" => view("assets/icons/dark/infoCard"),
            "value" => isset($profile['address']['country']) ? $profile['address']['country'] : null,
            "attributes" => [
                "data-address" => "country",
                "data-target-invalid" => "country"
            ]
        ]) ?>
    </div>
</div>
<div class="form-row d-flex justify-content-between mt-2">
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/SelectAdvanceGroup", [
            "form" => "profile.update",
            "name" => "state",
            "id" => "state",
            "label" => ucfirst(lang("Words.state")),
            "placeholder" => lang("Register.fields.state"),
            "required" => "required",
            "disabled" => !isset($storeValue['state']) ? "true" : "false",
            "className" => "",
            "options" => [],
            "value" => isset($profile['address']['state']) ? $profile['address']['state'] : null,
            "icon" => view("assets/icons/dark/infoCard"),
            "attributes" => [
                "data-address" => "state",
                "data-target-invalid" => "state",
                "data-cep-field" => "uf",
                "data-load-address" => "true",
                "data-city-target" => "city",
                "data-target-invalid" => "state",
                "data-state" => isset($profile['address']['state']) ? $profile['address']['state'] : null
            ]
        ]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/SelectAdvanceGroup", [
            "form" => "profile.update",
            "name" => "city",
            "id" => "city",
            "label" => ucfirst(lang("Words.city")),
            "placeholder" => lang("Register.fields.city"),
            "required" => "required",
            "value" => isset($profile['address']['city']) ? $profile['address']['city'] : null,
            "className" => "",
            "options" => [],
            "icon" => view("assets/icons/dark/infoCard"),
            "attributes" => [
                "data-cep-field" => "localidade",
                "data-target-invalid" => "city",
                "data-city" => isset($profile['address']['city']) ? $profile['address']['city'] : null
            ]
        ]) ?>
    </div>
</div>
<div class="form-row justify-content-between">
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "name" => "district",
            "id" => "district",
            "label" => ucfirst(lang("Words.district")),
            "placeholder" => lang("Register.fields.district"),
            "required" => "required",
            "value" => isset($profile['address']['district']) ? $profile['address']['district'] : null,
            "icon" => view("assets/icons/dark/infoCard"),
            "attributes" => [
                "data-target-invalid" => "district"
            ]
        ]) ?>
    </div>
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "name" => "street",
            "id" => "street",
            "label" => ucfirst(lang("Words.street")),
            "placeholder" => lang("Register.fields.street"),
            "required" => "required",
            "value" => isset($profile['address']['street']) ? $profile['address']['street'] : null,
            "icon" => view("assets/icons/dark/infoCard"),
            "attributes" => [
                "data-target-invalid" => "street"
            ]
        ]) ?>
    </div>
</div>
<div class="form-row justify-content-between">
    <div class="col-6">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "name" => "number",
            "id" => "number",
            "label" => ucfirst(lang("Words.number")),
            "placeholder" => lang("Register.fields.number"),
            "required" => "required",
            "disabled" => "false",
            "value" => isset($profile['address']['number']) ? $profile['address']['number'] : null,
            "icon" => view("assets/icons/dark/infoCard"),
            "attributes" => [
                "data-target-invalid" => "number"
            ]
        ]) ?>
    </div>
</div>
<div class="form-row justify-content-between">
    <div class="col-12">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "name" => "complement",
            "id" => "complement",
            "label" => ucfirst(lang("Words.complement")),
            "placeholder" => lang("Register.fields.complement"),
            "required" => "required",
            "column" => (object)[
                "label" => "col-md-2",
                "input" => "col-md-10"
            ],
            "value" => isset($profile['address']['complement']) ? $profile['address']['complement'] : null,
            "required" => false,
            "icon" => view("assets/icons/dark/infoCard"),
            "attributes" => [
                "data-target-invalid" => "complement"
            ]
        ]) ?>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <hr>
        <div class="form-title mt-2 mb-3">
            <h5><i><u><strong><?= mb_strtoupper(lang("Words.contacts"), 'UTF-8') ?></strong></u></i></h5>
        </div>
        <hr>
    </div>
</div>

<div class="form-row justify-content-between">
    <div class="col-12 col-md-6">
        <?php $cell = array_values(array_filter($profile['phones'], fn ($phone) => $phone['type'] == 'cell')) ?>
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "cell",
            "id" => "cell",
            "value" => isset($cell[0]) ? $cell[0]['link'] : '',
            "disabled" => "",
            "className" => "js-mask-celular",
            "label" => ucfirst(lang("Words.cell")),
            "placeholder" => null,
            "icon" => view("assets/icons/dark/infoCard"),
            "required" => true,
            "attributes" => [
                "data-target-invalid" => "cell"
            ]
        ]) ?>
    </div>
    <?php $phone = array_values(array_filter($profile['phones'], fn ($phone) => $phone['type'] == 'phone')) ?>
    <div class="col-12 col-md-6">
        <?= view("components/shared/forms/InputAdvanceGroup", [
            "form" => "profile.update",
            "type" => "text",
            "name" => "phone",
            "id" => "phone",
            "value" => isset($phone[0]) ? $phone[0]['link'] : '',
            "className" => "js-mask-celular",
            "label" => ucfirst(lang("Words.phone")),
            "placeholder" => null,
            "icon" => view("assets/icons/dark/infoCard"),
            "required" => false,
            "attributes" => [
                "data-target-invalid" => "phone"
            ]
        ]) ?>
    </div>
</div>


<div class="row justify-content-center pb-5 mt-5">
    <div class="col-12 mt-3">
        <div class="form-btn submit text-right">
            <button type="submit" name="updateProfileForm" class="btn btn-success col-12 col-md-3 ">Atualizar</button>
        </div>
    </div>
</div>

<?= form_close() ?>