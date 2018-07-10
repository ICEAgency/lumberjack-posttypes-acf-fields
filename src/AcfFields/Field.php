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
        $field->type = static::$type;
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

    public function addKey($group_name) {
        $this->key = $group_name . "_field_" . $this->name;
        return $this;
    }

    public function toArray() : array {
        return [
            'key' => $this->key,
            'name' => $this->name,
            'label' => $this->label,
            'type' => $this->type,
            'required' => $this->required,
        ];
    }
}