<?php

namespace Common\ValueObject\Person;

class CPF
{
    protected $cpf;

    public function __construct($cpf)
    {
        if (!$this->isValid($cpf)) {
            throw new \InvalidArgumentException('Invalid CPF');
        }
    }

    protected function isValid($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
        $digits = strlen(count_chars($cpf, 3));

        // Valida tamanho
        if (strlen($cpf) !== 11 || $digits === 1)
            return false;

        // Calcula e confere primeiro dígito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Calcula e confere segundo dígito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;

        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
    }
}