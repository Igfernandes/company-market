<?php
$session = session();
$storeValue = $session->get($form);

if (isset($storeValue[$name]))
    $value = $storeValue[$name];

?>

<div class="form-group">
    <label for="<?= $id ?? $name ?>">
        <strong>
            <i>
                <?= ucfirst($label) ?>
                <?= isset($required) && $required == "required" ?  view("/components/shared/forms/tooltip/required") : null ?>:
            </i>
        </strong>
    </label>
    <div class="d-flex p-relative mb-3">
        <div class="w-100">
            <input type="<?= $type ?? "text" ?>" name="<?= $name ?>" value="<?= isset($value) ? $value : null ?>" id="<?= $id ?? $name ?>" data-label="<?= $label ?>" class="form-control <?= $className ?? null ?>" placeholder="<?= $placeholder ?? null ?>" <?= $required ? "required" : null ?> <?= isset($storeValue[$name]) && $storeValue[$name] == $value && ($type == "checkbox" || $type == "radio")  ? "checked" : null  ?> <?= $readonly ?? null ?> data-confirm-email="field">
            <div class="invalid-tooltip" data-invalid="<?= $name ?>">
                <?= lang("Register.invalid.input") ?>
            </div>
        </div>
        <input type="hidden" name="tokenEmail" data-confirm-email='token-accept' />
        <div class="input-group-append " style="width: 120px;">
            <div class="input-group-text btn bg-primary text-light" data-confirm-email="btn">
                <span>
                    <strong class="mr-4" style="font-size: 14px;">Validar &nbsp;</strong>
                    <?= $icon ?>
                </span>
            </div>
        </div>
    </div>
</div>

<?= view("components/shared/forms/confirmEmail/_modal") ?>