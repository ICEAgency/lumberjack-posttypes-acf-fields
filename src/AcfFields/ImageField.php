<?php

namespace IceAgency\Lumberjack\AcfFields;

use IceAgency\Lumberjack\AcfFields\Field;

class ImageField extends Field
{
    public $type = 'image';
    public $return_format = 'array';
    public $min_width = 0;
    public $min_height = 0;
    public $max_width = 0;
    public $max_height = 0;
    public $min_size = 0;
    public $max_size = 0;
    public $mime_types;

    public function withMinWidth($min_width) {
        $this->min_width = (int)$min_width;
        return $this;
    }

    public function withMinHeight($min_height) {
        $this->min_height = (int)$min_height;
        return $this;
    }

    public function withMaxWidth($max_width) {
        $this->max_width = (int)$max_width;
        return $this;
    }

    public function withMaxHeight($max_height) {
        $this->max_height = (int)$max_height;
        return $this;
    }

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
        $data['min_width'] = $this->min_width;
        $data['min_height'] = $this->min_height;
        $data['max_width'] = $this->max_width;
        $data['max_height'] = $this->max_height;
        $data['min_size'] = $this->min_size;
        $data['max_size'] = $this->max_size;

        if ($this->mime_types) {
            $data['mime_types'] = $this->mime_types;
        }

        return $data;
    }
}