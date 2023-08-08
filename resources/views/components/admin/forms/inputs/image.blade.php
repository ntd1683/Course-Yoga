@props([
    'value' => asset('images/default.png'),
    'name' => '',
    'class' => '',
    'style' => '',
])
@push('css')
    <style>
        #imageUpload_{{ $name }} {
            display: none;
        }

        #imagePreview_{{ $name }} {
            width: 192px;
            height: 192px;
            background-size: cover;
            background-repeat: no-repeat;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
            background-position: center;
        }
    </style>
@endpush
<div class="avatar-upload {{ $class }}" style="{{ $style }}">
    <input type='file' id="imageUpload_{{ $name }}" accept=".png, .jpg, .jpeg" name="{{ $name }}"/>
    <div id="imagePreview_{{ $name }}" style="background-image: url({{ $value == '' ? asset('images/default.png') : $value }});" class="border rounded">
    </div>
    <label for="imageUpload_{{ $name }}" class="btn btn-primary mt-3">
        Upload
    </label>
</div>
@push('js')
    <script>
        function readURL_{{ $name }}(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview_{{ $name }}').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview_{{ $name }}').hide();
                    $('#imagePreview_{{ $name }}').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload_{{ $name }}").change(function () {
            readURL_{{ $name }}(this);
        });
    </script>
@endpush
