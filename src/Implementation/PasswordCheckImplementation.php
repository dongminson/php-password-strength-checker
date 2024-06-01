<?php

namespace Son\PasswordStrengthChecker\Implementation;

use Son\PasswordStrengthChecker\Abstract\PasswordCheckAbstract;

class PasswordCheckImplementation extends PasswordCheckAbstract
{
    protected $scores = [
        'LENGTH' => 2,
        'LOWERCASE' => 1,
        'UPPERCASE' => 1,
        'NUMBERS' => 1,
        'SYMBOLS' => 1,
    ];

    public function checkAll(string $password): int
    {
        $totalScore = 0;

        foreach ($this->scores as $method => $score) {
            $methodName = 'check' . ucfirst(strtolower($method));
            $totalScore += $this->$methodName($password);
        }

        return $totalScore;
    }

    public function checkLength(string $password): int
    {
        $length = strlen($password);

        return $length >= 8 ? $this->scores['LENGTH'] : 0;
    }

    public function checkLowercase(string $password): int
    {
        return preg_match('/[a-z]/', $password) ? $this->scores['LOWERCASE'] : 0;
    }

    public function checkUppercase(string $password): int
    {
        return preg_match('/[A-Z]/', $password) ? $this->scores['UPPERCASE'] : 0;
    }

    public function checkNumbers(string $password): int
    {
        return preg_match('/[0-9]/', $password) ? $this->scores['NUMBERS'] : 0;
    }

    public function checkSymbols(string $password): int
    {
        return preg_match('/[^a-zA-Z0-9]/', $password) ? $this->scores['SYMBOLS'] : 0;
    }
}
