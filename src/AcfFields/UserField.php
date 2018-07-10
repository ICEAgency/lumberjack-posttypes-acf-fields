<?php

namespace IceAgency\PostTypeFields\AcfFields;

use IceAgency\PostTypeFields\AcfFields\Field;

class UserField extends Field
{
    public $type = 'user';
    public $roles;
    public $allow_null = 0;
    public $multiple = 0;

    public function withRoles($roles) {
        $this->roles = $roles;
        return $this;
    }

    public function allowNull() {
        $this->allow_null = 1;
        return $this;
    }

    public function isMultiple() {
        $this->multiple = 1;
        return $this;
    }

    public function toArray() : array {
        $data = parent::toArray();

        if ($this->roles) {
            $data['role'] = $this->roles;
        }
        $data['allow_null'] = $this->allow_null;
        $data['multiple'] = $this->multiple;

        return $data;
    }
}