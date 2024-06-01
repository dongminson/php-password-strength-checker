<?php

use Son\PasswordStrengthChecker\Evaluator;
use Son\PasswordStrengthChecker\Implementation\PasswordCheckImplementation;

it('test checkLength', function () {
    $checker = new PasswordCheckImplementation();
    $password = 'Password';

    $result = $checker->checkLength($password);

    $this->assertEquals($result, 2);
});

it('test checkLowercase', function () {
    $checker = new PasswordCheckImplementation();
    $password = 'Password';

    $result = $checker->checkLowercase($password);

    $this->assertEquals($result, 1);
});

it('test checkUppercase', function () {
    $checker = new PasswordCheckImplementation();
    $password = 'Password';

    $result = $checker->checkUppercase($password);

    $this->assertEquals($result, 1);
});

it('test checkNumbers', function () {
    $checker = new PasswordCheckImplementation();
    $password = '12345678';

    $result = $checker->checkNumbers($password);

    $this->assertEquals($result, 1);
});

it('test checkSymbols', function () {
    $checker = new PasswordCheckImplementation();
    $password = '1234567$';

    $result = $checker->checkSymbols($password);

    $this->assertEquals($result, 1);
});

it('test weak password', function () {
    $password = '1';
    $checker = new Evaluator($password);

    $checker->evaluate();
    $result = $checker->getCurrentPasswordScore();

    $this->assertEquals($result, 1);
});

it('test medium password', function () {
    $password = '1234567$';
    $checker = new Evaluator($password);

    $checker->evaluate();
    $result = $checker->getCurrentPasswordScore();

    $this->assertEquals($result, 4);
});

it('test strong password', function () {
    $password = 'Password1234567$';
    $checker = new Evaluator($password);

    $checker->evaluate();
    $result = $checker->getCurrentPasswordScore();

    $this->assertEquals($result, 6);
});
