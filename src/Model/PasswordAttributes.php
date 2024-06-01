<?php

namespace Son\PasswordStrengthChecker\Model;

class PasswordAttributes
{
    public const WEAK = 0;
    public const MEDIUM = 1;
    public const STRONG = 2;

    protected $attributes = [
        'score',
        'strength',
        'text',
    ];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getAttribute($key)
    {
        if (in_array($key, $this->attributes)) {
            return $this->data[$key];
        }
    }

    public function __get($key)
    {
        return $this->getAttribute($key);
    }
}
