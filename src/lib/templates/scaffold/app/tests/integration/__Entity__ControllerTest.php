<?php

class {{Entity}}ControllerTest extends IntegrationTestCase
{
	function test_it_can_show_index_page_for_{{_entities_}}()
	{
		$crawler = $this->client->request('GET', "/{{_entities_}}");

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_show_create_page_for_{{_entities_}}()
	{
		$crawler = $this->client->request('GET', "/{{_entities_}}/create");

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_store_{{_entities_}}()
	{
		$crawler = $this->client->request('POST', "/{{_entities_}}", $this->fixture());

		$this->assertRedirectedToRoute('{{_entities_}}.index');
	}

	function test_it_cannot_store_invalid_{{_entities_}}()
	{
		$crawler = $this->client->request('POST', "/{{_entities_}}");

		$this->assertRedirectedToRoute('{{_entities_}}.create');
	}

	function test_it_can_show_show_page_for_{{_entities_}}()
	{
		$fixture = $this->fixture(true);

		$crawler = $this->client->request('GET', "/{{_entities_}}/{$fixture['id']}");

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_show_edit_page_for_{{_entities_}}()
	{
		$fixture = $this->fixture(true);

		$crawler = $this->client->request('GET', "/{{_entities_}}/{$fixture['id']}/edit");

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_update_{{_entities_}}()
	{
		$fixture = $this->fixture(true);

		$crawler = $this->client->request('PUT', "/{{_entities_}}/{$fixture['id']}", $fixture);

		$this->assertRedirectedToRoute('{{_entities_}}.index');
	}

	function test_it_cannot_update_invalid_{{_entities_}}()
	{
		$fixture = $this->fixture(true);

		$crawler = $this->client->request('PUT', "/{{_entities_}}/{$fixture['id']}");

		$this->assertRedirectedToRoute('{{_entities_}}.edit', $fixture['id']);
	}

	function test_it_can_destroy_{{_entities_}}()
	{
		$fixture = $this->fixture(true);

		$crawler = $this->client->request('DELETE', "/{{_entities_}}/{$fixture['id']}");

		$this->assertRedirectedToRoute('{{_entities_}}.index');
	}

	protected function fixture($create = false)
	{
		$faker = $this->faker();

		$data = [
{% for belongTo in belongsTo %}
				'{{belongTo._name_}}_id' => $faker->randomNumber();
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
		];

		return ($create) ? {{Entity}}::create($data)->toArray() : $data;
	}
}
