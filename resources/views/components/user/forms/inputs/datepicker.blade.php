@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <style>
        .input-group-append {
            cursor: pointer;
        }

        .custom {
            border: 1px solid #1f1e24 !important;
            background: #1f1e24 !important;
            border-radius: 4px !important;
            color: #bcbcbc !important;
        }

        .form-control-custom {
            flex: 1 1 auto !important;
            width: 1% !important;
            margin-bottom: 0 !important;
            height: calc(1.5em + 0.75rem + 2px) !important;
            font-size: 1rem !important;
            line-height: 1.5 !important;
        }
    </style>
@endpush
<div class="input-group date datepicker mb-3">
    <input type="text" class="form-control-custom rounded-left" {{ $attributes }}/>
    <span class="input-group-append">
          <span class="input-group-text custom d-block">
            <i class="fa fa-calendar"></i>
          </span>
        </span>
</div>
@push('js')
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script>
        $(function(){
            $('.datepicker').datepicker({format: 'dd/mm/yyyy'});
        });
    </script>
@endpush
