<?php

namespace Son\PasswordStrengthChecker;

use Son\PasswordStrengthChecker\Implementation\PasswordCheckImplementation;
use Son\PasswordStrengthChecker\Model\PasswordAttributes;

class Evaluator
{
    protected $password;
    protected $passwordData;

    protected static $response_text = [
        0 => 'Weak',
        1 => 'Medium',
        2 => 'Strong',
    ];

    public function __construct(string $password)
    {
        $this->password = $password;
        $passwordData = [
            'score' => 0,
            'strength' => PasswordAttributes::WEAK,
            'text' => self::$response_text[0],
        ];
        $this->passwordData = new PasswordAttributes($passwordData);

    }

    public function evaluate()
    {
        $check = new PasswordCheckImplementation();
        $score = $check->checkAll($this->password);

        if ($score) {
            $passwordData = [
              'score' => $score,
              'strength' => $this->getPasswordStrength($score),
              'text' => $this->getScoreText($score),
            ];
            $this->passwordData = new PasswordAttributes($passwordData);

            return $this->passwordData;
        }

        return true;
    }

    public function getCurrentPasswordScore()
    {
        return $this->passwordData->getAttribute('score');
    }

    public function getCurrentPasswordStrength()
    {
        return $this->passwordData->getAttribute('strength');
    }

    public function getCurrentScoreText()
    {
        return $this->passwordData->getAttribute('text');
    }

    private function getPasswordStrength($score)
    {
        if ($score <= 2) {
            return PasswordAttributes::WEAK;
        } elseif ($score > 2 && $score <= 5) {
            return PasswordAttributes::MEDIUM;
        } else {
            return PasswordAttributes::STRONG;
        }
    }

    private function getScoreText($score)
    {
        if ($score <= 2) {
            return self::$response_text[0];
        } elseif ($score > 2 && $score <= 5) {
            return self::$response_text[1];
        } else {
            return self::$response_text[2];
        }
    }
}
