<div class="form-group {{$errors->has($name) ? ' has-error' : ''}}">
    {{ Form::label($name, $label_name, ['class' => 'control-label'])  }}
    {{ Form::date($name, $value, array_merge(['class' => 'form-control', 'autocomplete' => 'off'], $attributes))  }}
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>