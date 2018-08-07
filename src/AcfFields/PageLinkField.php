<?php

namespace IceAgency\Lumberjack\AcfFields;

use IceAgency\Lumberjack\AcfFields\Field;

class PageLinkField extends Field
{
    public $type = 'page_link';
    public $post_types = [];
    public $taxonomy = [];
    public $allow_null = 0;
    public $multiple = 0;

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

    public function toArray() : array
    {
        $data = parent::toArray();

        $data['post_types'] = $this->post_types;
        $data['taxonomy'] = $this->taxonomy;
        $data['allow_null'] = $this->allow_null;
        $data['multiple'] = $this->multiple;

        return $data;
    }
}
