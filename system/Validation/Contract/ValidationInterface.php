<?php

namespace System\Validation\Contract;

interface ValidationInterface{
    public function validate(string $name, array $ruleArray);
}