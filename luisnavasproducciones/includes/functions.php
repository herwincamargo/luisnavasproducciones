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

function format_date_spanish($date_string) {
    if (empty($date_string)) {
        return '';
    }

    // Establecer el locale a español
    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp');

    $timestamp = strtotime($date_string);

    if ($timestamp === false) {
        return '';
    }

    // Formatear la fecha usando strftime
    return strftime('%d %b %Y', $timestamp);
}
?>
