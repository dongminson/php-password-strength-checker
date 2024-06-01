<?php

namespace Son\PasswordStrengthChecker\Abstract;

abstract class PasswordCheckAbstract
{
    abstract public function checkLength(string $password): int;

    abstract public function checkLowercase(string $password): int;

    abstract public function checkUppercase(string $password): int;

    abstract public function checkNumbers(string $password): int;

    abstract public function checkSymbols(string $password): int;
}
