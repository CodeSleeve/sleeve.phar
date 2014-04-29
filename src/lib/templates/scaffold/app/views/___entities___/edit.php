<div class="row">
    <div class="col-sm-12">
		<h3>
			<i class="fa fa-edit"></i> Editing {{Entity}}
		</h3>
    </div>
</div><hr>

<?= View::make('{{_entities_}}._form', array(
	'{{entity}}' => ${{entity}},
	'action' => action("{{Entity}}Controller@update", [${{entity}}->id]),
	'method' => 'PUT'
)) ?>