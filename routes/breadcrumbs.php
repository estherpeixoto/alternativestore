<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Início', route('dashboard'));
});

// Users
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
	$trail->parent('dashboard.index');
    $trail->push('Usuários', route('user.list'));
});

Breadcrumbs::for('users.form', function (BreadcrumbTrail $trail, $user) {
	$trail->parent('users.index');
    $trail->push(empty($user) ? 'Cadastrar' : $user);
});