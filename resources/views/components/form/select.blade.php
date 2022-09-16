<div class="form-group">
    {{ Form::label($label) }}
    {{ Form::select($name, $items, old($name), array_merge(['class' => 'form-control', 'id' => $name], $attributes)) }}
</div>
