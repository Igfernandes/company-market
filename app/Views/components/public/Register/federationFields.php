<div class="federation-fields <?= isset($_GET['account']) && $_GET['account'] == "federation"  ? 'active-scenes' : null ?>" data-scenes="federationFields" data-rules-scenes="required-fields">
    <div class="form-row">
        <div class="col-12">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "federation[name]",
                "id" => "federation_name",
                "className" => "",
                "label" => ucfirst(lang("Words.federation.name")),
                "placeholder" => lang("Register.fields.federation.name"),
                "icon" => view("assets/icons/dark/infoCard"),
                "required" => "required",
                "attributes" => []
            ]) ?>
        </div>
    </div>
    <div class="form-row">
        <div class="col-12">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "federation[cnpj]",
                "id" => "federation_cnpj",
                "className" => "js-mask-cnpj",
                "label" => ucfirst(lang("Words.cnpj")),
                "placeholder" => lang("Register.fields.cnpj"),
                "icon" => view("assets/icons/dark/infoCard"),
                "required" => "required",
                "attributes" => [
                    "data-cnpj" => "true",
                    "data-cnpj-duply" => "true"
                ]
            ]) ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-12 col-md-6">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "federation[acronym]",
                "id" => "federation_acronym",
                "className" => "",
                "label" => ucfirst(lang("Words.acronym")),
                "placeholder" => lang("Register.fields.acronym"),
                "icon" => view("assets/icons/dark/infoCard"),
                "required" => "required",
                "attributes" => []
            ]) ?>
        </div>
        <div class="col-12 col-md-6">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "federation[ie]",
                "id" => "federation_ie",
                "className" => "",
                "label" => ucfirst(lang("Words.ie")),
                "placeholder" => lang("Register.fields.ie"),
                "icon" => view("assets/icons/dark/infoCard"),
                "required" => "required",
                "attributes" => []
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
            <a class="btn btn-success btn-block w-100" data-action-scenes data-target-scenes="addressFields">
                <strong><?= ucfirst(lang("Words.advance")) ?></strong>
            </a>
        </div>
        <!-- /.col -->
    </div>
</div>