<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFields\RadioField;

class RadioFieldTest extends TestCase
{
    public function testOptions()
    {
        $field_name = 'example_field';
        $field = RadioField::create($field_name);

        $field->withOptions([
            '1' => 'Option 1',
            '2' => 'Option 2'
        ]);

        $this->assertEquals($field->options, [
            '1' => 'Option 1',
            '2' => 'Option 2'
        ]);
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = RadioField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $field->withOptions([
            '1' => 'Option 1',
            '2' => 'Option 2'
        ]);

        $this->assertArraySubset([
            'choices' => [
                '1' => 'Option 1',
                '2' => 'Option 2'
            ]
        ], $field->toArray());
    }

    public function testRequiredData()
    {
        $field_name = 'example_field';
        $field = RadioField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
