<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFieldGroups;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFieldGroups\FieldGroup;
use IceAgency\Lumberjack\AcfFields\TextField;

use Exception;

class FieldGroupTest extends TestCase
{
    public function testCreateFieldGroup()
    {
        $post_type_name = 'post';
        $field_group = FieldGroup::create($post_type_name);

        $this->assertInstanceOf('IceAgency\Lumberjack\AcfFieldGroups\FieldGroup', $field_group);
        $this->assertEquals($field_group->key, 'group_post');
        $this->assertEquals($field_group->title, 'Post Fields');
        $this->assertEquals($field_group->location, [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ],
            ],
        ]);
    }

    public function testCreateFieldGroupWithoutName()
    {
        $post_type_name = '';
        $this->expectException(Exception::class);
        $field_group = FieldGroup::create($post_type_name);

        $this->assertNull($field_group);
    }

    public function testAddField()
    {
        $post_type_name = 'post';
        $field_group = FieldGroup::create($post_type_name);

        $field = TextField::create('example_field')
            ->withLabel('Example Field');

        $field_group->addField($field);

        $this->assertEquals(count($field_group->fields), 1);
        $this->assertArrayHasKey('key', $field_group->fields[0]);
        $this->assertArrayHasKey('name', $field_group->fields[0]);
        $this->assertArrayHasKey('label', $field_group->fields[0]);
        $this->assertArrayHasKey('type', $field_group->fields[0]);
    }

    public function testToArray()
    {
        $post_type_name = 'post';
        $field_group = FieldGroup::create($post_type_name);

        $this->assertArrayHasKey('key', $field_group->toArray());
        $this->assertArrayHasKey('title', $field_group->toArray());
        $this->assertArrayHasKey('location', $field_group->toArray());
        $this->assertArrayHasKey('fields', $field_group->toArray());
    }

    public function testInvalidFieldTypesAreNotAccepted()
    {
        $post_type_name = 'post';
        $field_group = FieldGroup::create($post_type_name);

        $another_field = new \stdClass;
        $this->expectException(Exception::class);
        $field_group->addField($another_field);
        $this->assertEquals(count($field_group->fields), 0);
    }
}
