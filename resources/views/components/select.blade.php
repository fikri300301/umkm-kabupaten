@props(['name', 'label', 'disabled' => false])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        <h6>{{ $label }}</h6>
    </label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control @error($name)is-invalid @enderror"
        wire:model.defer="{{ $name }}" @disabled($disabled)>
        <option value="">Pilih salah satu</option>
        {{ $slot }}
    </select>
    @error($name)
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
            {{ $message }}
        </div>
    @enderror
</div>
