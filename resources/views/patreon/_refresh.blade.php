{!! Form::open(['url' => 'patreon/refresh']) !!}

<p>You are about to refresh your details. You will not be able to do this for another 24 hours, even if your payment information has updated.</p>
<strong><p>Are you sure you want to refresh?</p></strong>

<div class="text-right">
    {!! Form::submit('Refresh', ['class' => 'btn btn-danger']) !!}
</div>

{!! Form::close() !!}