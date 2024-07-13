@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">

                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <x-admin.dashboard.color-card
                            :title="__('admin/Periodicals.dash_book')"
                            :count="$card['bookCount']"
                            icon="fas fa-book"
                            :url="route('admin.Periodicals.index')"/>

                        <x-admin.dashboard.color-card
                            :title="__('admin/Periodicals.dash_book')"
                            bg="s"
                            :count="$card['releaseCount']"
                            icon="fas fa-book-open"/>

                        <x-admin.dashboard.color-card
                            :title="__('admin/Periodicals.app_menu_tags')"
                            bg="i"
                            :count="$card['tagsCount']"
                            :url="route('admin.Periodicals.BookTags.index')"
                            icon="fas fa-hashtag"/>

                        <x-admin.dashboard.color-card
                            :title="__('admin/Periodicals.app_menu_notes')"
                            bg="d"
                            :url="route('admin.Periodicals.Notes.index')"
                            :count="$card['notesCount']"
                            icon="fas fa-lightbulb"/>


                    </div>

                </div>

            </div>
        </div>
    </section>


    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12 mb-lg-3 mb-3">
            </div>
        </div>

        <div class="row">

        </div>
    </x-admin.hmtl.section>
@endsection


@push('JsCode')
@endpush
