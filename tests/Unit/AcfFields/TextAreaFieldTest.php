<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFields\TextAreaField;

class TextAreaFieldTest extends TestCase
{
    public function testPlaceholder()
    {
        $field_name = 'example_field';
        $field = TextAreaField::create($field_name);

        $field->withPlaceholder('Some placeholder text');

        $this->assertEquals($field->placeholder, 'Some placeholder text');
    }

    public function testMaxLength()
    {
        $field_name = 'example_field';
        $field = TextAreaField::create($field_name);

        $field->withMaxLength(100);
        $this->assertEquals($field->max_length, 100);

        $field->withMaxLength('100');
        $this->assertEquals($field->max_length, 100);
    }

    public function testReadOnly()
    {
        $field_name = 'example_field';
        $field = TextAreaField::create($field_name);

        $field->isReadOnly();
        $this->assertEquals($field->readonly, 1);
    }

    public function testDisabled()
    {
        $field_name = 'example_field';
        $field = TextAreaField::create($field_name);

        $field->isDisabled();
        $this->assertEquals($field->disabled, 1);
    }

    public function testRequiredData()
    {
        $field_name = 'example_field';
        $field = TextAreaField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
