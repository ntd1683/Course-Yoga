<?php
use Diglactic\Breadcrumbs\Breadcrumbs;

// Home

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('index'));
});

// Pricing
Breadcrumbs::for('pricing', function ($trail) {
    $trail->parent('home');
    $trail->push(trans('Pricing'), route('pricing'));
});
