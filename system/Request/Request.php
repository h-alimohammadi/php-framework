<?php

namespace System\Request;


use System\Request\Traits\HasFileValidationRules;
use System\Request\Traits\HasRunValidation;
use System\Request\Traits\HasValidationRules;
use System\Validation\Validator;

class Request
{
    use HasValidationRules,HasFileValidationRules,HasRunValidation;

    protected $errorExist = false;
    protected $request;
    protected $files = null;
    protected $errorVariablesName = [];

    public function __construct()
    {
        if(isset($_POST)) {
            $this->postAttributes();
        }
        if(!empty($_FILES))
            $this->files = $_FILES;
        $rules = $this->rules();
        empty($rules) ? : $this->run($rules);
        $this->errorRedirect();
    }


    protected function rules()
    {
        return [];
    }

    protected function run($rules){
        Validator::validate($rules);    
    }

    public function file($name){
        return isset($this->files[$name]) ? $this->files[$name] : false;
    }

    protected function postAttributes()
    {
        foreach($_POST as $key => $value){
            $this->$key = htmlentities($value);
            $this->request[$key] = htmlentities($value);
        }
    }

    public function all(){
       return $this->request;
    }
    
    public function hasErrorExist(){
       return $this->errorExist;
    }



}