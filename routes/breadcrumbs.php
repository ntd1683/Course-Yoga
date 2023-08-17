<?php
use Diglactic\Breadcrumbs\Breadcrumbs;

// Home

Breadcrumbs::for('home', function ($trail) {
    $trail->push(trans('Home'), route('index'));
});

// Pricing
Breadcrumbs::for('pricing', function ($trail) {
    $trail->parent('home');
    $trail->push(trans('Pricing'), route('pricing'));
});

// Course
Breadcrumbs::for('course', function ($trail) {
    $trail->parent('home');
    $trail->push(trans('Course'), route('course'));
});

// Contact
Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push(trans('Contact'), route('contact'));
});

// Profile
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push(trans('Profile'), route('profile'));
});
