sleeve.phar
================================

## Quickstart

Download [sleeve.phar](https://github.com/CodeSleeve/sleeve.phar/raw/master/sleeve.phar) and place it somewhere

```
	sudo mv sleeve.phar /usr/bin/local/sleeve
	sudo chmod +x /usr/bin/local/sleeve
```

Now ensure everything is working correctly by running,

```
	sleeve
```

One additional note here. I create an alias in my `~/.bashrc` so I can use `g model` instead of `sleeve model`.


## Like videos?

Here is a 5 minute video showing how to install, use and most importantly tweak this thing.

// TODO VIDEO HERE

## How does it all work (for me)?

This package mainly piggy backs off of the architecture provided by [Codesleeve\generator](https://github.com/CodeSleeve/generator/blob/master/README.md). Out of the box you have these generators available.

* command - create a new laravel command for entity
* controller - create a new laravel controller for entity
* laravel - create a new laravel application (this is copied from Taylor's laravel.phar)
* migration - create a new laravel migration for entity
* model - create a new laravel model for entity
* scaffold - scaffold out model, views, controller, migration, test and seed for entity
* seed - create a new seed file for entity
* test - create a new integration test for entity
* view - create a new view for entity

But don't worry, if that doesn't quite fit the bill then you can jump to the next section about your own customizations.

## Customizing the generator

You can completely override and configure any aspect of the generators. Create a generator.json that is where you will be running your sleeve command from (i.e. the laravel project root). You can also use `sleeve -c /some/path/to/config.json` if you want.

Here are a list of things you can override.

```
	"models" {
		"templates": "templates/models",
        "context": "Codesleeve\\Generator\\EntityContext",
        "command": "Codesleeve\\Generator\\GeneratorCommand",
        "parser": "Codesleeve\\Generator\\TwigParser",
        "writer": "Codesleeve\\Generator\\FileWriter",
        "variables": {

    	}
	}
```

You can create your own generators, modify templates, contexts, even swap out the Twig template engine for something else and write files where ever you please. For more info on each thing you can customize read further.

## Context Generation

So what variables can you use in your twig templates?

Here is a list
(let's assume you passed in `model user_settings stripe_id:integer:unique backup_email:string belongsTo:user ` as the entity).

- **Entity** - Studly singular, i.e. UserSetting

- **Entities** - Studly plural, i.e. UserSettings

- **entity** - camelCase singular, i.e. userSetting

- **entities** - camelCase plural, i.e. userSettings

- **_entity_** - snake singular, i.e. user_setting

- **_entities_** - snake plural, i.e. user_settings

- **fields** - i.e. `['name_unmodified' => 'stripe_id', name' => 'stripeId', 'Name' => 'StripeId', '_name_' => 'stripe_id', 'names' => 'stripeIds', 'Names' => 'StripeIds', '_names_' => 'stripe_ids', type' => 'integer', 'index' => 'unique']

- **belongsTo** - i.e. `['name_unmodified' => 'user', name' => 'user', 'Name' => 'User', '_name_' => 'user', 'names' => 'users', 'Names' => 'Users', '_names_' => 'users']

- **hasMany** - i.e. [] an array much like belongsTo

- **belongsToMany** - i.e. [] an array much like belongsTo

- **migration_timestamp** - i.e. `2014_04_01_000000_`

- **migration_filename** - i.e. `2014_04_01_000000_add_user_settings_table`

- **migration_classname** - i.e. `AddUserSettingsTable`

And more as we upgrade our `LaravelContext` generator. These are pretty generic variable names (with exception of `migration_` stuff) so this context can be re-used in other generators. We have created [LaravelContext](https://github.com/CodeSleeve/sleeve.phar/blob/master/src/lib/LaravelContext.php) for generating variables specific to Laravel.


### Variables

So you might be wondering what each of these things do? Let's start with variables.

Let's say you want to add some new variables, if they are static just add a line in your `sleeve.json`

```js
	"models" {
		"templates": "templates/models",
		"variables": {
			"namespace": "Acme\\Site\\"
		}
	}
```

And now this variable will be available to you in your twig templates.

### Context

But what if you need something more dynamic? Well then you can completely override the Context generator class

```js
	"models" {
		"templates": "templates/models",
		"context": "MyContextClass"
	}
```

```php
	class MyContextClass implements Codesleeve\Generator\Interfaces\ContextInterface
	{
		...
	}
```

You can also just extend [LaravelContext](https://github.com/CodeSleeve/sleeve.phar/blob/master/bin/LaravelContext.php) if you just want to add additional functionality.

And remember, context generators are simple. They only create associative arrays of variables for the [Parser](https://github.com/CodeSleeve/generator/blob/master/src/Codesleeve/Generator/TwigParser.php) to use.

### Templates

This is just the relative path to the directory that hold the structure and files for this layout. Anything prefixed and suffixed with `__` will be considered a variable (if the variable exists for that). So if you have `app/models/__Entity__.php` that will be generated as `app/models/User.php`.

If you want to create your own templates but don't want to fool around with the sleeve.json, you can create a templates directory relative to where you will be running your generator (e.g. in your laravel project root) and `sleeve.phar` will pick those up instead of the defaults. It's that simple.

### Parser

We use Twig for our parser and out of the box Twig is just plain bad ass for a template engine. However, maybe you want to use something else or maybe you want to change the Lexer for your Twig parser? Go for it, if that is something you want. Just make sure to implement [ParserInterface](https://github.com/CodeSleeve/generator/blob/master/src/Codesleeve/Generator/Interfaces/ParserInterface.php) for your custom parser.


### Command

If you want to treat some command differently for say, `assets` then you can override the `command` option in your sleeve.json. This will be fed a [GeneratorConfigInterface](https://github.com/CodeSleeve/generator/blob/master/src/Codesleeve/Generator/Interfaces/GeneratorConfigInterface.php) as a dependency for you to work with. You'll probably want to [check out how the default GeneratorCommand works](https://github.com/CodeSleeve/generator/blob/master/src/Codesleeve/Generator/GeneratorCommand.php).


## About Codesleeve\Generator

There are tests in `spec` and you can even see a diagram of how things come together.

Check it out. https://github.com/CodeSleeve/generator/blob/master/README.md


## License

sleeve.phar is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT)


## How can I share my generator.json and templates?

So you've got some cool generators and templates eh? Put in a pull request about them (be sure to fork and show me your setup). Remember it doesn't have to be laravel specific templates either. You can create generators for other languages if you want.