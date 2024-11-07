<?php

namespace App\Http\Controllers\Admin\Data;

use Illuminate\Http\Request;

use Auth;

use App\Models\Item\Item;
use App\Models\Pet\Pet;
use App\Models\Item\ItemCategory;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;

use App\Services\LootService;

use App\Http\Controllers\Controller;

class LootTableController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User / Loot Table Controller
    |--------------------------------------------------------------------------
    |
    | Handles creation/editing of loot tables.
    |
    */

    /**
     * Gets the loot table test roll modal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\LootService  $service
     * @param  int                       $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getQCRollLootTable(Request $request, LootService $service, $id)
    {
        $table = LootTable::find($id);
        if(!$table) abort(404);

        // Normally we'd merge the result tables, but since we're going to be looking at
        // the results of each roll individually on this page, we'll keep them separate
        $results = [];
        for ($i = 0; $i < $request->get('quantity'); $i++)
            $results[] = $table->roll();

        return view('users.loot_tables._roll_loot_table', [
            'table' => $table,
            'results' => $results,
            'quantity' => $request->get('quantity')
        ]);
    }
}
