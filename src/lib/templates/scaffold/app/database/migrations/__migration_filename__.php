<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class {{migration_classname}} extends Migration
{
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('{{_entities_}}', function(Blueprint $table)
		{
			$table->increments('id');
{% for belongTo in belongsTo %}
			$table->unsignedInteger('{{belongTo._name_}}_id');
{% endfor %}
{% for attribute in attributes %}
			$table->{{attribute.type}}('{{attribute.name_unmodified}}'){% if attribute.index %}->{{attribute.index}}(){% endif %};
{% endfor %}
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('{{_entities_}}');
	}
}