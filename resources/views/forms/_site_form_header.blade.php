<div class="card-header">
    <h2 class="card-title mb-0">
        @if($form->is_timed && isset($form->end_at) && $form->end_at < Carbon\Carbon::now())[CLOSED] @else [OPEN] @endif
        @if(!$form->is_active || ($form->is_active && $form->is_timed && isset($form->start_at) && $form->start_at > Carbon\Carbon::now()))
        <i class="fas fa-eye-slash mr-1" data-toggle="tooltip" title="This form is hidden."></i>
        @endif
        {!! $form->displayName !!}
    </h2>
    <small>
        Posted {!! $form->post_at ? pretty_date($form->post_at) : pretty_date($form->created_at) !!} {{--:: Last edited {!! pretty_date($form->updated_at) !!} by {!! $form->user->displayName !!}--}}
        <br>
        @if($form->is_timed)
        {{--Open @if($form->startDate) from {!! format_date($form->startDate) !!} @endif--}} @if($form->endDate) Form closes on {!! format_date($form->endDate) !!} @endif
    @endif
    </small>
    <div>
        <span class="badge bg-warning border">
            @if($form->is_anonymous)
            This form is anonymous {!! add_help('Staff will be unable to see your name linked to your answers, however, the site owners may still access this information through the database.') !!}
            @else
            Your answers will be visible to staff. {!! add_help('Staff will be able to easily see your name linked to your answers, but not other members.') !!}
            @endif
        </span>
        <span class="badge bg-light border">
            @if($form->timeframe == 'lifetime')
            Once per user
            @else
            {{ $form->timeframe }} per user
            @endif
        </span>
        <span class="badge bg-light border">
            @if($form->is_editable)
            Editable
            @else
            Not editable
            @endif
        </span>
        <span class="badge bg-light border">
            @if($form->is_public)
            Public
            @else
            Not Public
            @endif
        </span>
        @if($form->rewards->count() > 0)
        <span class="badge bg-light border">
            Grants reward
        </span>
        @endif
    </div>
</div>
