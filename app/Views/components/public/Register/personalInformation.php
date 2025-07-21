<div data-scenes="personalInformation">
    <div class="title-group">
        <p class="login-box-msg"><?= lang("Register.personal_informations.title") ?></p>
        <input type="hidden" name="is_social" value="<?= isset($socialData) ? "true" : "false" ?>">
    </div>
    <div class="form-row">
        <div class="col-12">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "name",
                "id" => "name",
                "className" => "",
                "disabled" => "",
                "value" => isset($socialData['name']) ? $socialData['name'] : null,
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
    <div class="form-row">
        <div class="col-12">
            <?= view("components/shared/forms/confirmEmail/index", [
                "form" => "register",
                "type" => "email",
                "name" => "login",
                "id" => "email",
                "className" => "",
                "value" => isset($socialData['email']) ? $socialData['email'] : null,
                "readonly" => isset($socialData['email']) ? true : null,
                "label" => "Login(Email)",
                "placeholder" => lang("Register.fields.email"),
                "icon" => view("assets/icons/light/mail"),
                "required" => true,
                "attributes" => [
                    "data-target-invalid" => "login",
                    "data-email" => "true",
                    "data-email-duply" => "true"
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-row justify-content-between">
        <div class="col-12 col-md-5">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "birthdate",
                "id" => "birthdate",
                "value" => "",
                "disabled" => "",
                "className" => "js-mask-date",
                "label" => ucfirst(lang("Words.birthdate")),
                "placeholder" => lang("Register.fields.birthdate"),
                "icon" => view("assets/icons/dark/infoCard"),
                "required" => true,
                "attributes" => [
                    "data-target-invalid" => "birthdate",
                    "data-target-birthdate" => "birthdate",
                    "data-cpf-field" => "birthdate",
                    "data-birthdate" => "true"
                ]
            ]) ?>
        </div>
        <div class="col-12 col-md-6">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "cpf",
                "id" => "cpf",
                "value" => "",
                "disabled" => "",
                "className" => "js-mask-cpf",
                "label" => ucfirst(lang("Words.cpf")),
                "placeholder" => lang("Register.fields.cpf"),
                "icon" => view("assets/icons/dark/infoCard"),
                "required" => true,
                "attributes" => [
                    "data-target-invalid" => "cpf",
                    "data-target-birthdate" => "birthdate",
                    "data-auto-complete" => "true",
                    "data-cpf-target" => "name:nome_da_pf/birthdate:data_nascimento",
                    "data-cpf" => "cpf",
                    "data-cpf-duply" => "true"
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-row">
        <div class="col-12 col-md-6">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "rg",
                "id" => "rg",
                "value" => "",
                "disabled" => "",
                "className" => "",
                "label" => ucfirst(lang("Words.rg")),
                "placeholder" => lang("Register.fields.rg"),
                "icon" => view("assets/icons/dark/infoCard"),
                "required" => true,
                "attributes" => [
                    "data-target-invalid" => "rg",
                    "data-rg" => "rg",
                    "data-rg-duply" => "true",
                    "data-clear-input" => "RG"
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-row justify-content-between">
        <div class="col-12 col-md-6">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "cell",
                "id" => "cell",
                "value" => "",
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
        <div class="col-12 col-md-6">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "phone",
                "id" => "phone",
                "value" => "",
                "disabled" => "",
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

    <?= view("/components/shared/forms/password/groupValidations") ?>
    <?= view("/components/shared/forms/password/confirm") ?>
    <div class="form-row">
        <div class="form-terms my-4">
            <div class="icheck-primary d-flex align-items-center">
                <div class="me-2">
                    <input type="radio" id="agreeTerms" name="terms" data-label="Termos de politica" value="agree" data-toggle="modal" data-target="#termsModal" data-target-invalid="terms" required>
                </div>
                <label for="agreeTerms">
                    Aceite os termos de uso dos dados conforme indicado nas nossas Políticas de Privacidade.
                    <?= view("/components/shared/forms/tooltip/required") ?>
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 my-2">
            <a class="btn btn-primary btn-block w-100" data-action-scenes data-back-scenes="true" data-target-scenes="switchAccount">
                <strong><?= ucfirst(lang("Words.go_back")) ?></strong>
            </a>
        </div>
        <!-- /.col -->
        <div class="col-12 col-md-6 my-2">
            <button type="submit" class="btn btn-success btn-block w-100" name='registerFrom'>
                <strong><?= ucfirst(lang("Words.save")) ?></strong>
            </button>
        </div>
        <!-- /.col -->
    </div>
</div>