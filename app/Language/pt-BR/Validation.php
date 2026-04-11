<?php

return [
    // Mensagens genéricas
    'required'      => 'O campo {field} é obrigatório.',
    'min_length'    => 'O campo {field} deve ter pelo menos {param} caracteres.',
    'max_length'    => 'O campo {field} não pode ultrapassar {param} caracteres.',
    'exact_length'  => 'O campo {field} deve ter exatamente {param} caracteres.',
    'matches'       => 'O campo {field} deve ser igual ao campo {param}.',
    'is_unique'     => 'O {field} informado já está em uso.',
    'valid_email'   => 'O campo {field} deve conter um e-mail válido.',
    'alpha'         => 'O campo {field} deve conter apenas letras.',
    'alpha_numeric' => 'O campo {field} deve conter apenas letras e números.',
    'numeric'       => 'O campo {field} deve conter apenas números.',
    'integer'       => 'O campo {field} deve conter um número inteiro.',
    'greater_than'  => 'O campo {field} deve ser maior que {param}.',
    'less_than'     => 'O campo {field} deve ser menor que {param}.',

    // Custom rule (ex: CPF)
    'is_cpf'        => 'O CPF informado não é válido.',

    // Outras mensagens úteis
    'regex_match'   => 'O campo {field} não está no formato correto.',
    'valid_url'     => 'O campo {field} deve conter uma URL válida.',
    'valid_date'    => 'O campo {field} deve conter uma data válida.',
];