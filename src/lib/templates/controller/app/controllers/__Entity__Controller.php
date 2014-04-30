<?php

class {{Entity}}Controller extends BaseController
{
	/**
	 * Construct the controller
	 */
	public function __construct()
	{
		$this->updateRules = $this->storeRules = array(
{% for attribute in attributes %}
			'{{attribute.name_unmodified}}' => 'required',
{% endfor %}
		);
	}

	/**
	 * Show listing of resource
	 *
	 * @return Response
	 */
	public function index()
	{
		${{entities}} = {{Entity}}::paginate();

		return $this->layout->nest('content', '{{_entities_}}.index', compact('{{entities}}'));
	}

	/**
	 * Show the page to create a new resource
	 *
	 * @return Response
	 */
	public function create()
	{
		${{entity}} = new {{Entity}};

		${{entity}}->fill(Input::old());

		return $this->layout->nest('content', '{{_entities_}}.create', compact('{{entity}}'));
	}

	/**
	 * Store the resource in the database
	 *
	 * @return Redirect
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), $this->storeRules);

		if ($validator->fails())
		{
			return Redirect::route('{{_entities_}}.create')->withErrors($validator)->withInput();
		}

		{{Entity}}::create($data);

		return Redirect::route('{{_entities_}}.index');
	}

	/**
	 * Show this particular resource
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function show($id)
	{
		${{entity}} = {{Entity}}::findOrFail($id);

		return $this->layout->nest('content', '{{_entities_}}.show', compact('{{entity}}'));
	}

	/**
	 * Show the page to edit this resource
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function edit($id)
	{
		${{entity}} = {{Entity}}::findOrFail($id);

		${{entity}}->fill(Input::old());

		return $this->layout->nest('content', '{{_entities_}}.edit', compact('{{entity}}'));
	}

	/**
	 * Update the resource in the database
	 *
	 * @param  integer $id
	 * @return Redirect
	 */
	public function update($id)
	{
		${{entity}} = {{Entity}}::findOrFail($id);

		$validator = Validator::make($data = Input::all(), $this->updateRules);

		if ($validator->fails())
		{
			return Redirect::route('{{_entities_}}.edit', $id)->withErrors($validator)->withInput();
		}

		${{entity}}->update($data);

		return Redirect::route('{{_entities_}}.index');
	}

	/**
	 * Remove the resource from the database
	 *
	 * @param  integer $id
	 * @return Redirect
	 */
	public function destroy($id)
	{
		{{Entity}}::destroy($id);

		return Redirect::route('{{_entities_}}.index');
	}
}