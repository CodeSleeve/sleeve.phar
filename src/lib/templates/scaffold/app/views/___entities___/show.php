<h3>Attributes</h3>

{% for attribute in attributes %}
<div class="row">
    <label for="{{attribute._name_}}" class="col-sm-3">{{attribute.Name}}</label>
    <div class="col-sm-9">
        <?= ${{entity}}->{{attribute._name_}} ?>
    </div>
</div>

{% endfor %}

<h3>Belongs to</h3>

{% for belongTo in belongsTo %}
<div class="row">
    <label for="{{belongTo._name_}}" class="col-sm-3">{{belongTo.Name}}</label>
    <div class="col-sm-9">
        <?= ${{entity}}->{{belongTo._name_}} ?>
    </div>
</div>

{% endfor %}