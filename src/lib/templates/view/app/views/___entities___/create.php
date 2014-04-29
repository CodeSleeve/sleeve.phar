<h3>
    <i class="fa fa-plus"></i> Create New {{Entity}}
</h3>

<?= View::make('{{_entities_}}._form', array(
	'{{entity}}' => ${{entity}},
	'action' => action("{{Entity}}Controller@store"),
	'method' => 'POST'
)) ?>