<?php

namespace IceAgency\Lumberjack\AcfFieldGroups;

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
        $this->fields[] = $field->addKey($this->key)->toArray();
        return $this;
    }

    public function toArray() : array {
        return [
            'key' => $this->key,
            'title' => $this->title,
            'location' => $this->location,
            'fields' => $this->fields
        ];
    }
}