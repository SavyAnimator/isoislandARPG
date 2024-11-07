@if($pet)
    {!! Form::open(['url' => 'admin/data/pets/delete/'.$pet->id]) !!}

    <p>You are about to delete the critter <strong>{{ $pet->name }}</strong>. This is not reversible. If this critter exists in at least one user's possession, you will not be able to delete this critter.</p>
    <p>Are you sure you want to delete <strong>{{ $pet->name }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Critter', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
@else
    Invalid pet selected.
@endif
