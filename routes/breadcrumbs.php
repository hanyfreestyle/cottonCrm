<?php


use Diglactic\Breadcrumbs\Breadcrumbs;


use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('', route('page_index'));
});

Breadcrumbs::for('AboutUs', function (BreadcrumbTrail $trail,$meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '' , route('page_AboutUs'));
});

Breadcrumbs::for('Trems', function (BreadcrumbTrail $trail,$meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '' , route('page_Trems'));
});

Breadcrumbs::for('WishList', function (BreadcrumbTrail $trail,$meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '' , route('page_WishList'));
});

Breadcrumbs::for('search', function (BreadcrumbTrail $trail, $meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '', route('page_index'));
});

Breadcrumbs::for('page404', function (BreadcrumbTrail $trail, $meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '', route('page_index'));
});

Breadcrumbs::for('ContactUs', function (BreadcrumbTrail $trail,$meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '', route('page_ContactUs'));
});


Breadcrumbs::for('BlogList', function (BreadcrumbTrail $trail,) {
    $trail->parent('home');
    $trail->push(__('web/menu.main_blog'), route('BlogList'));
});

Breadcrumbs::for('BlogCategoryView', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('BlogList');
    $trail->push($category->name, route('BlogCategoryView', $category->slug));
});

Breadcrumbs::for('BlogView', function (BreadcrumbTrail $trail, $blog) {
    $trail->parent('BlogList');
    $trail->push($blog->categories->first()->name, route('BlogCategoryView', $blog->categories->first()->slug));
    $trail->push($blog->name, route('BlogView', $blog->slug));
});

Breadcrumbs::for('BrandList', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/menu.mobile_brand'), route('BrandList'));
});

Breadcrumbs::for('BrandView', function (BreadcrumbTrail $trail, $brand) {
    $trail->parent('BrandList');
    $trail->push($brand->name, route('BrandView', $brand->slug));
});

Breadcrumbs::for('ProductsCategories', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/menu.mobile_t_categories'), route('ProductsCategoriesList'));
});

Breadcrumbs::for('ProductsCategoriesView', function (BreadcrumbTrail $trail, $trees) {
    $trail->parent('ProductsCategories');
    foreach ($trees as $tree) {
        $trail->push($tree->name, route('ProductsCategoriesView', $tree->slug));
    }
});

Breadcrumbs::for('ProductsTagView', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('home');
    $trail->push($tag->name, route('ProductsTagView', $tag->slug));
});


Breadcrumbs::for('ProductView', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('home');
    $trail->push($product->categories->first()->name, route('ProductsCategoriesView', $product->categories->first()->slug));
    $trail->push($product->name, route('ProductView', $product->slug));
});


Breadcrumbs::for('Shop', function (BreadcrumbTrail $trail,$meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '', route('page_ShopView'));
});

Breadcrumbs::for('Offers', function (BreadcrumbTrail $trail,$meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '', route('page_Offers'));
});

Breadcrumbs::for('loginPage', function (BreadcrumbTrail $trail, $meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '', route('page_index'));
});

/*



Breadcrumbs::for('profile_page', function (BreadcrumbTrail $trail, $meta) {
    $trail->parent('home');
    $trail->push($meta->name ?? '', route('page_index'));
});

*/











