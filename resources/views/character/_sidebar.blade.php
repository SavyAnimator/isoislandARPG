<ul>
    <!--<li class="sidebar-header"><a href="{{ $character->url }}" class="card-link">{{ $character->slug }}</a></li>-->
    <li class="sidebar-section">
        <div class="sidebar-section-header"> Character {!! $character->fullName !!}</div>
        <div class="sidebar-item"><a href="{{ $character->url }}" class="{{ set_active('character/'.$character->slug) }}">Information</a></div>
        <!--<div class="sidebar-item"><a href="{{ $character->url . '/profile' }}" class="{{ set_active('character/'.$character->slug.'/profile') }}">Profile</a></div>-->
        <div class="sidebar-item"><a href="{{ $character->url . '/inventory' }}" class="{{ set_active('character/'.$character->slug.'/inventory') }}">Inventory</a></div>

        @if((str_contains(url()->current(), '/I'))) {{--Hide content if Isomara species--}}
        @else
            @if($character->image->species->hasDrops && ($character->drops->dropData->isActive || (Auth::check() && Auth::user()->hasPower('manage_characters'))))
            <div class="sidebar-item"><a href="{{ $character->url . '/drops' }}" class="{{ set_active('character/'.$character->slug.'/drops') }}">{{ isset($character->drops->dropData->data['drop_name']) ? $character->drops->dropData->data['drop_name'].'s' : 'Drops' }}</a></div>
            @endif
        @endif
        <div class="sidebar-item"><a href="{{ $character->url . '/ancestors'}}" class="{{ set_active('character/'.$character->slug.'/ancestors') }}">Lineage</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/relatives'}}" class="{{ set_active('character/'.$character->slug.'/relatives') }}">Relatives</a></div>
                {{--<div class="sidebar-item"><a href="{{ $character->url . '/offspring'}}" class="{{ set_active('character/'.$character->slug.'/offspring') }}">Descendants</a></div>--}}
        <!--<div class="sidebar-item"><a href="{{ $character->url . '/bank' }}" class="{{ set_active('character/'.$character->slug.'/bank') }}">Bank</a></div>-->

            @if(Auth::check() && (Auth::user()->isStaff))
            <!--<div class="sidebar-item"><a href="{{ $character->url . '/level-area' }}" class="{{ set_active('character/'.$character->slug.'/level-area') }}">Level Area</a></div>-->
            <div class="sidebar-item"><a href="{{ $character->url . '/stats-area' }}" class="{{ set_active('character/'.$character->slug.'/stats-area') }}">Stats Area</a></div>
            @endif
            <!--<div class="sidebar-item"><a href="{{ $character->url . '/awards' }}" class="{{ set_active('character/'.$character->slug.'/awards') }}">Achievements</a></div>-->
            <div class="sidebar-item"><a href="{{ $character->url . '/status-effects' }}" class="{{ set_active('character/'.$character->slug.'/status-effects') }}">Ailments</a></div>
        <!--@if($character->getLineageBlacklistLevel() < 1)
            <div class="sidebar-item"><a href="{{ $character->url . '/lineage' }}" class="{{ set_active('character/'.$character->slug.'/lineage') }}">Lineage</a></div>
        @endif-->

    </li>

    <li class="sidebar-section">
        <div class="sidebar-section-header">History</div>
        <div class="sidebar-item"><a href="{{ $character->url . '/images' }}" class="{{ set_active('character/'.$character->slug.'/images') }}">Images</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/gallery' }}" class="{{ set_active('character/'.$character->slug.'/gallery') }}">Gallery</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/submissions' }}" class="{{ set_active('character/'.$character->slug.'/submissions') }}">Submissions</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/item-logs' }}" class="{{ set_active('character/'.$character->slug.'/item-logs') }}">Item Logs</a></div>
        <!--<div class="sidebar-item"><a href="{{ $character->url . '/currency-logs' }}" class="{{ set_active('character/'.$character->slug.'/currency-logs') }}">Currency Logs</a></div>-->
    @if(str_contains(url()->current(), '/I' || (str_contains(url()->current(), '/K')))){{--Hide below content unless an Isomara or Kyti species--}}
        <!--<div class="sidebar-item"><a href="{{ $character->url . '/level' }}" class="{{ set_active('character/'.$character->slug.'/level') }}">Level Logs</a></div>-->
        <!--<div class="sidebar-item"><a href="{{ $character->url . '/skill-logs' }}" class="{{ set_active('character/'.$character->slug.'/skill-logs') }}">Skill Logs</a></div>-->
        <div class="sidebar-item"><a href="{{ $character->url . '/status-effect-logs' }}" class="{{ set_active('character/'.$character->slug.'/status-effect-logs') }}">Ailment Logs</a></div>
        <!--<div class="sidebar-item"><a href="{{ $character->url . '/award-logs' }}" class="{{ set_active('character/'.$character->slug.'/award-logs') }}">Achievement Logs</a></div>-->
    @else
    @endif
        <div class="sidebar-item"><a href="{{ $character->url . '/change-log' }}" class="{{ set_active('character/'.$character->slug.'/change-log') }}">Change Log</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/ownership' }}" class="{{ set_active('character/'.$character->slug.'/ownership') }}">Ownership History</a></div>
    </li>
    @if(Auth::check() && (Auth::user()->id == $character->user_id || Auth::user()->hasPower('manage_characters')))
        <li class="sidebar-section">
            <div class="sidebar-section-header">Settings</div>
            <!--<div class="sidebar-item"><a href="{{ $character->url . '/profile/edit' }}" class="{{ set_active('character/'.$character->slug.'/profile/edit') }}">Edit Profile</a></div>-->
            <div class="sidebar-item"><a href="{{ $character->url . '/transfer' }}" class="{{ set_active('character/'.$character->slug.'/transfer') }}">Transfer</a></div>
            @if(Auth::user()->id == $character->user_id)
                <div class="sidebar-item"><a href="{{ $character->url . '/approval' }}" class="{{ set_active('character/'.$character->slug.'/approval') }}">Update Design</a></div>
            @endif
        </li>
    @endif
</ul>
