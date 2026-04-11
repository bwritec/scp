<?php

namespace App\Validation;

class MyRules
{
    /**
     * Valida se o CPF é válido
     */
    public function is_cpf(string $str, string &$error = null): bool
    {
        /**
         * Remove tudo que não for número
         */
        $cpf = preg_replace('/[^0-9]/', '', $str);

        /**
         * Tem que ter 11 dígitos
         */
        if (strlen($cpf) != 11) {
            return false;
        }

        /**
         * Rejeita CPFs com todos os números iguais
         */
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        /**
         * Calcula os dígitos verificadores
         */
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}