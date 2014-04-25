<?php

class {{Entity}} extends Eloquent
{
	/**
	 * List of attributes for a {{entity}}
	 *
	 * @var array
	 */
	protected $fillable = [
{% for attribute in attributes %}
		'{{attribute.name_unmodified}}',
{% endfor %}
	];

{% for relationship in belongsTo %}
	/**
	 * A {{entity}} belongsTo a {{relationship.Name}}
	 */
	public function {{relationship.name}}()
	{
		return $this->belongsTo('{{Entity}}');
	}
{% endfor %}

{% for relationship in hasMany %}
	/**
	 * A {{entity}} hasMany {{relationship.Names}}
	 */
	public function {{relationship.names}}()
	{
		return $this->hasMany('{{Entity}}');
	}
{% endfor %}

{% for relationship in belongsToMany %}
	/**
	 * A {{entity}} belongsToMany {{relationship.Names}}
	 */
	public function {{relationship.names}}()
	{
		return $this->belongsToMany('{{Entity}}');
	}
{% endfor %}

}
