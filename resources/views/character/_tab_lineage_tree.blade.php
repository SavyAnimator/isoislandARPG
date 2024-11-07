<div class="container text-center">
    <div class="row">
        <div class="col">
            <div class="border-bottom mb-1">
                <span class="font-weight-bold">Mother</span><br>{!! $line['dam'] !!}
            </div>
            <div class="row">
                <div class="col">
                    <div class="border-bottom mb-1">
                        <abbr class="font-weight-bold" title="Mother's Father">MF</abbr><br>{!! $line['dam_sire'] !!}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Mother's Father's Father">MFF</abbr><br>{!! $line['dam_sire_sire'] !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Mother's Father's Mother">MFM</abbr><br>{!! $line['dam_sire_dam'] !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="border-bottom mb-1">
                        <abbr class="font-weight-bold" title="Mother's Mother">MM</abbr><br>{!! $line['dam_dam'] !!}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Mother's Mother's Father">MMF</abbr><br>{!! $line['dam_dam_sire'] !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Mother's Mother's Mother">MMM</abbr><br>{!! $line['dam_dam_dam'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="border-bottom mb-1">
                <span class="font-weight-bold">Father</span><br>{!! $line['sire'] !!}
            </div>
            <div class="row">
                <div class="col">
                    <div class="border-bottom mb-1">
                        <abbr class="font-weight-bold" title="Father's Father">FF</abbr><br>{!! $line['sire_sire'] !!}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Father's Father's Father">FFF</abbr><br>{!! $line['sire_sire_sire'] !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Father's Father's Mother">FFM</abbr><br>{!! $line['sire_sire_dam'] !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="border-bottom mb-1">
                        <abbr class="font-weight-bold" title="Father's Mother">FM</abbr><br>{!! $line['sire_dam'] !!}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Father's Mother's Father">FMF</abbr><br>{!! $line['sire_dam_sire'] !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Father's Mother's Mother">FMM</abbr><br>{!! $line['sire_dam_dam'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
