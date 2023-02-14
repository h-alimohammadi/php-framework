<?php

namespace System\Validation\Rules;


use System\Database\DBConnection\DBConnection;

trait HasValidationRules
{
    protected function maxStr($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if (strlen($this->request[$name]) >= $count && $this->checkFirstError($name)) {
                $this->setError($name, "$name max length equal or lower than $count character");
            }
        }
    }

    protected function minStr($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if (strlen($this->request[$name]) <= $count && $this->checkFirstError($name)) {
                $this->setError($name, "$name min length equal or upper than $count character");
            }
        }
    }

    protected function maxNumber($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if ($this->request[$name] >= $count && $this->checkFirstError($name)) {
                $this->setError($name, "$name max number equal or lower than $count character");
            }
        }
    }

    protected function minNumber($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if ($this->request[$name] <= $count && $this->checkFirstError($name)) {
                $this->setError($name, "$name min number equal or upper than $count character");
            }
        }
    }

    protected function required($name)
    {
        if ((!isset($this->request[$name]) || $this->request[$name] === '') && $this->checkFirstError($name)) {
            $this->setError($name, "$name is required");
        }
    }

    protected function number($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!is_numeric($this->request[$name]) && $this->checkFirstError($name)) {
                $this->setError($name, "$name must be number format");
            }
        }
    }

    protected function date($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $this->request[$name]) && $this->checkFirstError($name)) {
                $this->setError($name, "$name must be date format");
            }
        }
    }

    protected function email($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!filter_var($this->request[$name], FILTER_VALIDATE_EMAIL) && $this->checkFirstError($name)) {
                $this->setError($name, "$name must be email format");
            }
        }
    }

    public function existsIn($name, $table, $field = "id")
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                $value = $this->$name;
                $sql = "SELECT COUNT(*) FROM $table WHERE $field = ?";

                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$value]);
                $result = $statement->fetchColumn();
                // dd($result);

                if ($result == "0" || $result === false) {
                    $this->setError($name, "$name not already exist");
                }
            }
        }
    }
    public function unique($name, $table, $field = 'id')
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                $sql = "SELECT COUNT(*) FROM `$table` WHERE `$field` = ?";
                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$this->$name]);
                $res = $statement->fetchColumn();
                if ($res != 0) {
                    $this->setError($name, "$name must be unique");
                }
            }
        }
    }
    public function confirm($name)
    {
        if ($this->checkFieldExist($name)) {
            $fieldName = "confirm_" . $name;
            if (!isset($this->$fieldName)) {
                $this->setError($name, " $name $fieldName not exist");
            } elseif ($this->$fieldName != $this->$name) {
                $this->setError($name, "$name confirmation does not match");
            }
        }
    }
}
