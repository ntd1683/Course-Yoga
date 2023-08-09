<?php

use App\Models\Option;
use Ramsey\Uuid\Type\Integer;

if (!function_exists('option')) {
    function option($name, $default = '')
    {
        try {
            $option = Option::query();
            $value = $option->where('name', $name)->firstOrFail()->value;
        } catch (\Exception $e) {
            $value = $default;
        }
        return $value;
    }
}

if (!function_exists('optionSave')) {
    function optionSave($name, $value): void
    {
        if($value) {
            $option = Option::query()->firstOrNew([
                'name' => $name,
            ], $attributes = [
                'value' => $value,
            ]);

            if ($option->exists) {
                $option->fill($attributes);
            }

            $option->save();
        }
    }
}

if (!function_exists('getNameRouteMain')) {
    function getNameRouteMain(): string
    {
        $arrRouteName = explode('.', request()->route()->getName());

        if($arrRouteName[0] == 'admin') {
            return $arrRouteName[1];
        }

        return $arrRouteName[0];
    }
}

if (!function_exists('getTitle')) {
    function getTitle(): string
    {
        if(request()->route() == null) {
            return config('app.name', 'Laravel');
        }
        $arrRouteName = explode('.', request()->route()->getName());
        if($arrRouteName[0] == 'admin') {
            $tmp = $arrRouteName[1];
            if($arrRouteName[1] == 'index') {
                $tmp = 'dashboard';
            }
            $suffix = 'admin - ' . $tmp;
        } else if($arrRouteName[0] == 'index'){
            return option('site_name', config('app.name', 'Laravel'));
        } else {
            $suffix = $arrRouteName[0];
        }
        $suffix = ucwords($suffix);


        return option('site_name', config('app.name', 'Laravel')) . ' - ' . $suffix;
    }
}

if (!function_exists('discountPrice')) {
    function discountPrice($price, $discount): integer
    {
        return ($price * $discount)/100;
    }
}


//input : 188833 => output = 189k
if(!function_exists('number_shorten')){
    function number_shorten($number, $precision = 3, $divisors = null) {

        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'K', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
            );
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return (int)number_format($number / $divisor, $precision) . $shorthand;
    }
}
