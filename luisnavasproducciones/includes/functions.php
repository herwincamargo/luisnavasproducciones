<?php
function slugify($text) {
    // Reemplazar caracteres no alfanuméricos por -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // Transliterar
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Eliminar caracteres no deseados
    $text = preg_replace('~[^-\w]+~', '', $text);

    // Trim
    $text = trim($text, '-');

    // Eliminar duplicados
    $text = preg_replace('~-+~', '-', $text);

    // Convertir a minúsculas
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}
?>
