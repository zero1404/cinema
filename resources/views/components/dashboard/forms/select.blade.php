<div class="form-group mb-4">
    <label for="input{{ ucfirst($property) }}">{{ $name }}:</label>
    <select name="{{ $property }}" id="input{{ ucfirst($property) }}"
        class="form-control @error($property) is-invalid @enderror" 
        @if($multiple)
        multiple="multiple"
        @endif
        >
        @if(!$multiple)
        <option value="">Chọn {{ strtolower($name) }}</option>
        @endif
        {{ $slot }}
    </select>
    @error($property)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>