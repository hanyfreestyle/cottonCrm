<?php

use  App\AppPlugin\Models\Faq\FaqCategoryController;
use  App\AppPlugin\Models\Faq\FaqController;
use  App\AppPlugin\Models\Faq\FaqTagsController;
use Illuminate\Support\Facades\Route;

Route::CategoryRoute('faq/category', 'Faq.FaqCategory.', FaqCategoryController::class);
Route::PostRoutes('faq/', 'Faq.Question.', FaqController::class);
Route::TagsRoutes('faq/tags/', 'Faq.FaqTags.', 'FaqTags.', FaqTagsController::class);
