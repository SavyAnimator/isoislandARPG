<div class="row">
    @foreach ($relatives as $relative)
        @include('character.lineage._thumb2', ['lineage' => $parent ? $relative->parent : $relative->child])
    @endforeach
</div>

