<?php 

namespace System\Validation;

use System\Validation\Contract\ValidationInterface;
use System\Validation\Rules\HasFileValidationRules;

class ValidationFile implements ValidationInterface{
    use HasFileValidationRules;
    public function validate($name, $ruleArray)
    {
        foreach ($ruleArray as $rule) {
            if ($rule == "required") {
                $this->fileRequired($name);
            }
            if (strpos($rule, "mimes:") === 0) {
                $rule = str_replace('mimes:', "", $rule);
                $rule = explode(',', $rule);
                $this->fileType($name, $rule);
            }
            if (strpos($rule, "max:") === 0) {
                $rule = str_replace('max:', "", $rule);
                $this->maxFile($name, $rule);
            }
            if (strpos($rule, "min:") === 0) {
                $rule = str_replace('min:', "", $rule);
                $this->minFile($name, $rule);
            }
        }
    }
}