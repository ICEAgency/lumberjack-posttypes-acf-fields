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
        IceAgency\PostTypeFields\PostTypeFieldsServiceProvider::class,
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
3. Add the ```HasACFFields``` interface to your Post Type

    ```
    use IceAgency\PostTypeFields\Interfaces\HasAcfFields;

    class YourPostType extends Post implements HasAcfFields
    {
        ...
    }
    ```

4. For each field type you need to use, ensure that you include the relevent classes at the top of your Post Type class, for this example:

    ```
    use IceAgency\PostTypeFields\AcfFields\TextField;
    use IceAgency\PostTypeFields\AcfFields\TextAreaField;
    ```

5. Add a static method to define your field configuration, as follows:

    ```
    public static function getFieldConfig() : array
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

* Text: ``` IceAgency\PostTypeFields\AcfFields\TextField; ```
* Text Area: ``` IceAgency\PostTypeFields\AcfFields\TextField; ```

## Field Methods

**create($name)**

Create a field with the name given, this is the name that is used to retrieve the data with ACF's get_field() function

**withLabel($label)**

Used to set the label for the field within the WordPress Admin area.

**isRequired()**

Used to make the field required.

