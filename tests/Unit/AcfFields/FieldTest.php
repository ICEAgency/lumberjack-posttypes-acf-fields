<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use Exception;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFields\Field;

class FieldTest extends TestCase
{
    public function testCreateField()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);

        $this->assertInstanceOf('IceAgency\Lumberjack\AcfFields\Field', $field);
        $this->assertEquals($field->name, 'example_field');
    }

    public function testEmptyName()
    {
        $field_name = '';
        $this->expectException(Exception::class);
        $field = Field::create($field_name);

        $this->assertNull($field);
    }

    public function testLabel()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);

        $field->withLabel('Example Field');

        $this->assertEquals($field->label, 'Example Field');
    }

    public function testEmptyLabel()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);

        $this->expectException(Exception::class);
        $field->withLabel();
        $this->assertNull($field->label);
    }

    public function testRequired()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);

        $field->isRequired();

        $this->assertEquals($field->required, 1);
    }

    public function testInstructions()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);

        $field->withInstructions("Some instructions");

        $this->assertEquals($field->instructions, "Some instructions");
    }

    public function testDefaultValue()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);

        $field->withDefaultValue("Example");

        $this->assertEquals($field->default_value, "Example");
    }

    public function testPlaceholderErrorsForInvalidFieldType()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);
        $field->type = 'invalid';

        $this->expectException(Exception::class);
        $field->withPlaceholder('Some placeholder');

        $this->assertNull($field->placeholder);
    }

    public function testMaxLengthErrorsForInvalidFieldType()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);
        $field->type = 'invalid';

        $this->expectException(Exception::class);
        $field->withMaxLength(100);

        $this->assertNull($field->max_length);
    }

    public function testReadOnlyErrorsForInvalidFieldType()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);
        $field->type = 'invalid';

        $this->expectException(Exception::class);
        $field->isReadOnly();

        $this->assertNull($field->readonly);
    }

    public function testDisabledErrorsForInvalidFieldType()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);
        $field->type = 'invalid';

        $this->expectException(Exception::class);
        $field->isDisabled();

        $this->assertNull($field->disabled);
    }

    public function testAddKey()
    {
        $field_name = 'example_field';
        $field = Field::create($field_name);

        $field->addKey('group_name');

        $this->assertEquals($field->key, 'group_name_field_example_field');
    }
}
