<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFields\PageLinkField;

class PageLinkFieldTest extends TestCase
{
    public function testPostTypes()
    {
        $field_name = 'example_field';
        $field = PageLinkField::create($field_name);

        $field->withPostTypes('post');

        $this->assertEquals($field->post_types, 'post');
    }

    public function testTaxonomy()
    {
        $field_name = 'example_field';
        $field = PageLinkField::create($field_name);

        $field->withTaxonomy('categories');

        $this->assertEquals($field->taxonomy, 'categories');
    }

    public function testAllowNull()
    {
        $field_name = 'example_field';
        $field = PageLinkField::create($field_name);

        $field->allowNull();

        $this->assertEquals($field->allow_null, 1);
    }

    public function testIsMultiple()
    {
        $field_name = 'example_field';
        $field = PageLinkField::create($field_name);

        $field->isMultiple();

        $this->assertEquals($field->multiple, 1);
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = PageLinkField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $field->withPostTypes('post')
            ->withTaxonomy('categories')
            ->allowNull()
            ->isMultiple();

        $this->assertArraySubset([
            'post_types' => 'post'
        ], $field->toArray());
        $this->assertArraySubset([
            'taxonomy' => 'categories'
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
        $field = PageLinkField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
