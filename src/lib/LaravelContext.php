<?php

class LaravelContext implements Codesleeve\Generator\Interfaces\ContextInterface
{
	/**
	 * Create a new entity context
	 */
	public function __construct(Codesleeve\Generator\EntityContext $entity = null)
	{
		if( ! ini_get('date.timezone') )
		{
		    date_default_timezone_set('GMT');
		}

		$this->entity = $entity ?: new Codesleeve\Generator\EntityContext;
	}

	/**
	 * We use an Entity context but add some extra goodies
	 * just for Laravel.
	 *
	 * @param  array  $parameters
	 * @return array
	 */
	public function context(array $parameters)
	{
		$context = $this->entity->context($parameters);

		$context = $this->migrations($context);

		return $context;
	}

	/**
	 * Returns the context for migrations
	 *
	 * @param  array $context
	 * @return array
	 */
	protected function migrations($context)
	{
		$timestamp = new DateTime;
		$timestamp = $timestamp->format('Y\_m\_d\_His');

		$context['migration_timestamp'] = $timestamp;
		$context['migration_classname'] = 'Create' . $context['Entities']. 'Table';
		$context['migration_filename'] = $timestamp . '_create_' . $context['_entities_'] . '_table';

		return $context;
	}

}