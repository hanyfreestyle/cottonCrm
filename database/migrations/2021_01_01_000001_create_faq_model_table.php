<?php

use App\AppPlugin\Faq\Traits\FaqConfigTraits;
use App\Helpers\BaseMigration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        $config = FaqConfigTraits::DbConfig();
        BaseMigration::createCategoryTable($config['DbCategory'], $config['DbCategoryTrans']);
        BaseMigration::createPostTable($config['DbPost'], $config['DbPostTrans'], $config['DbPostCatId']);
        BaseMigration::createMorePhotoTable($config['DbPhoto'], $config['DbPhotoTrans'], $config['DbPost'], $config['DbPostForeignId']);
        BaseMigration::createTagsTable($config['DbTags'], $config['DbTagsTrans'], $config['DbTagsPivot'], $config['DbPost'], $config['DbPostForeignId']);
    }

    public function down(): void {
        Schema::dropIfExists('faq_tags_post');
        Schema::dropIfExists('faq_tags_translations');
        Schema::dropIfExists('faq_tags');
        Schema::dropIfExists('faq_photo_translations');
        Schema::dropIfExists('faq_photo');
        Schema::dropIfExists('faq_category_faq');
        Schema::dropIfExists('faq_faqs_review');
        Schema::dropIfExists('faq_translations');
        Schema::dropIfExists('faq_faqs');
        Schema::dropIfExists('faq_category_translations');
        Schema::dropIfExists('faq_category');
    }
};
