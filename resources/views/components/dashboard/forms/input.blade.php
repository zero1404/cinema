<div class="form-group mb-4">
    <label for="input{{ ucfirst($property) }}" class="col-form-label">{{ $name }}: </label>
    <input class="form-control
        @error($property) is-invalid @enderror
    " type="{{ $type }}" id="input{{ ucfirst($property) }}" name="{{ $property }}" placeholder="{{ $placeholder }}"
        value="{{ $value }}" {{ $type=='number' ? ' min=' . $min . '' : '' }} {{ $type=='number' ? ' max=' . $max . ''
        : '' }} />

    @error($property)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>