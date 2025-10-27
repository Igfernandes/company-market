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

<div class="submit relative" component='submit'>
    <button
        class="bg-red-400 py-3 px-2 w-full rounded-sm text-white hover:bg-white border-2 hover:border-red-400 hover:text-red-400 shadow-md <?= $class ?>"
        type="submit"
        id="<?= $id ?>"
        disabled="true"
        <?= !empty($attributeData) ? $attributeData : null ?>>
        <strong><?= $text ?></strong>
    </button>
    <div class="is-loading absolute w-6 top-20 right-4 spin text-lg font-semibold cursor-pointer">
        <?= Component("/assets/icons/dark/loading", [
            "fill" => "#4d94ff"
        ]) ?>
    </div>
</div>