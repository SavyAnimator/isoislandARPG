@extends('admin.layout')

@section('admin-title') Rewards @endsection

@section('admin-content')
{!! breadcrumbs(['Admin Panel' => 'admin', 'Rewards' => 'admin/patreon/rewards', 'Create Rewards' => 'admin/patreon/rewards/edit/'.$id]) !!}

{!! Form::open(['url' => 'admin/patreon/rewards/edit/'.$id]) !!}

<h3>{{ Carbon\Carbon::create()->month($id)->format('F') }} Rewards</h3>
<p>Rewards are credited on a per-user basis on the first of every month. Users who join after the month beginning will also have rewards granted of that month.</p>
<p>You can add loot tables containing any kind of currencies (both user- and character-attached), but be sure to keep track of which are being distributed! Character-only currencies cannot be given to users.</p>
@include('widgets._patreon_loot_select', ['loots' => $rewards, 'showLootTables' => true, 'showRaffles' => true])

<div class="text-right">
    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

@include('widgets._patreon_loot_select_row', ['items' => $items, 'currencies' => $currencies, 'tables' => $tables, 'raffles' => $raffles, 'showLootTables' => true, 'showRaffles' => true])

@endsection

@section('scripts')
@parent
@include('js._patreon_loot_js', ['showLootTables' => true, 'showRaffles' => true])
<script>
    
</script>
@endsection