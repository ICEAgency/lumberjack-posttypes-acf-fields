<?php

namespace IceAgency\PostTypeFields\AcfFields;

use IceAgency\PostTypeFields\AcfFields\Field;

class BoolField extends Field
{
    public $type = 'true_false';

    public $message;

    public function withMessage($message) {
        $this->message = $message;
        return $this;
    }

    public function toArray() : array {
        $data = parent::toArray();

        if ($this->message) {
            $data['message'] = $this->message;
        }

        return $data;
    }
}