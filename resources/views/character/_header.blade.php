{{--<div class="character-masterlist-categories">
    @if(!$character->is_myo_slot)
        {!! $character->category->displayName !!} ・ {!! $character->image->species->displayName !!} ・ {!! $character->image->rarity->displayName !!}
    @else
        MYO Slot @if($character->image->species_id) ・ {!! $character->image->species->displayName !!}@endif @if($character->image->rarity_id) ・ {!! $character->image->rarity->displayName !!}@endif
        @endif
</div>--}}

<h1 class="mb-0">
    @if (Config::get('lorekeeper.extensions.character_status_badges'))
        <!-- character trade/gift status badges -->
        <div class="float-right">
            <span class="btn {{ $character->is_trading ? 'badge-ilgreen' : 'badge-ilorange' }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_trading ? 'OPEN for sale and trade offers.' : 'CLOSED for sale and trade offers.' }}"><i class="fas fa-comments-dollar"></i></span>
			<span class="btn {{ $character->is_giftable ? 'badge-ilgreen' : 'badge-ilorange' }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_giftable ? 'CAN be gifted.' : 'CANNOT be gifted.' }}"><i class="fas fa-gift"></i></i></span>
			<span class="btn {{ $character->is_tradeable ? 'badge-ilgreen' : 'badge-ilorange' }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_tradeable ? 'CAN be traded.' : 'CANNOT be traded.' }}"><i class="fas fa-exchange-alt"></i></i></span>
			<span class="btn {{ $character->is_sellable ? 'badge-ilgreen' : 'badge-ilorange' }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_sellable ? 'CAN be sold.' : 'CANNOT be sold.' }}"><i class="fas fa-coins"></i></i></span>
            @if(!$character->is_myo_slot)
                <span class="btn {{ $character->is_gift_writing_allowed == 1 ? 'badge-ilgreen' : ($character->is_gift_writing_allowed == 2 ? 'badge-ilyellow text-light' : 'badge-ilorange') }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_gift_writing_allowed == 1 ? 'OPEN for gift writing.' : ($character->is_gift_writing_allowed == 2 ? 'PLEASE ASK before gift writing.' : 'CLOSED for gift writing.') }}"><i class="fas fa-scroll"></i></span>
                <span class="btn {{ $character->is_gift_art_allowed == 1 ? 'badge-ilgreen' : ($character->is_gift_art_allowed == 2 ? 'badge-ilyellow text-light' : 'badge-ilorange') }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_gift_art_allowed == 1 ? 'OPEN for gift art.' : ($character->is_gift_art_allowed == 2 ? 'PLEASE ASK before gift art.' : 'CLOSED for gift art.') }}"><i class="fas fa-paint-brush"></i></span>
            @else
                <span class="btn {{ $character->is_gift_writing_allowed == 1 ? 'badge-ilgreen' : ($character->is_gift_writing_allowed == 2 ? 'badge-ilyellow text-light' : 'badge-ilorange') }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_gift_writing_allowed == 1 ? 'OPEN for gift writing.' : ($character->is_gift_writing_allowed == 2 ? 'PLEASE ASK before gift writing.' : 'CLOSED for gift writing.') }}"><i class="fas fa-scroll"></i></span>
                <span class="btn {{ $character->is_gift_art_allowed == 1 ? 'badge-ilgreen' : ($character->is_gift_art_allowed == 2 ? 'badge-ilyellow text-light' : 'badge-ilorange') }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_gift_art_allowed == 1 ? 'OPEN for gift art.' : ($character->is_gift_art_allowed == 2 ? 'PLEASE ASK before gift art.' : 'CLOSED for gift art.') }}"><i class="fas fa-paint-brush"></i></span>
            @endif
            @if (($character->image->species_id) == 1 || ($character->image->species_id) == 6) {{--Hide below content unless an Isomara or Kyti species--}}
            <span class="btn {{ $character->is_training == 1 ? 'badge-ilgreen' : ($character->is_training == 2 ? 'badge-ilyellow text-light' : 'badge-ilorange') }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_training == 1 ? 'YES, can be trained by others.' : ($character->is_training == 2 ? 'PLEASE ASK before training.' : 'NO, cannot be trained by others.') }}"><i class="fas fa-dumbbell"></i></span>
            @else
            @endif
            <span class="btn {{ $character->is_explore == 1 ? 'badge-ilgreen' : ($character->is_explore == 2 ? 'badge-ilyellow text-light' : 'badge-ilorange') }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_explore == 1 ? 'YES, allowed to be included in explorations.' : ($character->is_explore == 2 ? 'PLEASE ASK before using in explorations.' : 'NO, cannot be included in explorations by others.') }}"><i class="fas fa-hiking"></i></span>
        </div>
    @endif

    {{--@if($character->is_visible && Auth::check() && $character->user_id != Auth::user()->id)
        <?php $bookmark = Auth::user()->hasBookmarked($character); ?>
        <a href="#" class="btn btn-outline-info float-right bookmark-button ml-2" data-id="{{ $bookmark ? $bookmark->id : 0 }}" data-character-id="{{ $character->id }}"><i class="fas fa-bookmark"></i> {{ $bookmark ? 'Edit Bookmark' : 'Bookmark' }}</a>
    @endif--}}
    @if(Config::get('lorekeeper.extensions.character_TH_profile_link') && $character->profile->link)
            <a class="btn btn-outline-info float-right" data-character-id="{{ $character->id }}" href="{{ $character->profile->link }}"><i class="fas fa-home"></i> Profile</a>
        @endif
    @if(!$character->is_visible) <i class="fas fa-eye-slash"></i> @endif {!! $character->displayName !!}<i id="copy" style="font-size: 18px; vertical-align: middle; margin-left: 10px; margin-bottom: 7px" class="far fa-clipboard text-small" data-toggle="tooltip" title="Click to copy Character ID to clipboard"></i>
    @if (Auth::check() && Auth::user()->isstaff)
        <div class="btn btn-sm">[{{ $character->id }}]</div>
    @endif
</h1>

@if(Auth::check() && Auth::user()->hasPower('manage_characters'))
<div class="mt-3">
    <a href="#" class="btn btn-outline-info float-right btn-sm edit-stats" data-{{ $character->is_myo_slot ? 'id' : 'slug' }}="{{ $character->is_myo_slot ? $character->id : $character->slug }}"><i class="fas fa-cog"></i> Edit</a>
</div>
@endif

@if(!$character->is_myo_slot)
	<div class="mb-3">
    Owner: {!! $character->displayOwner !!} <!--| Category {!! $character->category->displayName !!}-->
	</div>
@else
	<div class="mb-3">
    Owner: {!! $character->displayOwner !!}
	</div>
@endif
<script>
 $('#copy').on('click', async (e) => {
    await window.navigator.clipboard.writeText("{{ $character->slug }}");
    e.currentTarget.classList.remove('far', 'fa-clipboard');
    e.currentTarget.classList.add('fas', 'fa-check');
    setTimeout(() => {
        e.currentTarget.classList.remove('fas', 'fa-check');
        e.currentTarget.classList.add('far', 'fa-clipboard');
    }, 1000);
});
</script>

