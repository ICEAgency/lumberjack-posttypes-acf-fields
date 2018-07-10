<?php
namespace IceAgency\PostTypeFields;

use ReflectionClass;
use Interfaces\HasAcfFields;
use Rareloop\Lumberjack\Providers\ServiceProvider;
use Rareloop\Lumberjack\Config;
use Tightenco\Collect\Support\Collection;

class ACFFieldImportProvider extends ServiceProvider
{
    public function boot(Config $config)
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        collect($config->get('posttypes.register'))->each(function ($postTypeClass) {
            if (!$this->postTypeHasAcfFields($postTypeClass)) {
                return;
            }

            $acfData = $this->getAcfDataForPostType($postTypeClass);

            acf_add_local_field_group($acfData);
        });
    }

    private function getAcfDataForPostType(string $postTypeClass) : array
    {
        $fieldsConfig = collect($postTypeClass::getFieldConfig());
        $postType = $postTypeClass::getPostType();

        $field_group = new FieldGroup($postType);

        foreach ($fieldsConfig as $field) {
            $field_group->addField($field);
        }

        return $field_group->toArray();
    }

    private function postTypeHasAcfFields(string $postTypeClass)
    {
        $class = new ReflectionClass($postTypeClass);

        return $class->implementsInterface(HasAcfFields::class);
    }
}