<?php

namespace IceAgency\PostTypeFields\AcfFields;

use IceAgency\PostTypeFields\AcfFields\Field;

class RadioField extends Field
{
    public $type = 'radio';

    public $options = [];

    public function withOptions($options) {
        if(!is_array($options)) {
            throw new Exception('You must provide an array of options with a RadioField');
        }

        $this->options = $options;
        return $this;
    }

    public function toArray() : array {
        $data = parent::toArray();

        $data['choices'] = $this->options;

        return $data;
    }
}