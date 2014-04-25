<h3>
	<i class="fa fa-edit"></i> Editing {{Entity}}
</h3>

<?= View::make('{{_entities}}._form', array(
	'{{entity}}' => ${{entity}},
	'action' => action("{{Entity}}Controller@update", [${{entity}}->id]),
	'method' => 'PUT'
)) ?>