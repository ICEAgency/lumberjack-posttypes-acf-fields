<?php

namespace IceAgency\Lumberjack\Test\Unit\Mocks;

use Rareloop\Lumberjack\Post;

class CustomPostWithoutACFFieldsMock extends Post
{
    public static function getPostType()
    {
        return 'custom_post_1';
    }

    protected static function getPostTypeConfig()
    {
        return [
            'not' => 'empty',
        ];
    }
}
