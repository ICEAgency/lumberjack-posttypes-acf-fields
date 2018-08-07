<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFields\TextField;

class TextFieldTest extends TestCase
{
    public function testPlaceholder()
    {
        $field_name = 'example_field';
        $field = TextField::create($field_name);

        $field->withPlaceholder('Some placeholder text');

        $this->assertEquals($field->placeholder, 'Some placeholder text');
    }

    public function testMaxLength()
    {
        $field_name = 'example_field';
        $field = TextField::create($field_name);

        $field->withMaxLength(100);
        $this->assertEquals($field->max_length, 100);

        $field->withMaxLength('100');
        $this->assertEquals($field->max_length, 100);
    }

    public function testReadOnly()
    {
        $field_name = 'example_field';
        $field = TextField::create($field_name);

        $field->isReadOnly();
        $this->assertEquals($field->readonly, 1);
    }

    public function testDisabled()
    {
        $field_name = 'example_field';
        $field = TextField::create($field_name);

        $field->isDisabled();
        $this->assertEquals($field->disabled, 1);
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = TextField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $field->isRequired()
            ->withPlaceholder('Example Placeholder')
            ->withInstructions('Some instructions')
            ->withDefaultValue('Default')
            ->withMaxLength(100)
            ->isReadOnly()
            ->isDisabled();

        $this->assertArraySubset([
            'required' => 1
        ], $field->toArray());
        $this->assertArraySubset([
            'placeholder' => 'Example Placeholder'
        ], $field->toArray());
        $this->assertArraySubset([
            'instructions' => 'Some instructions'
        ], $field->toArray());
        $this->assertArraySubset([
            'default_value' => 'Default'
        ], $field->toArray());
        $this->assertArraySubset([
            'max_length' => 100
        ], $field->toArray());
        $this->assertArraySubset([
            'readonly' => 1
        ], $field->toArray());
        $this->assertArraySubset([
            'disabled' => 1
        ], $field->toArray());
    }

    public function testRequiredData()
    {
        $field_name = 'example_field';
        $field = TextField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
