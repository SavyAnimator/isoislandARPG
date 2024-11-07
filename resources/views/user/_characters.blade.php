<style>
    .h5 {
        font-size: 85%;
    }
</style>

@if($characters->count())
    @foreach($characters as $key => $group)<br>
    <div class="card inventory-category">
        <a href="{{ $group->first()->folder ? $group->first()->folder->url : '#' }}">
            <div class="title"><h4>
                <span data-toggle="tooltip" title="{{ $group->first()->folder ? $group->first()->folder->description : 'Characters yet to be organized into a group.'}}">{{ $key }}</span>
            </h4>
        </div>
        </a>
        <div class="card-body inventory-body">
            <small>{{ $group->first()->folder ? $group->first()->folder->description : 'Characters yet to be organized into a group.'}}</small>
            <div class="row">
                @foreach($group as $character)

                        <div class="col-md-2 col-6 text-center">
                            <div>
                                <a href="{{ $character->url }}"><img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" alt="Thumbnail for {{ $character->fullName }}" /></a>
                            </div>
                            <div class="mt-1">
                                <a href="{{ $character->url }}" class="h5 mb-0">
                                    @if (!$character->is_visible)
                                        <i class="fas fa-eye-slash"></i>
                                    @endif {{ Illuminate\Support\Str::limit($character->fullName, 22, $end = '...') }}
                                </a>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
@else
    <p>No {{ $myo ? 'MYO slots' : 'characters' }} found.</p>
@endif
