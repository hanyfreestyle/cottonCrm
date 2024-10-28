<div class="row">
    <x-admin.dashboard.color-card
        :count="$card['product_count']"
        :title="__('admin/proProduct.app_menu_product')"
        icon="fas fa-shopping-cart"
        bg="p"
        :url="route('admin.Product.Product.index')"

    />
    <x-admin.dashboard.color-card
        :count="$card['product_cat']"
        :title="__('admin/proProduct.app_menu_category')"
        icon="fas fa-sitemap"
        bg="s"
        :url="route('admin.Product.Category.index')"

    />

    <x-admin.dashboard.color-card
        :count="$card['product_barnd']"
        :title="__('admin/proProduct.app_menu_brand')"
        icon="fas fa-copyright"
        bg="i"
        :url="route('admin.Product.Brand.index')"

    />

    <x-admin.dashboard.color-card
        :count="$card['product_archived']"
        :title="__('admin/proProduct.app_menu_archived_products')"
        icon="fas fa-archive"
        bg="d"
        :url="route('admin.Product.ProductAchived.index')"

    />

</div>

<div class="row">

    <x-admin.dashboard.color-card
        :count="$card['blog_count']"
        :title="__('admin/blogPost.app_menu_blog')"
        icon="fab fa-blogger"
        bg="p"
        :url="route('admin.Blog.BlogPost.index')"

    />
    <x-admin.dashboard.color-card
        :count="$card['blog_cat_count']"
        :title="__('admin/blogPost.app_menu_category')"
        icon="fas fa-sitemap"
        bg="s"
        :url="route('admin.Blog.BlogCategory.index')"

    />
    <x-admin.dashboard.color-card
        :count="$card['order_count']"
        :title="__('admin/proProduct.dash_order_count')"
        icon="fas fa-hashtag"
        bg="i"
    />

    <x-admin.dashboard.color-card
        :count="$card['order_sum']"
        :title="__('admin/proProduct.dash_order_sum')"
        icon="fas fa-pound-sign"
        bg="d"
    />
</div>

<div class="row">
    <x-admin.dashboard.color-card
        :count="$card['order_state_1']"
        :title="__('admin/orders.app_menu_status_1')"
        icon="fas fa-bolt"
        bg="p"
        :url="route('admin.ShopOrders.New.index')"
    />
    <x-admin.dashboard.color-card
        :count="$card['order_state_2']"
        :title="__('admin/orders.app_menu_status_2')"
        icon="fas fa-wrench"
        bg="i"
        :url="route('admin.ShopOrders.Pending.index')"
    />

    <x-admin.dashboard.color-card
        :count="$card['order_state_3']"
        :title="__('admin/orders.app_menu_status_3')"
        icon="fas fa-thumbs-up"
        bg="s"
        :url="route('admin.ShopOrders.Recipient.index')"
    />

    <x-admin.dashboard.color-card
        :count="$card['order_state_4']"
        :title="__('admin/orders.app_menu_status_4')"
        icon="fas fa-times-circle"
        bg="d"
        :url="route('admin.ShopOrders.Rejected.index')"
    />
</div>


