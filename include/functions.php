<?php
function generateUniqueCode() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < 10; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
}