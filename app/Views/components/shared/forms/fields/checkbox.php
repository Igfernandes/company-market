<?php
$session = session();
$storeValue = $session->get($form ?? "");
$attributeData = "";

if (isset($attributes)) {
    $attributesRef = [];
    foreach ($attributes as $index => $attribute) {
        if (empty($attribute)) continue;
        array_push($attributesRef, join("=", [$index, $attribute]));
    }

    $attributeData = join(" ", $attributesRef);
}

if (isset($storeValue[$name]))
    $value = $storeValue[$name];

if (isset($readonly)) {
    $readonly = "readonly";
}

$id = !empty($id) ? $id : uniqid(str_replace("[]", "", $name));
?>

<div class="checkbox" component='checkbox'>
    <div class="flex items-center ">
        <div class="relative">
            <input type="checkbox"
                name="<?= $name ?>"
                value="<?= isset($value) ? $value : null ?>"
                id="<?= $id ?>"
                class="checkbox appearance-none bg-accent rounded-xs  cursor-pointer <?= $class ?? "" ?>"
                data-label="<?= $label ?>"
                <?= $checked ? "checked" : null ?>
                <?= !empty($attributeData) ? $attributeData : null ?>
                <?= isset($disabled) ? strval($disabled) : null  ?>
                <?= $required ? "true" : null ?>
                <?= isset($storeValue[$name]) && $storeValue[$name] == $value && isset($type) ?>
                <?= strval($readonly) ?? null ?>>
            <i class="bi bi-check absolute left-1 bottom-6 text-white"></i>
        </div>
        <label class="ml-1 cursor-pointer form-check-label <?= $class ?>" for="<?= $id ?>">
            <?= ucfirst($label) ?>
            <?= isset($required) && $required == "true" ?  Component("/components/shared/forms/variants/tooltip/required") : "" ?>
        </label>
    </div>
</div>