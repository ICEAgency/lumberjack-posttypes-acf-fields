<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFields\UserField;

class UserFieldTest extends TestCase
{
    public function testRoles()
    {
        $field_name = 'example_field';
        $field = UserField::create($field_name);

        $field->withRoles([
            'administrator',
            'editor'
        ]);

        $this->assertEquals($field->roles, [
            'administrator',
            'editor'
        ]);
    }

    public function testAllowNull()
    {
        $field_name = 'example_field';
        $field = UserField::create($field_name);

        $field->allowNull();

        $this->assertEquals($field->allow_null, 1);
    }

    public function testIsMultiple()
    {
        $field_name = 'example_field';
        $field = UserField::create($field_name);

        $field->isMultiple();

        $this->assertEquals($field->multiple, 1);
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = UserField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $field->withRoles([
            'administrator',
            'editor'
        ])
        ->allowNull()
        ->isMultiple();

        $this->assertArraySubset([
            'role' => [
                'administrator',
                'editor'
            ]
        ], $field->toArray());
        $this->assertArraySubset([
            'allow_null' => 1
        ], $field->toArray());
        $this->assertArraySubset([
            'multiple' => 1
        ], $field->toArray());
    }

    public function testRequiredData()
    {
        $field_name = 'example_field';
        $field = UserField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
