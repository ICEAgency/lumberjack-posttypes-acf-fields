<?php

namespace IceAgency\Lumberjack\AcfFieldGroups;

use ReflectionClass;
use Exception;

use IceAgency\Lumberjack\AcfFields\Field;

class FieldGroup
{
    public $key;
    public $title;
    public $location;
    public $fields = [];

    public static function create($postTypeName = '')
    {
        if ($postTypeName == '') {
            throw new Exception('Post Type namme was not set when creating ACF Field Group');
        }

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

    public function checkFieldIsValidType($field)
    {
        $class = new ReflectionClass($field);
        return $class->isSubclassOf(Field::class);
    }

    public function addField($field)
    {
        if (!$this->checkFieldIsValidType($field)) {
            throw new Exception('The field passed into the ACF Field Group was not a valid Field type');
        }

        $this->fields[] = $field->addKey($this->key)->toArray();
        return $this;
    }

    public function toArray() : array
    {
        return [
            'key' => $this->key,
            'title' => $this->title,
            'location' => $this->location,
            'fields' => $this->fields
        ];
    }
}
