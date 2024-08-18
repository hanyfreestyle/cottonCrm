<?php

use App\AppPlugin\Models\BlogPost\BlogCategoryController;
use App\AppPlugin\Models\BlogPost\BlogPostController;
use App\AppPlugin\Models\BlogPost\BlogTagsController;
use Illuminate\Support\Facades\Route;

Route::CategoryRoute('blog/category', 'Blog.BlogCategory.', BlogCategoryController::class);
Route::PostRoutes('blog/', 'Blog.BlogPost.', BlogPostController::class);
Route::TagsRoutes('blog/tags/', 'Blog.BlogTags.', 'BlogTags.', BlogTagsController::class);
