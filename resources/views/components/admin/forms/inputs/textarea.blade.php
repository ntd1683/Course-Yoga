@props([
    'cols' => '30',
    'rows' => '5',
])
@push('css')
    <link rel="stylesheet" href="{{ asset('css/summernote-bs5.css') }}">
@endpush
<textarea {{ $attributes->merge(["class" => "form-control summernote"]) }} cols="{{ $cols }}" rows="{{ $rows }}">{{ $slot }}</textarea>
@push('js')
    <script src="{{ asset('js/summernote-bs5.js') }}"></script>
    <script>
        $(function() {
            $('.summernote').summernote({
                height: 300
            });
        })
    </script>
@endpush
