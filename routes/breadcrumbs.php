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

// Sizes
Breadcrumbs::for('sizes.index', function (BreadcrumbTrail $trail) {
	$trail->parent('dashboard.index');
    $trail->push('Tamanhos', route('size.list'));
});

Breadcrumbs::for('sizes.form', function (BreadcrumbTrail $trail, $size) {
	$trail->parent('sizes.index');
    $trail->push(empty($size) ? 'Cadastrar' : $size);
});

// Categories
Breadcrumbs::for('categories.index', function (BreadcrumbTrail $trail) {
	$trail->parent('dashboard.index');
    $trail->push('Categorias', route('category.list'));
});

Breadcrumbs::for('categories.form', function (BreadcrumbTrail $trail, $category) {
	$trail->parent('categories.index');
    $trail->push(empty($category) ? 'Cadastrar' : $category);
});

// Products
Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
	$trail->parent('dashboard.index');
    $trail->push('Produtos', route('product.list'));
});

Breadcrumbs::for('products.form', function (BreadcrumbTrail $trail, $product) {
	$trail->parent('products.index');
    $trail->push(empty($product) ? 'Cadastrar' : $product);
});

// Orders
Breadcrumbs::for('orders.index', function (BreadcrumbTrail $trail) {
	$trail->parent('dashboard.index');
    $trail->push('Pedidos', route('order.list'));
});

Breadcrumbs::for('orders.form', function (BreadcrumbTrail $trail, $order) {
	$trail->parent('orders.index');
    $trail->push(empty($order) ? 'Cadastrar' : $order);
});