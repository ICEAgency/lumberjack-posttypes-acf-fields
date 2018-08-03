<?php 

namespace IceAgency\Lumberjack\Test\Unit\Mocks;

use Rareloop\Lumberjack\Post;
use IceAgency\Lumberjack\Interfaces\HasAcfFields;
use IceAgency\Lumberjack\AcfFields\TextField;

class CustomPostWithMultipleACFFieldsMock extends Post implements HasAcfFields
{
    public static function getPostType()
    {
        return 'custom_post_3';
    }

    protected static function getPostTypeConfig()
    {
        return [
            'not' => 'empty',
        ];
    }
    
    public static function getFieldConfig() : array
    {
        return [
            TextField::create('project_customer_name')
                ->withLabel('Customer Name'),

            TextField::create('project_quote')
                ->withLabel('Quote'),
        ];
    }
}