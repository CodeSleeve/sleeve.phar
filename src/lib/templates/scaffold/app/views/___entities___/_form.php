<?= Form::open(['url' => $action, 'method' => $method, 'class' => 'form']) ?>
{% for belongTo in belongsTo %}
	<div class="form-group">
		<label for="{{belongTo._name_}}" class="form-label">{{belongTo.Name}}</label>
        <?= Form::text('{{belongTo._name_}}', ${{entity}}->{{belongTo._name_}}, ['class' => 'form-control']) ?>
        <?= HTML::show_message_when('{{belongTo._name_}}', $errors) ?>
	</div>

{% endfor %}
{% for attribute in attributes %}
	<div class="form-group">
		<label for="{{attribute._name_}}" class="form-label">{{attribute.Name}}</label>
        <?= Form::text('{{attribute._name_}}', ${{entity}}->{{attribute._name_}}, ['class' => 'form-control']) ?>
        <?= HTML::show_message_when('{{attribute._name_}}', $errors) ?>
	</div>

{% endfor %}

	<div class="form-group">
		<a href="javascript:history.back();" class="btn">Cancel</a>
		<?= Form::submit('Save', ['class' => 'btn btn-primary']) ?>
	</div>
<?= Form::close() ?>


