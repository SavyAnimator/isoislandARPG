<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\Item\Item;
use App\Models\Pet\Pet;
use App\Models\Item\ItemCategory;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;

use App\Services\LootService;

use App\Http\Controllers\Controller;

class GameLootTableController extends Controller
{
    /*
    |---------------------------------------
    | User / Loot Table Controller
    |---------------------------------------
    */

    /**
     * Gets the loot table QCroll modal.
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
