@if($folder->id)
    <div class="text-right">
        <div class="btn btn-ilorange delete">
            Delete Group
        </div>
    </div>
    <div class="collapse collapse-delete">
        {!! Form::open(['url' => 'characters/folder/delete/'.$folder->id]) !!}

        <p>You are about to delete the group <strong>{{ $folder->name }}</strong>. This is not reversible.</p>
        <p>Are you sure you want to delete <strong>{{ $folder->name }}</strong>?</p>

        <div class="text-right">
            {!! Form::submit('Yes, Delete Group', ['class' => 'btn btn-danger']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endif

{!! Form::open(['url' => 'characters/folder/'. ($folder->id ? 'edit/' . $folder->id : 'create')]) !!}

    <div class="form-group">
        <h5>{!! Form::label('name', 'Name') !!}</h5>
        <small>The group name will be visible to all who view your characters.</small>
        {!! Form::text('name', $folder->name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <h5>{!! Form::label('description', 'Description') !!}</h5>
        <small>The group desctiption is vibile when hovering over the group name when viewing your characters. It is meant to provide a bit of info.</small>
        {!! Form::text('description', $folder->description, ['class' => 'form-control wysiwyg']) !!}
    </div>

{!! Form::submit(($folder->id ? 'Edit' : 'Create') . ' Group', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

<script>
    $( document ).ready(function() {
        $('.delete').click(function() {
            $('.collapse-delete').collapse('toggle');
        });
    });
</script>
