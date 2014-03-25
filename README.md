sleeve.phar
================================

## Quickstart

Download [sleeve.phar](google.com) and place it somewhere

```
	sudo mv sleeve.phar /usr/bin/local/sleeve
	sudo chmod +x /usr/bin/local/sleeve
```

Now ensure everything is working correctly by running,

```
	sleeve
```

## How does it work?

Out of the box you have these generators available.

- assets
- command
- controller
- migration
- model
- resource
- scaffold
- seed
- test
- view

But don't worry, if that doesn't quite fit your needs then you can jump to the next section about creating


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

- **fields** - i.e. `['name' => 'stripe_id', 'type' => 'integer', 'index' => 'unique'], ['name' => 'backup_email', 'type' => 'string']`

- **belongsTo** - i.e. ['user']

- **hasMany** - i.e. []

- **hasOne** - i.e. []

- **belongsToMany** - i.e. []

- **migration_timestamp** - i.e. `2014_04_01_000000_`

And more as we upgrade our `LaravelContext` generator. These are pretty generic variable names (with exception of `migration_timestamp`) so they can be re-used. However, we have created a [LaravelContext](...) for things specific to Laravel.


## Customizing the generator

You can completely override and configure any aspect of the generators. Create a sleeve.json that is where you will be running your sleeve command from (i.e. the laravel project root). You can also use `sleeve -c /some/path/to/config.json` if you want.

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
