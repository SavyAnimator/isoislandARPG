<?php

namespace App\Http\Controllers\Characters;

use Illuminate\Http\Request;

use DB;
use Auth;
use Route;
use Settings;
use App\Models\User\User;
use App\Models\Character\Character;
use App\Models\Level\CharacterLevel;
use App\Models\Species\Species;
use App\Models\Rarity;
use App\Models\Feature\Feature;
use App\Models\Character\CharacterProfile;
use App\Models\Character\CharacterLineage;

use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyLog;
use App\Models\User\UserCurrency;
use App\Models\Gallery\GallerySubmission;
use App\Models\Character\CharacterCurrency;

use App\Models\Item\Item;
use App\Models\Item\ItemCategory;
use App\Models\User\UserItem;
use App\Models\Character\CharacterItem;
use App\Models\Item\ItemLog;
use App\Models\Character\CharacterDrop;

use App\Models\Award\Award;
use App\Models\Award\AwardCategory;
use App\Models\User\UserAward;
use App\Models\Award\AwardLog;
use App\Models\Character\CharacterAward;

use App\Models\Character\CharacterTransfer;
use App\Models\Character\CharacterLink;

use App\Services\CurrencyManager;
use App\Services\InventoryManager;
use App\Services\AwardCaseManager;
use App\Services\CharacterManager;
use App\Services\DesignUpdateManager;

use App\Http\Controllers\Controller;
use App\Models\Status\StatusEffect;

use App\Models\Skill\Skill;
class CharacterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Character Controller
    |--------------------------------------------------------------------------
    |
    | Handles displaying and acting on a character.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $slug = Route::current()->parameter('slug');
            $query = Character::myo(0)->where('slug', $slug);
            if(!(Auth::check() && Auth::user()->hasPower('manage_characters'))) $query->where('is_visible', 1);
            $this->character = $query->first();
            if(!$this->character) abort(404);

            $this->character->updateOwner();
            if(!$this->character->level) {
                $this->character->level()->create([
                    'character_id' => $this->character->id
                ]);
            }
            return $next($request);
        });
    }

    /**
     * Shows a character's masterlist entry.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacter($slug)
    {
        return view('character.character', [
            'character' => $this->character,
            'skills' => Skill::where('parent_id', null)->orderBy('name', 'ASC')->get(),
            'drops' => $this->character->drops,
            'parent' => CharacterLink::where('child_id', $this->character->id)->orderBy('parent_id', 'ASC')->first(),
            'children' => CharacterLink::where('parent_id', $this->character->id)->orderBy('child_id', 'ASC')->get(),
            'gallerySubmissions' => GallerySubmission::whereIn('id', $this->character->gallerySubmissions->pluck('gallery_submission_id')->toArray())->visible()->accepted()->orderBy('created_at', 'DESC')->take(6),
        ]);
    }

    /**
     * Shows a character's profile.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterProfile($slug)
    {
        return view('character.profile', [
            'character' => $this->character,
        ]);
    }

    /**
     * Shows a character's edit profile page.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditCharacterProfile($slug)
    {
        if(!Auth::check()) abort(404);

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if(!$isMod && !$isOwner) abort(404);

        return view('character.edit_profile', [
            'character' => $this->character,
        ]);
    }

    /**
     * Edits a character's profile.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @param  string                         $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditCharacterProfile(Request $request, CharacterManager $service, $slug)
    {
        if(!Auth::check()) abort(404);

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if(!$isMod && !$isOwner) abort(404);

        $request->validate(CharacterProfile::$rules);

        if($service->updateCharacterProfile($request->only(['name', 'link', 'text', 'gender_identity', 'personal_pronouns', 'is_gift_art_allowed', 'is_gift_writing_allowed', 'is_trading',  'is_training', 'is_explore', 'chara_height', 'alert_user', 'is_condensed']), $this->character, Auth::user(), !$isOwner)) {
            flash('Profile edited successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Shows a character's gallery.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  string                         $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterGallery(Request $request, $slug)
    {
        return view('character.gallery', [
            'character' => $this->character,
            'submissions' => GallerySubmission::whereIn('id', $this->character->gallerySubmissions->pluck('gallery_submission_id')->toArray())->visible()->accepted()->orderBy('created_at', 'DESC')->paginate(20)->appends($request->query()),
        ]);
    }

    /**
     * Shows a character's images.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterImages($slug)
    {
        return view('character.images', [
            'user' => Auth::check() ? Auth::user() : null,
            'character' => $this->character,
        ]);
    }

    /**
     * Shows a character's inventory.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterInventory($slug)
    {
        $categories = ItemCategory::where('is_character_owned', '1')->orderBy('sort', 'DESC')->get();
        $itemOptions = Item::whereIn('item_category_id', $categories->pluck('id'));

        $items = count($categories) ?
            $this->character->items()
                ->where('count', '>', 0)
                ->orderByRaw('FIELD(item_category_id,'.implode(',', $categories->pluck('id')->toArray()).')')
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['item_category_id', 'id']) :
            $this->character->items()
                ->where('count', '>', 0)
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['item_category_id', 'id']);
        return view('character.inventory', [
            'character' => $this->character,
            'categories' => $categories->keyBy('id'),
            'items' => $items,
            'logs' => $this->character->getItemLogs(),
            ] + (Auth::check() && (Auth::user()->hasPower('edit_inventories') || Auth::user()->id == $this->character->user_id) ? [
                'itemOptions' => $itemOptions->pluck('name', 'id'),
                'userInventory' => UserItem::with('item')->whereIn('item_id', $itemOptions->pluck('id'))->whereNull('deleted_at')->where('count', '>', '0')->where('user_id', Auth::user()->id)->get()->filter(function($userItem){return $userItem->isTransferrable == true;})->sortBy('item.name'),
                'page' => 'character'
            ] : []));
    }

    /**
     * Shows a character's bank.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterBank($slug)
    {
        $character = $this->character;
        return view('character.bank', [
            'character' => $this->character,
            'currencies' => $character->getCurrencies(true),
            'logs' => $this->character->getCurrencyLogs(),
        ] + (Auth::check() && Auth::user()->id == $this->character->user_id ? [
            'takeCurrencyOptions' => Currency::where('allow_character_to_user', 1)->where('is_user_owned', 1)->where('is_character_owned', 1)->whereIn('id', CharacterCurrency::where('character_id', $this->character->id)->pluck('currency_id')->toArray())->orderBy('sort_character', 'DESC')->pluck('name', 'id')->toArray(),
            'giveCurrencyOptions' => Currency::where('allow_user_to_character', 1)->where('is_user_owned', 1)->where('is_character_owned', 1)->whereIn('id', UserCurrency::where('user_id', Auth::user()->id)->pluck('currency_id')->toArray())->orderBy('sort_user', 'DESC')->pluck('name', 'id')->toArray(),

        ] : []) + (Auth::check() && (Auth::user()->hasPower('edit_inventories') || Auth::user()->id == $this->character->user_id) ? [
            'currencyOptions' => Currency::where('is_character_owned', 1)->orderBy('sort_character', 'DESC')->pluck('name', 'id')->toArray(),
        ] : []));
    }

    /**
     * Shows a character's levels
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterLevel($name)
    {
        return view('character.stats.level', [
            'character' => $this->character,
            'exps' => $this->character->getExpLogs(),
            'levels' => $this->character->getLevelLogs(),
            'stats' => $this->character->getStatLogs(),
            'counts' => $this->character->getCountLogs(),
        ]);
    }

    /**
     * Shows a character's awards.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getCharacterAwards($slug)
    {
        $categories = AwardCategory::orderBy('sort', 'DESC')->get();
        $awardOptions = Award::where('is_character_owned', '1');

        $awards = count($categories) ?
            $this->character->awards()
                ->where('count', '>', 0)
                ->orderByRaw('FIELD(award_category_id,'.implode(',', $categories->pluck('id')->toArray()).')')
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['award_category_id', 'id']) :
            $this->character->awards()
                ->where('count', '>', 0)
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['award_category_id', 'id']);
        return view('character.awards', [
            'character' => $this->character,
            'categories' => $categories->keyBy('id'),
            'awards' => $awards,
            'logs' => $this->character->getAwardLogs(),
            ] + (Auth::check() && (Auth::user()->hasPower('edit_inventories') || Auth::user()->id == $this->character->user_id) ? [
                'awardOptions' => $awardOptions->pluck('name', 'id'),
                'page' => 'character'
            ] : []));
    }

    /**
     * Shows a character's status effects.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterStatusEffects($slug)
    {
        $character = $this->character;
        return view('character.status_effects', [
            'character' => $this->character,
            'statuses' => $character->getStatusEffects(),
            'logs' => $this->character->getStatusEffectLogs(),
        ] + (Auth::check() && (Auth::user()->hasPower('edit_inventories') || Auth::user()->id == $this->character->user_id) ? [
            'statusOptions' => StatusEffect::orderBy('name', 'DESC')->pluck('name', 'id')->toArray(),
        ] : []));
    }

    /**
     * Transfers currency between the user and character.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @param  string                         $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCurrencyTransfer(Request $request, CurrencyManager $service, $slug)
    {
        if(!Auth::check()) abort(404);

        $action = $request->get('action');
        $sender = ($action == 'take') ? $this->character : Auth::user();
        $recipient = ($action == 'take') ? Auth::user() : $this->character;

        if($service->transferCharacterCurrency($sender, $recipient, Currency::where(($action == 'take') ? 'allow_character_to_user' : 'allow_user_to_character', 1)->where('id', $request->get(($action == 'take') ? 'take_currency_id' : 'give_currency_id'))->first(), $request->get('quantity'))) {
            flash('Currency transferred successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Handles inventory item processing, including transferring items between the user and character.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @param  string                         $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postInventoryEdit(Request $request, InventoryManager $service, $slug)
    {
        if(!Auth::check()) abort(404);
        switch($request->get('action')) {
            default:
                flash('Invalid action selected.')->error();
                break;
            case 'give':
                $sender = Auth::user();
                $recipient = $this->character;

                if($service->transferCharacterStack($sender, $recipient, UserItem::find($request->get('stack_id')), $request->get('stack_quantity'), Auth::user())) {
                    flash('Item transferred successfully.')->success();
                }
                else {
                    foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
                }
                break;
            case 'name':
                return $this->postName($request, $service);
                break;
            case 'delete':
                return $this->postDelete($request, $service);
                break;
            case 'take':
                return $this->postItemTransfer($request, $service);
                break;
        }

        return redirect()->back();
    }

    /**
     * Handles inventory award processing, including transferring awards between the user and character.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @param  string                         $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAwardEdit(Request $request, AwardCaseManager $service, $slug)
    {
        // TODO: THIS
        if(!Auth::check()) abort(404);
        switch($request->get('action')) {
            default:
                flash('Invalid action selected.')->error();
                break;
            case 'give':
                $sender = Auth::user();
                $recipient = $this->character;

                if($service->transferCharacterStack($sender, $recipient, UserAward::find($request->get('stack_id')), $request->get('stack_quantity'))) {
                    flash('Award transferred successfully.')->success();
                }
                else {
                    foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
                }

                break;
            case 'delete':
                return $this->postDeleteAward($request, $service);
                break;
            case 'take':
                return $this->postAwardTransfer($request, $service);
                break;
        }

        return redirect()->back();
    }

    /**
     * Transfers inventory items back to a user.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\InventoryManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postItemTransfer(Request $request, InventoryManager $service)
    {
        if($service->transferCharacterStack($this->character, $this->character->user, CharacterItem::find($request->get('ids')), $request->get('quantities'), Auth::user())) {
            flash('Item transferred successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Transfers inventory awards back to a user.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\InventoryManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postAwardTransfer(Request $request, AwardCaseManager $service)
    {
        if($service->transferCharacterStack($this->character, $this->character->user, CharacterAward::find($request->get('ids')), $request->get('quantities'))) {
            flash('Award transferred successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Names an inventory stack.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postName(Request $request, InventoryManager $service)
    {
        if($service->nameStack($this->character, CharacterItem::find($request->get('ids')), $request->get('stack_name'), Auth::user())) {
            flash('Item named successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Deletes an inventory stack.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postDelete(Request $request, InventoryManager $service)
    {
        if($service->deleteStack($this->character, CharacterItem::find($request->get('ids')), $request->get('quantities'), Auth::user())) {
            flash('Item deleted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
    /**
     * Deletes an award stack.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postDeleteAward(Request $request, AwardCaseManager $service)
    {
        if($service->deleteStack($this->character, CharacterAward::find($request->get('ids')), $request->get('quantities'))) {
            flash('Award deleted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Shows a character's drops page.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterDrops($slug)
    {
        if(!$this->character->image->species->hasDrops || (!$this->character->drops->dropData->isActive && (!Auth::check() || !Auth::user()->hasPower('manage_characters')))) abort(404);
        return view('character.drops', [
            'character' => $this->character,
            'drops' => $this->character->drops,
            'parent' => CharacterLink::where('child_id', $this->character->id)->orderBy('parent_id', 'ASC')->first(),
            'children' => CharacterLink::where('parent_id', $this->character->id)->orderBy('child_id', 'ASC')->get(),
        ]);
    }



    /**
     * Claims character drops.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\InventoryManager  $service
     * @param  string                         $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postClaimCharacterDrops(Request $request, InventoryManager $service, $slug)
    {
        if(!Auth::check()) abort(404);
        if($this->character->user_id != Auth::user()->id) abort(404);
        $drops = $this->character->drops;
        if(!$drops) abort(404);

        if($service->claimCharacterDrops($this->character, $this->character->user, $this->character->drops)) {
            flash('Drops claimed successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Shows a character's currency logs.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterCurrencyLogs($slug)
    {
        return view('character.currency_logs', [
            'character' => $this->character,
            'logs' => $this->character->getCurrencyLogs(0)
        ]);
    }

    /**
     * Shows a character's status effect logs.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterStatusEffectLogs($slug)
    {
        return view('character.status_effect_logs', [
            'character' => $this->character,
            'logs' => $this->character->getStatusEffectLogs(0)
        ]);
    }

    /**
     * Shows a character's item logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterItemLogs($slug)
    {
        return view('character.item_logs', [
            'character' => $this->character,
            'logs' => $this->character->getItemLogs(0)
        ]);
    }

    /**
     * Shows a character's item logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterExpLogs($slug)
    {
        $character = $this->character;
        return view('character.stats.exp_logs', [
            'character' => $this->character,
            'logs' => $this->character->getExpLogs(0)
        ]);
    }

    /**
     * Shows a user's stat logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterStatLogs($slug)
    {
        $character = $this->character;
        return view('character.stats.stat_logs', [
            'character' => $this->character,
            'logs' => $this->character->getStatLogs(0)
        ]);
    }

    /**
     * Shows a user's level logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterLevelLogs($slug)
    {
        $character = $this->character;
        return view('character.stats.level_logs', [
            'character' => $this->character,
            'logs' => $this->character->getLevelLogs(0)
        ]);
    }

    /**
     * Shows a user's count logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterCountLogs($slug)
    {
        $character = $this->character;
        return view('character.stats.count_logs', [
            'character' => $this->character,
            'logs' => $this->character->getCountLogs(0)
        ]);
    }

    /**
     * Shows a character's award logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function getCharacterAwardLogs($slug)
    {
        return view('character.award_logs', [
            'character' => $this->character,
            'logs' => $this->character->getAwardLogs(0)
        ]);
    }

    /**
     * Shows a character's ownership logs.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterOwnershipLogs($slug)
    {
        return view('character.ownership_logs', [
            'character' => $this->character,
            'logs' => $this->character->getOwnershipLogs(0)
        ]);
    }

    /**
     * Shows a character's ownership logs.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterLogs($slug)
    {
        return view('character.character_logs', [
            'character' => $this->character,
            'logs' => $this->character->getCharacterLogs()
        ]);
    }

    /**
     * Shows a character's submissions.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterSubmissions($slug)
    {
        return view('character.submission_logs', [
            'character' => $this->character,
            'logs' => $this->character->getSubmissions()
        ]);
    }

    /**
     * Shows a character's skill logs.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterSkillLogs($slug)
    {
        return view('character.character_skill_logs', [
            'character' => $this->character,
            'logs' => $this->character->getCharacterSkillLogs()
        ]);
    }

    /**
     * Shows a character's transfer page.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTransfer($slug)
    {
        if(!Auth::check()) abort(404);

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if(!$isMod && !$isOwner) abort(404);

        $parent = CharacterLink::where('child_id', $this->character->id)->orderBy('parent_id', 'DESC')->first();
        if($parent) $parent = $parent->parent->id;

        return view('character.transfer', [
            'character' => $this->character,
            'transfer' => CharacterTransfer::active()->where('character_id', $this->character->id)->first(),
            'cooldown' => Settings::get('transfer_cooldown'),
            'transfersQueue' => Settings::get('open_transfers_queue'),
            'userOptions' => User::visible()->orderBy('name')->pluck('name', 'id')->toArray(),
            'parent' => $parent,
            'characterOptions' => [null => 'Unbound'] + Character::visible()->myo(0)->orderBy('slug','ASC')->get()->pluck('fullName','id')->toArray()
        ]);
    }

    /**
     * Opens a transfer request for a character.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @param  string                         $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTransfer(Request $request, CharacterManager $service, $slug)
    {
        if(!Auth::check()) abort(404);

        $parent = CharacterLink::where('child_id', $this->character->id)->first();
        $child = CharacterLink::where('parent_id', $this->character->id)->first();
        if($parent && $child) $mutual = CharacterLink::where('child_id', $parent->parent->id)->where('parent_id', $this->character->id)->first();
        if($parent && !isset($mutual)) {
            flash('This character is bound and cannot be transfered. You must transfer the character it is bound to.')->error();
            return redirect()->back();
        }
        if($service->createTransfer($request->only(['recipient_id', 'user_reason']), $this->character, Auth::user())) {
            flash('Transfer request created successfully.')->success();
            if($child) flash('This character has attachments that will be transferred with it.')->warning();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Cancels a transfer request for a character.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @param  string                         $slug
     * @param  int                            $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCancelTransfer(Request $request, CharacterManager $service, $slug, $id)
    {
        if(!Auth::check()) abort(404);

        if($service->cancelTransfer(['transfer_id' => $id], Auth::user())) {
            flash('Transfer cancelled.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Shows a character's design update approval page.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterApproval($slug)
    {
        if(!Auth::check() || $this->character->user_id != Auth::user()->id) abort(404);

        return view('character.update_form', [
            'character' => $this->character,
            'queueOpen' => Settings::get('is_design_updates_open'),
            'request' => $this->character->designUpdate()->active()->first()
        ]);
    }

    /**
     * Opens a new design update approval request for a character.
     *
     * @param  App\Services\DesignUpdateManager  $service
     * @param  string                            $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCharacterApproval($slug, DesignUpdateManager $service)
    {
        if(!Auth::check() || $this->character->user_id != Auth::user()->id) abort(404);

        if($request = $service->createDesignUpdateRequest($this->character, Auth::user())) {
            flash('Successfully created new design update request draft.')->success();
            return redirect()->to($request->url);
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}
