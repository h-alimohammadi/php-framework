<?php

namespace System\Validation;

use System\Validation\Contract\ValidationInterface;
use System\Validation\Rules\HasValidationRules;

class ValidationNormal implements ValidationInterface
{
    use HasValidationRules;

    public function validate($name, $ruleArray)
    {
        foreach ($ruleArray as $rule) {
            if ($rule == 'required') {
                $this->required($name);
            }
            if (strpos($rule, "confirmed") === 0) {
                $rule = str_replace('confirmed', "", $rule);
                $this->confirm($name);
            }
            if (strpos($rule, "max:") === 0) {
                $rule = str_replace('max:', "", $rule);
                $this->maxStr($name, $rule);
            }
            if (strpos($rule, "min:") === 0) {
                $rule = str_replace('min:', "", $rule);
                $this->minStr($name, $rule);
            }
            if (strpos($rule, "exists:") === 0) {
                $rule = str_replace('exists:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->existsIn($name, $rule[0], $key);
            }
            if ($rule == 'email') {
                $this->email($name);
            }
            if (strpos($rule, "unique:") === 0) {
                $rule = str_replace('unique:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->unique($name, $rule[0], $key);
            }
            if ($rule == 'date') {
                $this->date($name);
            }
        }
    }
}
