@props(['name', 'label', 'type' => 'text', 'value' => '', 'class' => 'form-control', 'placeholder', 'disabled' => false, 'checked' => 0, 'required' => 0, 'needLivewire' => '1'])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        <h6>{{ $label }}</h6>
    </label>
    <input name="{{ $name }}" type="{{ $type }}" id="{{ $name }}"
        placeholder="{{ $placeholder ?? 'Enter ' . $label }}"
        @if ($needLivewire) wire:model.defer="{{ $name }}" @endif
        class="{{ $class }} @error($name)is-invalid @enderror" value="{{ $value }}" @required($required)
        @if ($checked) @checked(true) @endif @disabled($disabled)>
    @error($name)
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
            {{ $message }}
        </div>
    @enderror
</div>
