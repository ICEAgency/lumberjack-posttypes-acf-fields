<?php

namespace IceAgency\Lumberjack\AcfFields;

use Exception;

use IceAgency\Lumberjack\AcfFields\Field;

class PostObjectField extends Field
{
    public $type = 'post_object';
    public $post_types = [];
    public $taxonomy = [];
    public $allow_null = 0;
    public $multiple = 0;
    public $return_format = 'object';

    public function withPostTypes($post_types)
    {
        $this->post_types = $post_types;
        return $this;
    }

    public function withTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;
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

    public function withReturnFormat($return_format)
    {
        if (!in_array($return_format, [
            'object',
            'id'
        ])) {
            throw new Exception('The withReturnFormat() method only allows the following options: object or id.');
        }

        $this->return_format = $return_format;
        return $this;
    }

    public function toArray() : array
    {
        $data = parent::toArray();

        $data['post_types'] = $this->post_types;
        $data['taxonomy'] = $this->taxonomy;
        $data['allow_null'] = $this->allow_null;
        $data['multiple'] = $this->multiple;
        $data['return_format'] = $this->return_format;

        return $data;
    }
}
