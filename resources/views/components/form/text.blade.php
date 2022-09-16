<div class="form-group">
    {{ Form::label($label) }}
    {{ Form::text($name, old($name), array_merge(['class' => 'form-control', 'id' => $name], $attributes)) }}
</div>
