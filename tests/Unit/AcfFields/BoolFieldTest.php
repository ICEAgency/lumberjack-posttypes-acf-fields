<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFields\BoolField;

class BoolFieldTest extends TestCase
{
    public function testMessage()
    {
        $field_name = 'example_field';
        $field = BoolField::create($field_name);

        $field->withMessage('Example Message');

        $this->assertEquals($field->message, 'Example Message');
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = BoolField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $field->withMessage('Example Message');

        $this->assertArraySubset([
            'message' => 'Example Message'
        ], $field->toArray());
    }

    public function testRequiredData()
    {
        $field_name = 'example_field';
        $field = BoolField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}