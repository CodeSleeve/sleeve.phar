<?php

class {{Entity}}ControllerTest extends TestCase
{
	function test_it_can_show_index_page_for_{{_entities_}}()
	{
		$crawler = $this->client->request('GET', '/{{_entities_}}');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_show_create_page_for_{{_entities_}}()
	{
		$crawler = $this->client->request('GET', '/{{_entities_}}/create');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_store_{{_entities_}}()
	{
		$crawler = $this->client->request('POST', '/{{_entities_}}');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_show_show_page_for_{{_entities_}}()
	{
		$crawler = $this->client->request('GET', '/{{_entities_}}/1');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_show_edit_page_for_{{_entities_}}()
	{
		$crawler = $this->client->request('GET', '/{{_entities_}}/1/edit');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_update_{{_entities_}}()
	{
		$crawler = $this->client->request('PUT', '/{{_entities_}}/1');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	function test_it_can_destroy_{{_entities_}}()
	{
		$crawler = $this->client->request('DELETE', '/{{_entities_}}/1');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

}