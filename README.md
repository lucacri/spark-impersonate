# Nova Spark Impersonate Field

This field allows you to authenticate as your users via Spark.

![screenshot1](https://raw.githubusercontent.com/lucacri/spark-impersonate/master/docs/screenshot1.png?123)
![screenshot2](https://raw.githubusercontent.com/lucacri/spark-impersonate/master/docs/screenshot2.png?123)
![screenshot3](https://raw.githubusercontent.com/lucacri/spark-impersonate/master/docs/screenshot3.png?123)

Forked from the beautiful package [KABBOUCHI/nova-impersonate](https://github.com/KABBOUCHI/nova-impersonate).

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require lucacri/spark-impersonate
```

## Usage

Add `SparkImpersonate::make($this)` field in `App\Nova\User.php`
```php
<?php

namespace App\Nova;

use Lucacri\SparkImpersonate\SparkImpersonate;

...

class User extends Resource
{
	...
	
	public function fields(Request $request)
	{
		return [
			ID::make()->sortable(),

			Gravatar::make(),

			Text::make('Name')
				->sortable()
				->rules('required', 'max:255'),

			Text::make('Email')
				->sortable()
				->rules('required', 'email', 'max:255')
				->creationRules('unique:users,email')
				->updateRules('unique:users,email,{{resourceId}}'),

			Password::make('Password')
				->onlyOnForms()
				->creationRules('required', 'string', 'min:6')
				->updateRules('nullable', 'string', 'min:6'),


			SparkImpersonate::make($this),  // <---
		
			// or
		
			SparkImpersonate::make($this)->withMeta([
			    'hideText' => false,
			]),
		

		];
	}

    ...
}
```

## Advanced Usage

By default all users can **impersonate** an user.  
You need to add the method `canImpersonate()` to your user model:

```php
    /**
     * @return bool
     */
    public function canImpersonate()
    {
        // For example
        return $this->is_admin == 1;
    }
```

By default all users can **be impersonated**.  
You need to add the method `canBeImpersonated()` to your user model to extend this behavior:
Please make sure to pass instance Model or Nova Resource ``SparkImpersonate::make($this)`` ``SparkImpersonate::make($this->resource)``

```php
    /**
     * @return bool
     */
    public function canBeImpersonated()
    {
        // For example
        return $this->can_be_impersonated == 1;
    }
```

## Credits

- [Georges KABBOUCHI](https://github.com/kabbouchi)

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.