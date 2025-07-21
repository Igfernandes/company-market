
<div class="affiliate-fields <?= isset($_GET['account']) && $_GET['account'] == "affiliate"  ? 'active-scenes' : null ?>" data-scenes="affiliateFields" data-rules-scenes="required-fields">
    <div class="form-row mt-2 mb-3">
        <div class="col-12 col-md-5">
            <?= view("components/shared/forms/SelectGroup", [
                "form" => "register",
                "name" => "is_athlete",
                "id" => "isAthlete",
                "label" => ucfirst(lang("Register.fields.is_athlete")),
                "placeholder" => lang("Register.fields.is_athlete"),
                "icon" => view("assets/icons/dark/arrowDown"),
                "required" => true,
                "options" => [
                    [
                        "text" => lang("Words.not"),
                        "value" => lang("Words.not")
                    ],
                    [
                        "text" => lang("Words.yes"),
                        "value" => lang("Words.yes")
                    ]
                ],
                "attributes" => [
                    "data-target-invalid" => "is_athlete",
                ]
            ]) ?>
        </div>
        <div class="col-12 col-md-7">
            <?= view("components/shared/forms/MultipleGroup", [
                "form" => "register",
                "name" => "has_position",
                "id" => "hasPosition",
                "label" => ucfirst(lang("Register.fields.has_position.label")),
                "placeholder" => lang("Register.fields.has_position.label"),
                "icon" => view("assets/icons/dark/arrowDown"),
                "required" => true,
                "options" => [
                    [
                        "text" => lang("Register.fields.has_position.options.not"),
                        "value" => "false"
                    ],
                    [
                        "text" => lang("Register.fields.has_position.options.federative_leader"),
                        "value" => strtolower(lang("Register.fields.has_position.options.federative_leader"))
                    ],
                    [
                        "text" => lang("Register.fields.has_position.options.classifier"),
                        "value" => strtolower(lang("Register.fields.has_position.options.classifier"))
                    ],
                    [
                        "text" => lang("Register.fields.has_position.options.international_judge"),
                        "value" => strtolower(lang("Register.fields.has_position.options.international_judge"))
                    ],
                    [
                        "text" => lang("Register.fields.has_position.options.continental_judge"),
                        "value" => strtolower(lang("Register.fields.has_position.options.continental_judge"))
                    ],
                    [
                        "text" => lang("Register.fields.has_position.options.national_judge"),
                        "value" => strtolower(lang("Register.fields.has_position.options.national_judge"))
                    ],
                    [
                        "text" => lang("Register.fields.has_position.options.state_judge"),
                        "value" => strtolower(lang("Register.fields.has_position.options.state_judge"))
                    ],
                    [
                        "text" => lang("Register.fields.has_position.options.candidate_judge"),
                        "value" => strtolower(lang("Register.fields.has_position.options.candidate_judge"))
                    ],
                    [
                        "text" => lang("Register.fields.has_position.options.instructor"),
                        "value" => strtolower(lang("Register.fields.has_position.options.instructor"))
                    ],
                    [
                        "text" => lang("Register.fields.has_position.options.technician"),
                        "value" => strtolower(lang("Register.fields.has_position.options.technician"))
                    ]
                ],
                "attributes" => [
                    "data-target-invalid" => "has_position",
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-row  my-2">
        <div class="col-12">
            <?= view("components/shared/forms/SelectGroup", [
                "form" => "register",
                "name" => "has_federation",
                "id" => "hasFederation",
                "label" => ucfirst(lang("Register.fields.has_federation")),
                "placeholder" => lang("Register.fields.has_federation"),
                "icon" => view("assets/icons/dark/arrowDown"),
                "required" => true,
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
                    "data-target-invalid" => "has_federation",
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-row  my-2">
        <div class="col-12">
            <?= view("components/shared/forms/SelectGroup", [
                "form" => "register",
                "name" => "has_club",
                "id" => "hasClub",
                "label" => ucfirst(lang("Register.fields.has_club")),
                "placeholder" => lang("Register.fields.has_club"),
                "icon" => view("assets/icons/dark/arrowDown"),
                "required" => true,
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
                    "data-target-invalid" => "has_club",
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