<?= Form::open(['url' => $action, 'method' => $method, 'class' => 'form']) ?>
{% for belongTo in belongsTo %}
	<div class="form-group">
		<label for="{{belongTo._name_}}" class="form-label">{{belongTo.Name}}</label>
		<?= Form::text('{{belongTo._name_}}', ${{entity}}->{{belongTo._name_}}, ['class' => 'form-control']) ?>
		<?php if ($errors->has('{{belongTo._name_}}')): ?>
			<div class="alert alert-warning error">$errors->first('{{belongTo._name_}}')</div>
		<?php endif ?>
	</div>
{% endfor %}
{% for attribute in attributes %}
	<div class="form-group">
		<label for="{{attribute._name_}}" class="form-label">{{attribute.Name}}</label>
        <?= Form::text('{{attribute._name_}}', ${{entity}}->{{attribute._name_}}, ['class' => 'form-control']) ?>
		<?php if ($errors->has('{{attribute._name_}}')): ?>
			<div class="alert alert-warning error">$errors->first('{{attribute._name_}}')</div>
		<?php endif ?>
	</div>
{% endfor %}

	<div class="form-group">
		<a href="javascript:history.back();" class="btn">Cancel</a>
		<?= Form::submit('Save', ['class' => 'btn btn-primary']) ?>
	</div>
<?= Form::close() ?>