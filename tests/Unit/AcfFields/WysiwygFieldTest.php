<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use Exception;

use IceAgency\Lumberjack\AcfFields\WysiwygField;

class WysiwygFieldTest extends TestCase
{
    public function testTabs()
    {
        $field_name = 'example_field';
        $field = WysiwygField::create($field_name);

        $field->withTabs('all');

        $this->assertEquals($field->tabs, 'all');

        $field->withTabs('visual');

        $this->assertEquals($field->tabs, 'visual');

        $field->withTabs('text');

        $this->assertEquals($field->tabs, 'text');
    }

    public function testInvalidTabs()
    {
        $field_name = 'example_field';
        $field = WysiwygField::create($field_name);

        $this->expectException(Exception::class);
        $field->withTabs('other');
        $this->assertNull($field->tabs);
    }

    public function testToolbar()
    {
        $field_name = 'example_field';
        $field = WysiwygField::create($field_name);

        $field->withToolbar('full');

        $this->assertEquals($field->toolbar, 'full');

        $field->withToolbar('basic');

        $this->assertEquals($field->toolbar, 'basic');
    }

    public function testInvalidToolbar()
    {
        $field_name = 'example_field';
        $field = WysiwygField::create($field_name);

        $this->expectException(Exception::class);
        $field->withToolbar('other');
        $this->assertNull($field->toolbar);
    }

    public function testCanUploadMedia()
    {
        $field_name = 'example_field';
        $field = WysiwygField::create($field_name);

        $field->canUploadMedia();

        $this->assertEquals($field->media_upload, 1);
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = WysiwygField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $field->withTabs('all')
            ->withToolbar('full')
            ->canUploadMedia();

        $this->assertArraySubset([
            'tabs' => 'all'
        ], $field->toArray());
        $this->assertArraySubset([
            'toolbar' => 'full'
        ], $field->toArray());
        $this->assertArraySubset([
            'media_upload' => 1
        ], $field->toArray());
    }

    public function testRequiredData()
    {
        $field_name = 'example_field';
        $field = WysiwygField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
