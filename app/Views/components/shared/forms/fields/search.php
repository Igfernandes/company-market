<?php

$session = session();
$storeValue = $session->get($form ?? "");

if (isset($name) && isset($storeValue[$name]))
    $value = $storeValue[$name];
?>

<div class="search" component="search">
    <div class="relative shadow-sm border-gray-200 border-2 rounded-xl hover:border-2 hover:border-accent">
        <div class="w-100">
            <input type="text"
                name="<?= $name ?>"
                value="<?= isset($value) ? $value : null ?>"
                id="<?= $id ?? $name ?>"
                data-label="<?= $label ?>"
                placeholder="<?= $label ?>"
                class="form-control w-100 h-[2.3rem] bg-disabled text-lg px-2 py-1 pr-1 rounded-xl outline-accent focus:outline-solid <?= $className ?? null ?>"
                <?= getAttributes($attributes) ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "required" : null ?>
                <?= strval($readonly) ?? null ?>>
            <div component='search:action' class="absolute right-1 top-15 font-lg cursor-pointer font-bold text-gray-700">
                <i class="bi bi-search"></i>
            </div>
        </div>
    </div>
    <div class="invalid-message text-xs text-red-500 px-2 mt-1" data-invalid="<?= $name ?>">
    </div>
</div>