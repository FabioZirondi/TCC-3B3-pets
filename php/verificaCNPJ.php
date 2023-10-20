<?php

    function validarCnpj($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

    // Verifica se o CNPJ tem 14 caracteres
    if (strlen($cnpj) != 14) {
        return false;
    }

    // Verifica se todos os caracteres são iguais, o que é um CNPJ inválido
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }

    // Calcula o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 12; $i++) {
        $soma += (int) $cnpj[$i] * (($i < 4) ? 5 - $i : 13 - $i);
    }
    $resto = $soma % 11;
    $digitoVerificador1 = ($resto < 2) ? 0 : 11 - $resto;

    // Verifica o primeiro dígito verificador
    if ((int) $cnpj[12] !== $digitoVerificador1) {
        return false;
    }

    // Calcula o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 13; $i++) {
        $soma += (int) $cnpj[$i] * (($i < 5) ? 6 - $i : 14 - $i);
    }
    $resto = $soma % 11;
    $digitoVerificador2 = ($resto < 2) ? 0 : 11 - $resto;

    // Verifica o segundo dígito verificador
    if ((int) $cnpj[13] !== $digitoVerificador2) {
        return false;
    }

    // CNPJ válido
    return true;
}

?>
