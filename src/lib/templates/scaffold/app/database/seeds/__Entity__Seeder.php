<?php

//
// https://github.com/fzaninotto/Faker
// "fzaninotto/faker": "v1.3.0"
//

class {{Entity}}Seeder extends Seeder
{
	/**
	 * Seed the database with some fake data
	 */
	public function run()
	{
		Eloquent::unguard();

		$faker = Faker\Factory::create();
		$faker->seed(1234);

		foreach(range(1, 10) as $index)
		{
			{{Entity}}::create([
{% for belongTo in belongsTo %}
				'{{belongTo._name_}}_id' => $index;
{% endfor %}
{% for attribute in attributes %}
{% if attribute.type == 'integer' %}
				'{{attribute.name_unmodified}}' => $faker->randomNumber(),
{% elseif attribute.type == 'string' %}
				'{{attribute.name_unmodified}}' => $faker->word(),
{% elseif attribute.type == 'datetime' %}
				'{{attribute.name_unmodified}}' => $faker->dateTime(),
{% else %}
				'{{attribute.name_unmodified}}' => $faker->randomNumber(),
{% endif %}
{% endfor %}
			]);
		}
	}

}