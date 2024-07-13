@if(count($mostTags)>0)
    <x-admin.card.normal :title="__('admin/Periodicals.dash_most_tags')">
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <tbody>
                @foreach($mostTags as $tag)
                    <tr>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->notes_count}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-admin.card.normal>
@endif

