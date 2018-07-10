<?php

namespace IceAgency\PostTypeFields\AcfFields;

class Field
{
    public $name;
    public $label;
    public $required = 0;

    public static function create($name) {
        $field = new Field();
        $field->name = $name;
        return $field;
    }

    public function withLabel($label) {
        $this->label = $label;
        return $this;
    }

    public function isRequired() {
        $this->required = 1;
        return $this;
    }
}