<?php
$attributeData = "";

if (isset($attributes)) {
    $attributesRef = [];
    foreach ($attributes as $index => $attribute) {
        if (empty($attribute)) continue;
        array_push($attributesRef, join("=", [$index, $attribute]));
    }

    $attributeData = join(" ", $attributesRef);
}

$id = !empty($id) ? $id : "btn_" . date("HHmmss");
?>

<div class="button relative" component='button'>
    <button
        class="py-3 px-2 w-full rounded-sm border-2 shadow-md <?= $class ?? "bg-theme text-white hover:bg-white hover:border-theme hover:text-theme" ?>"
        type="button"
        id="<?= $id ?>"
        <?= !empty($attributeData) ? $attributeData : null ?>>
        <strong><?= $text ?></strong>
    </button>
</div>