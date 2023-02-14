<?php 

namespace System\Validation;

use System\Validation\Rules\HasFileValidationRules;
use System\Validation\Rules\HasRunValidation;
use System\Validation\Rules\HasValidationRules;

class Validator{
    use HasValidationRules,HasFileValidationRules,HasRunValidation;

    

    public function __construct(){

    }
    public static function validate($rules){
        foreach($rules as $att => $values){
            $ruleArray = explode('|', $values);
            if(in_array('file', $ruleArray))
            {
                unset($ruleArray[array_search('file', $ruleArray)]);
                (new ValidationFile)->validate($att, $ruleArray);
                
            }
            elseif(in_array('number', $ruleArray))
            {
                (new ValidationNumber)->validate($att, $ruleArray);

            }
            else
            {
                (new ValidationNormal)->validate($att, $ruleArray);

            }
        }
    }
}