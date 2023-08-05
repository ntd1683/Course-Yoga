@props([
    'name' => '',
    'value' => '',
])
<div class="form-group d-flex align-items-center">
    <input id="{{ $name }}" type="password" class="form-control"
           required name="{{ $name }}">
    <span toggle="#{{ $name }}" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</div>
