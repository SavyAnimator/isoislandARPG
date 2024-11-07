@if(!$stack)
    <div class="text-center">Invalid accessory selected.</div>
@else
    <div class="text-center">
        <div class="mb-1"><a href="{{ $stack->gear->url }}"><img src="{{ $stack->gear->imageUrl }}" /></a></div>
        <div class="mb-1"><a href="{{ $stack->gear->url }}">{{ $stack->gear->name }}</a></div>
    </div>

    @if(isset($stack->data['notes']) || isset($stack->data['data']))
        <div class="card mt-3">
            <ul class="list-group list-group-flush">
                @if(isset($stack->data['notes']))
                    <li class="list-group-item">
                        <h5 class="card-title">Notes</h5>
                        <div>{!! $stack->data['notes'] !!}</div>
                    </li>
                @endif
                @if(isset($stack->data['data']))
                    <li class="list-group-item">
                        <h5 class="card-title">Source</h5>
                        <div>{!! $stack->data['data'] !!}</div>
                    </li>
                @endif
            </ul>
        </div>
    @endif

    @if($user && !$readOnly && ($stack->user_id == $user->id || $user->hasPower('edit_inventories')))
        <div class="card mt-3">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    @php
                    $now = Carbon\Carbon::parse($stack->attached_at);
                    $diff = $now->addDays(Settings::get('claymore_cooldown'));
                    @endphp
                    @if($stack->character_id != NULL && $diff < Carbon\Carbon::now())
                    <a class="card-title h5 collapse-title"  data-toggle="collapse" href="#attachForm">@if($stack->user_id != $user->id) [ADMIN] @endif Detach Accessory from Character</a>
                    {!! Form::open(['url' => 'accessory/detach/'.$stack->id, 'id' => 'attachForm', 'class' => 'collapse']) !!}
                        <p>This accessory is currently attached to {!! $stack->character->displayName !!}, do you want to detach them?</p>
                        <div class="text-right">
                            {!! Form::submit('Detach', ['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                    @elseif($stack->character_id == NULL || $diff < Carbon\Carbon::now())
                    <a class="card-title h5 collapse-title"  data-toggle="collapse" href="#attachForm">@if($stack->user_id != $user->id) [ADMIN] @endif Attach Accessory to Character</a>
                    {!! Form::open(['url' => 'accessory/attach/'.$stack->id, 'id' => 'attachForm', 'class' => 'collapse']) !!}
                        <p>Attach this accessory to a character you own! They'll appear on the character's page and any stat bonuses will automatically be applied.</p>
                        <p>Accessories can be detached.</p>
                        <div class="form-group">
                            {!! Form::label('id', 'Slug') !!} {!! add_help('Insert your character\'s slug.') !!}
                            {!! Form::select('id', $chara, null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="text-right">
                            {!! Form::submit('Attach', ['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                    @else
                    <a class="card-title h5">You cannot currently attach / detach this accessory! It is under cooldown.</a>
                    @endif
                </li>
                @if($stack->gear->parent_id && $stack->gear->cost && $stack->gear->currency_id <= 0)
                <li class="list-group-item">
                    <a class="card-title h5 collapse-title"  data-toggle="collapse" href="#upgradeForm">@if($stack->user_id != $user->id) [ADMIN] @endif Upgrade Accessory</a>
                    {!! Form::open(['url' => 'accessory/upgrade/'.$stack->id, 'id' => 'upgradeForm', 'class' => 'collapse']) !!}
                        <p class="alert alert-info my-2">This accessory can be upgraded to {!!$stack->gear->parent->displayName !!}!</p>
                        <p>Upgrade costs {{ $stack->gear->cost }}
                        @if($stack->gear->currency_id != 0) <img src="{!! $stack->gear->currency->iconurl !!}"> {!! $stack->gear->currency->displayName !!}. @else stat points. @endif
                        The upgrade cannot be reversed.</p>
                        <div class="text-right">
                            {!! Form::submit('Upgrade', ['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </li>
                @endif
                @if($stack->isTransferrable || $user->hasPower('edit_inventories'))
                    @if(!$stack->character_id)
                    <li class="list-group-item">
                        <a class="card-title h5 collapse-title"  data-toggle="collapse" href="#transferForm">@if($stack->user_id != $user->id) [ADMIN] @endif Transfer Accessory</a>
                        {!! Form::open(['url' => 'accessory/transfer/'.$stack->id, 'id' => 'transferForm', 'class' => 'collapse']) !!}
                            @if(!$stack->isTransferrable)
                                <p class="alert alert-warning my-2">This accessory is account-bound, but your rank allows you to transfer it to another user.</p>
                            @endif
                            <div class="form-group">
                                {!! Form::label('user_id', 'Recipient') !!} {!! add_help('You can only transfer accessories to verified users.') !!}
                                {!! Form::select('user_id', $userOptions, null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="text-right">
                                {!! Form::submit('Transfer', ['class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </li>
                    @else
                    <li class="list-group-item bg-light">
                        <h5 class="card-title mb-0 text-muted"><i class="fas fa-lock mr-2"></i> Currently attached to a character</h5>
                    </li>
                    @endif
                @else
                    <li class="list-group-item bg-light">
                        <h5 class="card-title mb-0 text-muted"><i class="fas fa-lock mr-2"></i> Account-bound</h5>
                    </li>
                @endif
                <li class="list-group-item">
                    <a class="card-title h5 collapse-title"  data-toggle="collapse" href="#deleteForm">@if($stack->user_id != $user->id) [ADMIN] @endif Delete Accessory</a>
                    {!! Form::open(['url' => 'accessory/delete/'.$stack->id, 'id' => 'deleteForm', 'class' => 'collapse']) !!}
                        <p>This action is not reversible. Are you sure you want to delete this accessory?</p>
                        <div class="text-right">
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        </div>
                    {!! Form::close() !!}
                </li>
            </ul>
        </div>
    @endif
@endif
