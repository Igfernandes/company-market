<?php

$session = session();
$storeValue = $session->get($form);

if (isset($storeValue[$name]))
    $value = $storeValue[$name];

?>

<div class="multiple-group shadow-sm px-2 pb-2 p-relative mx-1">
    <div class="mb-1">
        <?php if (!isset($labelNot)) : ?>
            <label for="<?= $id ?? $name ?>">
                <strong>
                    <i>
                        <?= ucfirst($label) ?>
                        <?= isset($required) && $required == "required" ?  view("/components/shared/forms/tooltip/required") : null ?>:
                    </i>
                </strong>
            </label>
        <?php endif; ?>
    </div>
    <div class="multiple-group-content border p-2">
        <?php
        if (isset($options) && is_array($options)) :
            foreach ($options as $index => $option) : ?>
                <div class="form-check form-switch ">
                    <label for="<?= str_replace([" ", ".", "-"], "", $option['value']) ?>" class="custom-control-label"><?= $option['text'] ?></label>
                    <?php if (isset($option['value']) && !empty($option['value'])) : ?>
                        <input name="<?= $name ?>[]" id="<?= str_replace([" ", ".", "-"], "", $option['value']) ?>" value="<?= $option['value'] ?>" class="form-check-input float-end" type="checkbox" <?= ($index == 0 && !isset($value)) || (isset($value) && array_search($option['value'], $value) !== false)  ? "checked" : null ?>>
                        <?php if ($index == 0) : ?>
                            <div class="invalid-tooltip" data-invalid="<?= $name ?>">
                                <?= lang("Register.invalid.input") ?>
                            </div>
                    <?php
                        endif;
                    endif; ?>
                </div>
        <?php endforeach;
        endif; ?>
    </div>
</div>
<script>
    const checkboxs = document.querySelectorAll("[name='<?= $name ?>[]']")

    checkboxs.forEach((checkbox) => checkbox.addEventListener("change", (ev) => {
        const element = ev.currentTarget;
        const amountChecked = Array.from(checkboxs).filter((checkbox) => checkbox.checked == true)

        if (amountChecked.length == 0) {
            checkboxs[0].checked = true;
        } else {
            checkboxs[0].checked = false;
        }
    }))
</script>