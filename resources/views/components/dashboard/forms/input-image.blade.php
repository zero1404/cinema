<div class="form-group">
    <label for="input{{ ucfirst($property) }}" class="col-form-label">{{ $name }}: </label>
    <div class="input-group">
        <span class="input-group-btn">
            <a id="lfm" data-input="input{{ ucfirst($property) }}" data-preview="holder" class="btn btn-primary" style="z-index: 0">
                <i class="fas fa-upload"></i> Chọn
            </a>
        </span>
        <input id="input{{ ucfirst($property) }}" class="form-control" type="text" name="{{ $property }}"
            value="{{ $value }}" />
    </div>
    <img id="holder" style="margin-top:15px;max-height:100px;">
    @error($property)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>