<div class="row">
    <x-admin.dashboard.color-card
        :count="$card['bookCount']"
        :title="__('admin/Periodicals.dash_book')"
        icon="fas fa-book"
        bg="p"
        :url="route('admin.Periodicals.index')"
    />

    <x-admin.dashboard.color-card
        :count="$card['releaseCount']"
        :title="__('admin/Periodicals.dash_release')"
        icon="fa fa-book-open"
        bg="s"
    />

    <x-admin.dashboard.color-card
        :count="$card['tagsCount']"
        :title="__('admin/Periodicals.app_menu_tags')"
        icon="fas fa-hashtag"
        bg="i"
        :url="route('admin.Periodicals.BookTags.index')"
    />

    <x-admin.dashboard.color-card
        :count="$card['notesCount']"
        :title="__('admin/Periodicals.app_menu_notes')"
        icon="fas fa-lightbulb"
        bg="d"
        :url="route('admin.Periodicals.Notes.index')"
    />
</div>

