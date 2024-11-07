<div class="row world-entry">
    @if ($species->speciesImageUrl)
        <div class="col-md-3 world-entry-image">
            <a href="{{ $species->speciesImageUrl }}" data-lightbox="entry" data-title="{{ $species->name }}">
                <img src="{{ $species->speciesImageUrl }}" class="world-entry-image" alt="{{ $species->name }}" />
            </a>
        </div>
    @endif
    <div class="{{ $species->speciesImageUrl ? 'col-md-9' : 'col-12' }}">
        <x-admin-edit title="Species" :object="$species" />
        <h3>
            @if (!$species->is_visible)
                <i class="fas fa-eye-slash mr-1"></i>
            @endif
            {!! $species->displayName !!}
        </h3>
        <a href="{{ $species->MasterlistSearch }}">
            <strong>View Species Masterlist</strong>
        </a><br>
        @if (count($species->features) && Config::get('lorekeeper.extensions.species_trait_index.enable'))
            <a href="{{ $species->visualTraitsUrl }}">
                <strong>View Visual Trait Index</strong>
            </a>
        @endif
        @if (count($species->subtypes))
            <div>
                <strong>Breeds: </strong>
                @foreach ($species->subtypes as $count => $subtype)
                    {!! $subtype->displayName !!}{{ $count < $species->subtypes->count() - 1 ? ', ' : '' }}
                @endforeach
            </div>
        @endif
        <div class="world-entry-text">
            {!! $species->parsed_description !!}
        </div>
    </div>
</div>
