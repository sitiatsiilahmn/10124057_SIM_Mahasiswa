<?php
/**
 * Fitur dual bahasa. Pilihan bahasa disimpan di $_SESSION['lang']
 * sehingga tetap konsisten saat pindah halaman.
 */
const AVAILABLE_LANGS = ['id', 'en'];

if (empty($_SESSION['lang']) || !in_array($_SESSION['lang'], AVAILABLE_LANGS, true)) {
    $_SESSION['lang'] = 'id'; // bahasa default
}

$GLOBALS['TRANSLATIONS'] = require __DIR__ . '/../lang/' . $_SESSION['lang'] . '.php';

/** Ambil teks terjemahan berdasarkan kunci. Mendukung placeholder sprintf. */
function t(string $key, ...$args): string
{
    $text = $GLOBALS['TRANSLATIONS'][$key] ?? $key;
    return $args ? vsprintf($text, $args) : $text;
}
