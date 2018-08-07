<?php

namespace IceAgency\Lumberjack\AcfFields;

use IceAgency\Lumberjack\AcfFields\Field;

class CheckboxField extends Field
{
    public $type = 'checkbox';

    public $options = [];

    public function withOptions($options)
    {
        if (!is_array($options)) {
            throw new Exception('You must provide an array of options with a CheckboxField');
        }

        $this->options = $options;
        return $this;
    }

    public function toArray() : array
    {
        $data = parent::toArray();

        $data['choices'] = $this->options;

        return $data;
    }
}
