<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFields\PasswordField;

class PasswordFieldTest extends TestCase
{
    public function testPlaceholder()
    {
        $field_name = 'example_field';
        $field = PasswordField::create($field_name);

        $field->withPlaceholder('Some placeholder text');

        $this->assertEquals($field->placeholder, 'Some placeholder text');
    }

    public function testRequiredData()
    {
        $field_name = 'example_field';
        $field = PasswordField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}