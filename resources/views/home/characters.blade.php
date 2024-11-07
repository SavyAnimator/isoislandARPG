@extends('home.layout')

@section('home-title') My Characters @endsection

@section('home-content')
{{--{!! breadcrumbs(['My Characters' => 'characters']) !!}--}}

<h1>
    My Characters
</h1>
<p>You can rearrange the order and sort your characters into groups here. Rearrange characters by click and hold then drag the character to a different spot. Grouping characters is optional and by default characters will be listed as Unsettled if not in any specific grouping.</p>

<div class="text-center mb-2">
    <a class="btn btn-primary create-folder mx-1" href="#"><i class="fas fa-plus"></i> Create New Group</a>
    <a class="btn btn-primary edit-folder mx-1" href="#"><i class="fas fa-edit"></i> Edit Group</a>
</div>

<div id="folders" class="collapse text-right">
    <div class="row">
        <div class="form-group col-4">
        </div>
        <div class="form-group col-4">
            <div class="small text-center">{!! Form::label('Select a Group to Edit') !!}</div>
            {!! Form::select('folder_ids[]', $folders, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-1">
            <div style="margin-top:28px" class="edit-get-button btn btn-primary"><i class="fas fa-edit"></i> Edit</a></div>
        </div>
        <div class="form-group col-3">
        </div>

    </div>
</div>
<hr>
{!! Form::open(['url' => 'characters/sort', 'class' => 'text-right']) !!}
<div id="sortable" class="row sortable">
    @foreach($characters as $character)
        <div class="col-md-2 col-6 text-center mb-2" data-id="{{ $character->id }}">
            <div>
                <a href="{{ $character->url }}"><img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" alt="Thumbnail for {{ $character->fullName }}" /></a>
            </div>
            <div class="mt-1 h5">
                {!! $character->displayName !!}
            </div>
            <div class="form-group">
                {{--{!! Form::label('folder_ids[]', 'Group (Optional)') !!}--}}
                {!! Form::select('folder_ids[]', $folders, $character->folder_id, ['class' => 'form-control']) !!}
            </div>
        </div>

    @endforeach
</div>

    {!! Form::hidden('sort', null, ['id' => 'sortableOrder']) !!}
    {!! Form::submit('Save Character Order', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}


@endsection
@section('scripts')
    <script>
        $( document ).ready(function() {

            $('.create-folder').click(function(e){
                e.preventDefault();
                loadModal("{{ url('/characters/folder/create') }}", "Create New Group");
            });

            $('.edit-folder').click(function(e){
                e.preventDefault();
                $('#folders').collapse('toggle');
            });

            $('.edit-get-button').click(function(e){
                e.preventDefault();
                var folder_id = $('#folders select').val();
                var url = "{{ url('/characters/folder/edit') }}/" + folder_id;
                loadModal(url, "Edit Group");
            });

            $( "#sortable" ).sortable({
                characters: '.sort-item',
                placeholder: "sortable-placeholder col-md-3 col-6",
                stop: function( event, ui ) {
                    $('#sortableOrder').val($(this).sortable("toArray", {attribute:"data-id"}));
                },
                create: function() {
                    $('#sortableOrder').val($(this).sortable("toArray", {attribute:"data-id"}));
                }
            });
            $( "#sortable" ).disableSelection();
        });
    </script>
@endsection
