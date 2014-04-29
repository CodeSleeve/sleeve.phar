<div class="row">
    <div class="col-sm-12">
		<h3>
            Viewing User <?= ${{entity}}->id ?>
            <a href="javascript:history.back();" class="btn btn-primary pull-right">Back</a>
        </h3>
    </div>
</div><hr>

<h4>Attributes</h4>

{% for attribute in attributes %}
<div class="row">
    <label for="{{attribute._name_}}" class="col-sm-3">{{attribute.Name}}</label>
    <div class="col-sm-9">
        <?= ${{entity}}->{{attribute._name_}} ?>
    </div>
</div>

{% endfor %}

<h4>Belongs to</h4>

{% for belongTo in belongsTo %}
<div class="row">
    <label for="{{belongTo._name_}}" class="col-sm-3">{{belongTo.Name}}</label>
    <div class="col-sm-9">
        <?= ${{entity}}->{{belongTo._name_}} ?>
    </div>
</div>

{% endfor %}