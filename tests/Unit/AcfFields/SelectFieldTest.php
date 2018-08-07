<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use Exception;

use IceAgency\Lumberjack\AcfFields\SelectField;

class SelectFieldTest extends TestCase
{
    public function testOptions()
    {
        $field_name = 'example_field';
        $field = SelectField::create($field_name);

        $field->withOptions([
            '1' => 'Option 1',
            '2' => 'Option 2'
        ]);

        $this->assertEquals($field->options, [
            '1' => 'Option 1',
            '2' => 'Option 2'
        ]);
    }

    public function testEmptyOptions()
    {
        $field_name = 'example_field';
        $field = SelectField::create($field_name);

        $this->expectException(Exception::class);
        $field->withOptions();

        $this->assertNull($field->options);
    }

    public function testAllowNull()
    {
        $field_name = 'example_field';
        $field = SelectField::create($field_name);

        $field->allowNull();

        $this->assertEquals($field->allow_null, 1);
    }

    public function testIsMultiple()
    {
        $field_name = 'example_field';
        $field = SelectField::create($field_name);

        $field->isMultiple();

        $this->assertEquals($field->multiple, 1);
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = SelectField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $field->withOptions([
            '1' => 'Option 1',
            '2' => 'Option 2'
        ])->allowNull()
        ->isMultiple();

        $this->assertArraySubset([
            'choices' => [
                '1' => 'Option 1',
                '2' => 'Option 2'
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
        $field = SelectField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
