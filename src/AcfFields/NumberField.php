<?php

namespace IceAgency\PostTypeFields\AcfFields;

use IceAgency\PostTypeFields\AcfFields\Field;

class NumberField extends Field
{
    public $type = 'number';
    public $min;
    public $max;
    public $step;

    public function withMin($min) {
        $this->min = (int)$min;
        return $this;
    }

    public function withMax($max) {
        $this->max = (int)$max;
        return $this;
    }

    public function withStep($step) {
        $this->step = (int)$step;
        return $this;
    }

    public function toArray() : array {
        $data = parent::toArray();

        if ($this->min) {
            $data['min'] = $this->min;
        }

        if ($this->max) {
            $data['max'] = $this->max;
        }

        if ($this->step) {
            $data['step'] = $this->step;
        }

        return $data;
    }
}