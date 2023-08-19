@props([
    'jsOption' => '',
])
@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <style>
        .input-group-append {
            cursor: pointer;
        }
    </style>
@endpush
<div class="input-group date datepicker">
    <input type="text" class="form-control" {{ $attributes }}/>
    <span class="input-group-append">
          <span class="input-group-text bg-light d-block">
            <i class="fa fa-calendar"></i>
          </span>
        </span>
</div>
@push('js')
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script>
        $(function(){
            $('.datepicker').datepicker();
            {!! $jsOption !!}
        });
    </script>
@endpush
