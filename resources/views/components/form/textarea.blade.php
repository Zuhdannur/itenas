<div class="form-group">
    {{ Form::label($label) }}
    {{ Form::textarea('My text', $value, [
        'class' => 'form-control',
        'rows' => 5,
        'name' => $name,
        'id' => $name,
        'onkeypress' => 'return nameFunction(event);',
        'disabled' => $disabled,
    ]) }}
</div>
