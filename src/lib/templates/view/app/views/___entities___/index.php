<div class="row">
    <div class="col-sm-12">
        <h3>{{Entity}}</h3>
    </div>
</div><hr>

<div class="row">
    <div class="col-sm-2">
        <h4>
            <a href="<?= action("{{Entity}}Controller@create") ?>">
                <i class="fa fa-plus"></i> New {{Entity}}
            </a>
        </h4>
    </div>
</div>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
{% for attribute in attributes %}
			<th>{{attribute.Name}}</th>
{% endfor %}
            <th>Actions</th>
        </tr>
    </thead>
	<tbody>
		<?php foreach (${{entities}} as ${{entity}}): ?>
			<tr>
{% for attribute in attributes %}
				<td><?= ${{entity}}->{{attribute._name_}} ?></td>
{% endfor %}
				<td>
					<div class="actionButtons">
						<a href="<?= action("{{Entity}}Controller@show", [${{entity}}->id]) ?>" title="View">
							<i class="fa fa-eye"></i>
						</a>

						<a href="<?= action("{{Entity}}Controller@edit", [${{entity}}->id]) ?>" title="Edit">
                            <i class="fa fa-pencil"></i>
						</a>

						<a href="<?= action("{{Entity}}Controller@destroy", [${{entity}}->id]) ?>" title="Remove" data-method="DELETE">
                            <i class="fa fa-times"></i>
						</a>
					</div>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?= ${{entities}}->links() ?>