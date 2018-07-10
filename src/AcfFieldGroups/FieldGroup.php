<?php

namespace IceAgency\PostTypeFields\AcfFieldGroups;

class FieldGroup
{
    public $key;
    public $title;
    public $location;
    public $fields = [];

    public static function create($postTypeName) {
        $field_group = new FieldGroup();
        $field_group->key = 'group_' . $postTypeName;
        $field_group->title = ucwords($postTypeName) . ' Fields';
        $field_group->location = [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => $postTypeName,
                ],
            ],
        ];
        return $field_group;
    }

    public function addField($field) {
        $this->fields[] = $field->toArray();
        return $this;
    }
}