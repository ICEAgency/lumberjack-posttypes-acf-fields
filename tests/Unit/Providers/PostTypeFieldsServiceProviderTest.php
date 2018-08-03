<?php

namespace IceAgency\Lumberjack\Test\Unit\Providers;

use ReflectionClass;
use Mockery;
use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;
use Rareloop\Lumberjack\Application;
use Rareloop\Lumberjack\Config;
use IceAgency\Lumberjack\Providers\PostTypeFieldsServiceProvider;
use IceAgency\Lumberjack\Test\Unit\BrainMonkeyPHPUnitIntegration;
use IceAgency\Lumberjack\Test\Unit\Mocks\AcfMock;
use IceAgency\Lumberjack\Test\Unit\Mocks\CustomPostWithoutACFFieldsMock;
use IceAgency\Lumberjack\Test\Unit\Mocks\CustomPostWithACFFieldsMock;
use IceAgency\Lumberjack\Test\Unit\Mocks\CustomPostWithMultipleACFFieldsMock;

class PostTypeFieldsServiceProviderTest extends TestCase
{
    use BrainMonkeyPHPUnitIntegration;

    private $provider;
    private $config;
    private $app;

    protected function setUp()
    {
        $this->config = new Config;
        $this->app = new Application;
        $this->app->bind(Config::class, $this->config);
        $this->provider = new PostTypeFieldsServiceProvider($this->app);
    }

    public function testBootWithNoAcfAddLocalFieldGroupFunction()
    {
        $this->assertNull($this->provider->boot());
    }

    public function testPostTypeWithNoACFFieldsAddsZeroFieldGroup()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithoutACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->never();

        $this->provider->boot();
    }

    public function testPostTypeWithSingleAcfFieldAddsFieldGroup()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->once();

        $this->provider->boot();
    }

    public function testPostTypeWithSingleAcfFieldGeneratesCorrectGroupData()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->once()
            ->with(Mockery::subset([
                'key' => 'group_custom_post_2',
                'title' => 'Custom_post_2 Fields'
            ]));

        $this->provider->boot();
    }

    public function testPostTypeWithSingleAcfFieldGeneratesCorrectGroupLocationData()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->once()
            ->with(Mockery::subset([
                'location' => [
                    [
                        [
                            "param" => "post_type",
                            "operator" => "==",
                            "value" => "custom_post_2"
                        ]
                    ]
                ]
            ]));

        $this->provider->boot();
    }

    public function testPostTypeWithSingleAcfFieldGeneratesCorrectGroupFieldData()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->once()
            ->with(Mockery::subset([
                "fields" => [
                    [
                        "key" => "group_custom_post_2_field_project_customer_name",
                        "name" => "project_customer_name",
                        "label" => "Customer Name",
                        "type" => "text"
                    ]
                ]
            ]));

        $this->provider->boot();
    }

    public function testPostTypeWithMultipleAcfFieldsGeneratesCorrectGroupFieldData()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithMultipleACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->once()
            ->with(Mockery::subset([
                "fields" => [
                    [
                        "key" => "group_custom_post_3_field_project_customer_name",
                        "name" => "project_customer_name",
                        "label" => "Customer Name",
                        "type" => "text"
                    ],
                    [
                        "key" => "group_custom_post_3_field_project_quote",
                        "name" => "project_quote",
                        "label" => "Quote",
                        "type" => "text"
                    ],
                ]
            ]));

        $this->provider->boot();
    }

    public function testMultiplePostTypesWithSingleAcfFieldAddsFieldGroup()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithACFFieldsMock::class,
            CustomPostWithMultipleACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->times(2);

        $this->provider->boot();
    }

    public function testMultiplePostTypesWithSingleAcfFieldGeneratesCorrectGroupData()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithACFFieldsMock::class,
            CustomPostWithMultipleACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->times(2)
            ->with(Mockery::hasKey('key'))
            ->with(Mockery::hasKey('title'));

        $this->provider->boot();
    }

    public function testMultiplePostTypesWithSingleAcfFieldGeneratesCorrectGroupLocationData()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithACFFieldsMock::class,
            CustomPostWithMultipleACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->times(2)
            ->with(Mockery::hasKey('location'));

        $this->provider->boot();
    }

    public function testMultiplePostTypesWithSingleAcfFieldGeneratesCorrectGroupFieldData()
    {
        $this->config->set('posttypes.register', [
            CustomPostWithACFFieldsMock::class,
            CustomPostWithMultipleACFFieldsMock::class
        ]);

        Functions\expect('acf_add_local_field_group')
            ->times(2)
            ->with(Mockery::hasKey('fields'));

        $this->provider->boot();
    }
}
