<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use Exception;

use IceAgency\Lumberjack\AcfFields\CheckboxField;

class CheckboxFieldTest extends TestCase
{
    public function testOptions()
    {
        $field_name = 'example_field';
        $field = CheckboxField::create($field_name);

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
        $field = CheckboxField::create($field_name);

        $this->expectException(Exception::class);
        $field->withOptions();

        $this->assertNull($field->options);
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = CheckboxField::create($field_name)
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
        $field = CheckboxField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
