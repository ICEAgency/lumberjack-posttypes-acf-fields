<?php

namespace IceAgency\Lumberjack\AcfFields;

use IceAgency\Lumberjack\AcfFields\Field;

class FileField extends Field
{
    public $type = 'file';
    public $return_format = 'array';
    public $min_size = 0;
    public $max_size = 0;
    public $mime_types;

    public function withMinSize($min_size) {
        $this->min_size = $min_size;
        return $this;
    }

    public function withMaxSize($max_size) {
        $this->max_size = $max_size;
        return $this;
    }

    public function withMimeTypes($mime_types) {
        $this->mime_types = $mime_types;
        return $this;
    }

    public function withReturnFormat($return_format) {
        if (!in_array($return_format, [
            'array',
            'url',
            'id'
        ])) {
            throw new Exception('The withReturnFormat() method only allows the following options: array, url or id.');
        }

        $this->return_format = $return_format;
        return $this;
    }

    public function toArray() : array {
        $data = parent::toArray();

        $data['return_format'] = $this->return_format;
        $data['min_size'] = $this->min_size;
        $data['max_size'] = $this->max_size;

        if ($this->mime_types) {
            $data['mime_types'] = $this->mime_types;
        }

        return $data;
    }
}