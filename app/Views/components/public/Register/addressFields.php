<?php
$session = session();
$storeValue = $session->get("register");
?>

<div data-scenes="addressFields" data-rules-scenes="required-fields">
    <div class="title-group">
        <p class="login-box-msg"><?= lang("Register.address_fields.title") ?></p>
    </div>
    <div class="form-row d-flex justify-content-between">
        <div class="col-12 col-md-6">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "zipcode",
                "id" => "zipcode",
                "label" => ucfirst(lang("Words.zipcode")),
                "className" => "js-mask-cep",
                "placeholder" => lang("Register.fields.zip_code"),
                "icon" => view("assets/icons/dark/infoCard"),
                "required" => "required",
                "disabled" => "",
                "attributes" => [
                    "data-cep" => "true",
                    "data-auto-complete" => "true",
                    "data-cep-target" => "state/city/district:bairro/street:logradouro/complement:complemento",
                    "data-target-invalid" => "zipcode",
                    "data-cep-enable-fields" => "true"
                ]
            ]) ?>
        </div>
        <div class="col-12 col-md-5">
            <?= view("components/shared/forms/SelectGroup", [
                "form" => "register",
                "name" => "country",
                "id" => "country",
                "className" => "",
                "label" => ucfirst(lang("Words.country")),
                "placeholder" => lang("Register.fields.zip_code"),
                "required" => "required",
                "options" => [],
                "icon" => view("assets/icons/dark/infoCard"),
                "attributes" => [
                    "data-address" => "country",
                    "data-target-invalid" => "country"
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-row d-flex justify-content-between">
        <div class="col-12 col-md-6">
            <?= view("components/shared/forms/SelectGroup", [
                "form" => "register",
                "name" => "state",
                "id" => "state",
                "label" => ucfirst(lang("Words.state")),
                "placeholder" => lang("Register.fields.state"),
                "required" => "required",
                "disabled" => !isset($storeValue['state']) ? "true" : "false",
                "className" => "",
                "options" => [],
                "icon" => view("assets/icons/dark/infoCard"),
                "attributes" => [
                    "data-address" => "state",
                    "data-target-invalid" => "state",
                    "data-cep-field" => "uf",
                    "data-load-address" => "true",
                    "data-city-target" => "city",
                    "data-target-invalid" => "state",
                    "data-state" => isset($storeValue['state']) ? $storeValue['state'] : null
                ]
            ]) ?>
        </div>
        <div class="col-12 col-md-5">
            <?= view("components/shared/forms/SelectGroup", [
                "form" => "register",
                "name" => "city",
                "id" => "city",
                "label" => ucfirst(lang("Words.city")),
                "placeholder" => lang("Register.fields.city"),
                "required" => "required",
                "disabled" => !isset($storeValue['city']) ? "true" : "false",
                "className" => "",
                "options" => [],
                "icon" => view("assets/icons/dark/infoCard"),
                "attributes" => [
                    "data-cep-field" => "localidade",
                    "data-target-invalid" => "city",
                    "data-city" => isset($storeValue['city']) ? $storeValue['city'] : null
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-row justify-content-between">
        <div class="col-12 col-md-5">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "name" => "district",
                "id" => "district",
                "label" => ucfirst(lang("Words.district")),
                "placeholder" => lang("Register.fields.district"),
                "required" => "required",
                "disabled" => !isset($storeValue['district']) ? "true" : "false",
                "className" => "",
                "icon" => view("assets/icons/dark/infoCard"),
                "attributes" => [
                    "data-target-invalid" => "district"
                ]
            ]) ?>
        </div>
        <div class="col-12 col-md-6">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "name" => "street",
                "id" => "street",
                "label" => ucfirst(lang("Words.street")),
                "placeholder" => lang("Register.fields.street"),
                "required" => "required",
                "disabled" => !isset($storeValue['street']) ? "true" : "false",
                "className" => "",
                "icon" => view("assets/icons/dark/infoCard"),
                "attributes" => [
                    "data-target-invalid" => "street"
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-row justify-content-between">
        <div class="col-3">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "name" => "number",
                "id" => "number",
                "label" => ucfirst(lang("Words.number")),
                "placeholder" => lang("Register.fields.number"),
                "required" => "required",
                "disabled" => "false",
                "className" => "",
                "icon" => view("assets/icons/dark/infoCard"),
                "attributes" => [
                    "data-target-invalid" => "number"
                ]
            ]) ?>
        </div>
        <div class="col-8">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "name" => "complement",
                "id" => "complement",
                "label" => ucfirst(lang("Words.complement")),
                "placeholder" => lang("Register.fields.complement"),
                "required" => "required",
                "disabled" => "false",
                "className" => "",
                "required" => false,
                "icon" => view("assets/icons/dark/infoCard"),
                "attributes" => [
                    "data-target-invalid" => "complement"
                ]
            ]) ?>
        </div>
    </div>

    <div class="row">
        <!-- /.col -->
        <div class="col-12 col-md-6 my-2">
            <a class="btn btn-primary btn-block w-100" data-action-scenes data-back-scenes="true" data-target-scenes="switchAccount">
                <strong><?= ucfirst(lang("Words.go_back")) ?></strong>
            </a>
        </div>
        <div class="col-12 col-md-6 my-2">
            <a class="btn btn-success btn-block w-100" data-action-scenes data-target-scenes="personalInformation">
                <strong><?= ucfirst(lang("Words.advance")) ?></strong>
            </a>
        </div>
        <!-- /.col -->
    </div>
</div>