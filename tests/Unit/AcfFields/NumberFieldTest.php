<?php

namespace IceAgency\Lumberjack\Test\Unit\AcfFields;

use PHPUnit\Framework\TestCase;

use IceAgency\Lumberjack\AcfFields\NumberField;

class NumberFieldTest extends TestCase
{
    public function testMin()
    {
        $field_name = 'example_field';
        $field = NumberField::create($field_name);

        $field->withMin(10);

        $this->assertEquals($field->min, 10);
    }

    public function testMax()
    {
        $field_name = 'example_field';
        $field = NumberField::create($field_name);

        $field->withMax(100);

        $this->assertEquals($field->max, 100);
    }

    public function testStep()
    {
        $field_name = 'example_field';
        $field = NumberField::create($field_name);

        $field->withStep(2);

        $this->assertEquals($field->step, 2);
    }

    public function testPlaceholder()
    {
        $field_name = 'example_field';
        $field = NumberField::create($field_name);

        $field->withPlaceholder('Some placeholder text');

        $this->assertEquals($field->placeholder, 'Some placeholder text');
    }

    public function testOptionalData()
    {
        $field_name = 'example_field';
        $field = NumberField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $field->withMin(10)
            ->withMax(100)
            ->withStep(2)
            ->withPlaceholder('Some placeholder text');

        $this->assertArraySubset([
            'min' => 10
        ], $field->toArray());
        $this->assertArraySubset([
            'max' => 100
        ], $field->toArray());
        $this->assertArraySubset([
            'step' => 2
        ], $field->toArray());
        $this->assertArraySubset([
            'placeholder' => 'Some placeholder text'
        ], $field->toArray());
    }

    public function testRequiredData()
    {
        $field_name = 'example_field';
        $field = NumberField::create($field_name)
            ->withLabel('Example Field');

        $field->addKey('group_name');

        $this->assertArrayHasKey('key', $field->toArray());
        $this->assertArrayHasKey('name', $field->toArray());
        $this->assertArrayHasKey('label', $field->toArray());
        $this->assertArrayHasKey('type', $field->toArray());
    }
}
