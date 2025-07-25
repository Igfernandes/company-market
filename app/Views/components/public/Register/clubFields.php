<div class="club-fields <?= isset($_GET['account']) && $_GET['account'] == "club"  ? 'active-scenes' : null ?>" data-scenes="clubFields" data-rules-scenes="required-fields">
    <div class="form-row">
        <div class="col-12">
            <?= view("components/shared/forms/InputGroup", [
                "form" => "register",
                "type" => "text",
                "name" => "club[name]",
                "id" => "club_name",
                "className" => "",
                "label" => ucfirst(lang("Words.club.name")),
                "placeholder" => lang("Register.fields.club.name"),
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
                "name" => "club[cnpj]",
                "id" => "club_cnpj",
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
                "name" => "club[acronym]",
                "id" => "club_acronym",
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
                "name" => "club[ie]",
                "id" => "club_ie",
                "className" => "",
                "label" => ucfirst(lang("Words.ie")),
                "placeholder" => lang("Register.fields.ie"),
                "icon" => view("assets/icons/dark/infoCard"),
                "required" => "required",
                "attributes" => []
            ]) ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-12">
            <?= view("components/shared/forms/SelectGroup", [
                "form" => "register",
                "name" => "club[has_federation]",
                "id" => "clubHasFederation",
                "className" => "",
                "label" => ucfirst(lang("Register.fields.has_federation")),
                "placeholder" => lang("Register.fields.has_federation"),
                "icon" => view("assets/icons/dark/arrowDown"),
                "required" => "required",
                "options" => [
                    [
                        "text" => lang("Words.select_option"),
                        "value" =>  ""
                    ],
                    [
                        "text" => lang("Register.fields.not_inscribe"),
                        "value" => "false"
                    ]
                ],
                "attributes" => [
                    "data-target-invalid" => "club[has_federation]",
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
            <a class="btn btn-success btn-block w-100" data-action-scenes data-target-scenes="addressFields">
                <strong><?= ucfirst(lang("Words.advance")) ?></strong>
            </a>
        </div>
        <!-- /.col -->
    </div>
</div>