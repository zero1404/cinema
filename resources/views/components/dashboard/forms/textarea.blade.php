<div class="form-group mb-4">
    <label for="input{{ ucfirst($property) }}" class="col-form-label">{{ $name }}: </label>
    <textarea class="form-control @error($property) is-invalid @enderror" id="input{{ ucfirst($property) }}"
        name="{{ $property }}" placeholder="{{ $placeholder }}" {{
        $rows> 0 ? ' rows=' . $rows . '' : '' }}{{ $columns > 0 ? ' columns=' . $columns . '' : '' }}>{{ $value }}</textarea>
    @error($property)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if($isHasEditor)
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
            // Define function to open filemanager window
            var lfm = function(options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                    'width=900,height=600');
                window.SetUrl = cb;
            };
            // Define LFM summernote button
            var LFMButton = function(context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'Insert image with filemanager',
                    click: function() {
                        lfm({
                            type: 'image',
                            prefix: '/laravel-filemanager'
                        }, function(lfmItems, path) {
                            lfmItems.forEach(function(lfmItem) {
                                context.invoke('insertImage', lfmItem.url);
                            });
                        });
                    }
                });
                return button.render();
            };
            // Initialize summernote with LFM button in the popover button group
            // Please note that you can add this button to any other button group you'd like
            $('#input{{ ucfirst($property) }}').summernote({
                placeholder: '{{ $placeholder }}',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['popovers', ['lfm']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                buttons: {
                    lfm: LFMButton
                }
            })
        });
</script>
@endpush
@endif