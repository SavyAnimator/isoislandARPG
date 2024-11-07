@extends('galleries.layout')

@section('gallery-title') Home @endsection

@section('gallery-content')
{{--{!! breadcrumbs(['Gallery' => 'gallery']) !!}--}}

<h1>
    @if (Config::get('lorekeeper.extensions.show_all_recent_submissions.enable') && Config::get('lorekeeper.extensions.show_all_recent_submissions.links.indexbutton'))
        <div class="float-right">
            <a class="btn btn-primary" href="gallery/all">
                View Recent Submissions
            </a>
        </div>
    @endif
    Art Gallery
</h1>
<small><p>The gallery holds all artwork and literature submitted by players of the ARPG. Submitting to the art gallery is the main way to earn the in-game currency, seashells <img src="{{ asset('images/data/currencies/1-icon.png') }}"/>.<br>You can learn more about <a href="/info/currency">earning seashells here</a>.</p></small>

@if($galleries->count())
    {!! $galleries->render() !!}

    @foreach($galleries as $gallery)
        <div class="card mb-3">
            <div class="card-header">
                <h4 style="margin-bottom: .0rem;">
                    {!! $gallery->displayName !!}
                    @if(Auth::check() && $gallery->canSubmit(Auth::user())) <a href="{{ url('gallery/submit/'.$gallery->id) }}" class="btn btn-primary float-right">Submit <i class="fas fa-plus"></i></a> @endif
                </h4>
                @if($gallery->children->count() || (isset($gallery->start_at) || isset($gallery->end_at)))
                    <p>
                        @if(isset($gallery->start_at) || isset($gallery->end_at))
                            @if($gallery->start_at)
                                <strong>Open{{ $gallery->start_at->isFuture() ? 's' : 'ed' }}: </strong>{!! pretty_date($gallery->start_at) !!}
                            @endif
                            {{ $gallery->start_at && $gallery->end_at ? ' ・ ' : '' }}
                            @if($gallery->end_at)
                                <strong>Close{{ $gallery->end_at->isFuture() ? 's' : 'ed' }}: </strong>{!! pretty_date($gallery->end_at) !!}
                            @endif
                        @endif
                        {{ $gallery->children->count() && (isset($gallery->start_at) || isset($gallery->end_at)) ? ' ・ ' : '' }}
                        @if($gallery->children->count())
                            Sub-galleries:
                            @foreach($gallery->children()->visible()->get() as $count=>$child)
                                {!! $child->displayName !!}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        @endif
                    </p>
                @endif
            </div>
            <div class="card-body">
                @if($gallery->submissions->where('status', 'Accepted')->count())
                    <div class="row">
                        @foreach($gallery->submissions->where('is_visible', 1)->where('status', 'Accepted')->take(6) as $submission)
                            <div class="col-md-2 text-center align-self-center">
                                @include('galleries._thumb', ['submission' => $submission, 'gallery' => true])
                            </div>
                        @endforeach
                    </div>
                    @if($gallery->submissions->where('status', 'Accepted')->count() > 6)
                        <div class="text-right"><a href="{{ url('gallery/'.$gallery->id) }}">See More...</a></div>
                    @endif
                @elseif($gallery->children->count() && App\Models\Gallery\GallerySubmission::whereIn('gallery_id', $gallery->children->pluck('id')->toArray())->where('is_visible', 1)->where('status', 'Accepted')->count())
                    <div class="row">
                        @foreach(App\Models\Gallery\GallerySubmission::whereIn('gallery_id', $gallery->children->pluck('id')->toArray())->where('is_visible', 1)->where('status', 'Accepted')->orderBy('created_at', 'DESC')->get()->take(6) as $submission)
                            <div class="col-md-2 text-center align-self-center">
                                @include('galleries._thumb', ['submission' => $submission, 'gallery' => false])
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>This gallery has no submissions!</p>
                @endif
            </div>
        </div>
    @endforeach

    {!! $galleries->render() !!}
@else
    <p>There aren't any galleries!</p>
@endif

@endsection
