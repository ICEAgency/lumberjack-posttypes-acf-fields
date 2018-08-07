<?php

namespace IceAgency\Lumberjack\AcfFields;

use IceAgency\Lumberjack\AcfFields\Field;

class SelectField extends Field
{
    public $type = 'select';

    public $options = [];
    public $allow_null = 0;
    public $multiple = 0;

    public function withOptions($options)
    {
        if(!is_array($options)) {
            throw new Exception('You must provide an array of options with a SelectField');
        }

        $this->options = $options;
        return $this;
    }

    public function allowNull()
    {
        $this->allow_null = 1;
        return $this;
    }

    public function isMultiple()
    {
        $this->multiple = 1;
        return $this;
    }

    public function toArray() : array
    {
        $data = parent::toArray();

        $data['choices'] = $this->options;
        $data['allow_null'] = $this->allow_null;
        $data['multiple'] = $this->multiple;

        return $data;
    }
}