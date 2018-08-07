<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use Exception;

use IceAgency\Lumberjack\AcfFields\FileField;

class FileFieldTest extends TestCase
{
    public function testMinSize()
    {
        $field_name = 'example_field';
        $field = FileField::create($field_name);

        $field->withMinSize(100);

        $this->assertEquals($field->min_size, 100);
    }

    public function testMaxSize()
    {
        $field_name = 'example_field';
        $field = FileField::create($field_name);

        $field->withMaxSize(1000);

        $this->assertEquals($field->max_size, 1000);
    }

    public function testMimeTypes()
    {
        $field_name = 'example_field';
        $field = FileField::create($field_name);

        $field->withMimeTypes('image/jpg,image/png');

        $this->assertEquals($field->mime_types, 'image/jpg,image/png');
    }

    public function testReturnFormat()
    {
        $field_name = 'example_field';
        $field = FileField::create($field_name);

        $field->withReturnFormat('array');

        $this->assertEquals($field->return_format, 'array');

        $field->withReturnFormat('url');

        $this->assertEquals($field->return_format, 'url');

        $field->withReturnFormat('id');

        $this->assertEquals($field->return_format, 'id');
    }

    public function testInvalidReturnFormat()
    {
        $field_name = 'example_field';
        $field = FileField::create($field_name);

        $this->expectException(Exception::class);
        $field->withReturnFormat('other');
        $this->assertNull($field->return_format);
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = FileField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $field->withMinSize(100)
            ->withMaxSize(1000)
            ->withMimeTypes('image/jpg,image/png')
            ->withReturnFormat('id');

        $this->assertArraySubset([
            'min_size' => 100
        ], $field->toArray());
        $this->assertArraySubset([
            'max_size' => 1000
        ], $field->toArray());
        $this->assertArraySubset([
            'mime_types' => 'image/jpg,image/png'
        ], $field->toArray());
        $this->assertArraySubset([
            'return_format' => 'id'
        ], $field->toArray());
    }

    public function testRequiredData()
    {
        $field_name = 'example_field';
        $field = FileField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
