@if(count($PeriodicalsNotesRelease)>0)
    <x-admin.card.normal :title="__('admin/Periodicals.dash_most_release')">
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <tbody>
                @foreach($PeriodicalsNotesRelease as $Release)
                    <tr>
                        <td>{{$Release->name}}</td>
                        <td>{{$Release->count}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-admin.card.normal>
@endif

