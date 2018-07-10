# Post Type Fields for Lumberjack

A Service Provider for the [Lumberjack](https://github.com/Rareloop/lumberjack) framework that allows you to define fields for your custom post types.

Written & maintained by the team at [The ICE Agency](https://www.theiceagency.co.uk)

## Requirements

* PHP >=7.0
* Installation via Composer
* Advanced Custom Fields Pro

## Installing

1. Install Lumberjack, see the guide [here](https://github.com/Rareloop/lumberjack).
2. Add your Advanced Custom Fields Pro key to your .env file
```ACF_PRO_KEY=YOUR_KEY_HERE```
2. Install via Composer:
```composer require iceagency/lumberjack-posttypes-acf-fields```
3. Add the provider within ```web/app/themes/lumberjack/app/config/app.php```

    ```
    'providers' => [
        ...
        IceAgency\PostTypeFields\ServiceProvider::class
        ...
    ]
    ```

## Getting Started

1. Register your Post Type within ```web/app/themes/lumberjack/app/config/posttypes.php```

    ```
    'register' => [
        ...
        App\PostTypes\YourPostType::class,
        ...
    ]
    ```

2. Create your Post Type class within ```web/app/themes/lumberjack/app/PostTypes/YourPostType.php```
3. Add a static method to define your field configuration, as follows:

    ```
    public static function getFieldConfig()
    {
        return [
            TextField::create('text_field_name')
            ->withLabel('Text Field Label')
            ->isRequired(),
            TextAreaField::create('textarea_field_name')
            ->withLabel('Textarea Field Label')
        ]
   }
   ```

## Field Types

Documentation coming soon



