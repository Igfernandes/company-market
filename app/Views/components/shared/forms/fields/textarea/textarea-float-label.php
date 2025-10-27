<?php

use App\Components\Shared\Forms\Variants\CounterField\CounterField;

$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];

?>

<div class="textarea mb-3" component="textarea-float-label">
    <div class="relative shadow-sm border-gray-200 border-2 rounded-md">
        <div class="w-100 relative">
            <textarea
                name="<?= $name ?>"
                id="<?= !empty($id) ? $id : $name ?>"
                data-label="<?= $label ?>"
                class="form-control w-100 h-[10rem] text-sm lg:text-lg pl-2 pr-9 pt-5 rounded-sm outline-theme focus:outline-solid <?= $className ?? null ?>"
                <?= !empty($placeholder) ? "placeholder='$placeholder'" : null ?>
                <?= getAttributes($attributes) ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= isset($maxLength) ? "maxlength='$maxLength'" : null  ?>
                <?= $required ? "required" : null ?>
                <?= strval($readonly) ?? null ?>><?= isset($value) ? $value : null ?></textarea>
            <?php if (!isset($labelNot)) : ?>
                <label class="absolute left-2 top-8 pl-1 text-sm lg:text-lg text-black-500" data-label-toggle component="input:label" for="<?= !empty($id) ? $id : $name ?>">
                    <strong class="font-arial">
                        <?= ucfirst($label) ?>
                        <?= isset($required) && $required == "true" ?  Component("/components/shared/forms/variants/tooltip/required") : null ?>
                    </strong>
                </label>
            <?php endif; ?>
            <?= CounterField::render(
                initial: isset($value) ? strlen($value) : 0,
                max: isset($maxLength) ? $maxLength  : 0,
                target: $name
            ) ?>
        </div>
    </div>
    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>">
    </div>
</div>