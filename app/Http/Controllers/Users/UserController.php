<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use DB;
use Auth;
use Route;
use App\Models\User\User;

use App\Models\User\UserCurrency;
use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyLog;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GallerySubmission;

use App\Models\User\UserItem;
use App\Models\Item\Item;
use App\Models\Item\ItemCategory;
use App\Models\Item\ItemLog;

use App\Models\User\UserAward;
use App\Models\Award\Award;
use App\Models\Award\AwardCategory;
use App\Models\Award\AwardLog;

use App\Models\Gallery\GalleryFavorite;
use App\Models\Gallery\GalleryCharacter;

use App\Models\Character\CharacterCategory;
use App\Models\Character\CharacterImage;
use App\Models\Character\Character;
use App\Models\Character\CharacterFolder;
use App\Models\Character\Sublist;
use App\Models\User\UserPrizeLog;

use App\Models\User\UserPet;
use App\Models\Pet\Pet;
use App\Models\Pet\PetCategory;
use App\Models\Pet\PetLog;

use App\Models\Claymore\GearCategory;
use App\Models\Claymore\Gear;
use App\Models\User\UserGear;

use App\Models\Claymore\WeaponCategory;
use App\Models\Claymore\Weapon;
use App\Models\User\UserWeapon;

use App\Models\Comment;
use App\Models\Forum;


use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | Displays user profile pages.
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
        $name = Route::current()->parameter('name');
        $this->user = User::where('name', $name)->first();
        if(!$this->user) abort(404);

        $this->user->updateCharacters();
        $this->user->updateArtDesignCredits();
        if(!$this->user->level) {
            $this->user->level()->create([
                'user_id' => $this->user->id
            ]);
        }
    }

    /**
     * Shows a user's profile.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUser($name)
    {
        $characters = $this->user->characters();
        if(!Auth::check() || !(Auth::check() && Auth::user()->hasPower('manage_characters'))) $characters->visible();

        $gears = $this->user->gears()->orderBy('user_gears.updated_at', 'DESC')->take(8)->get();
        $weapons = $this->user->weapons()->orderBy('user_weapons.updated_at', 'DESC')->take(8)->get();
        $armours = $gears->union($weapons);

        return view('user.profile', [
            'user' => $this->user,
            'items' => $this->user->items()->where('count', '>', 0)->orderBy('user_items.updated_at', 'DESC')->take(8)->get(),
            'pets' => $this->user->pets()->orderBy('user_pets.updated_at', 'DESC')->take(8)->get(),
            'awards' => $this->user->awards()->orderBy('user_awards.updated_at', 'DESC')->take(4)->get(),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get(),
            'characters' => $this->user->characters(),
            'isoCharacters' => $this->user->characters()->whereNotBetween('character_category_id',['2','5']),
            'compCharacters' => $this->user->characters()->whereBetween('character_category_id',['2','5']),
            'characters' => $characters,
            'armours' => $armours,
            'gears' => $gears,
            'weapons' => $weapons,
            'gallerySubmissions' => $this->user->gallerySubmissions()->visible()->accepted()->orderBy('created_at', 'DESC')->take(6),
        ]);
    }

    /**
     * Shows a user's aliases.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserAliases($name)
    {
        $aliases = $this->user->aliases();
        if(!Auth::check() || !(Auth::check() && Auth::user()->hasPower('edit_user_info'))) $aliases->visible();

        return view('user.aliases', [
            'user' => $this->user,
            'aliases' => $aliases->orderBy('is_primary_alias', 'DESC')->orderBy('site')->get(),
        ]);
    }

    /**
     * Shows a user's characters.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserCharacters($name)
    {
        $query = Character::myo(0)->where('user_id', $this->user->id);
        $imageQuery = CharacterImage::images(Auth::check() ? Auth::user() : null)->with('features')->with('rarity')->with('species')->with('features');

        if($sublists = Sublist::where('show_main', 0)->get())
        $subCategories = []; $subSpecies = [];
        {   foreach($sublists as $sublist)
            {
                $subCategories = array_merge($subCategories, $sublist->categories->pluck('id')->toArray());
                $subSpecies = array_merge($subSpecies, $sublist->species->pluck('id')->toArray());
            }
        }

        $query->whereNotIn('character_category_id', $subCategories);
        $imageQuery->whereNotIn('species_id', $subSpecies);

        $query->whereIn('id', $imageQuery->pluck('character_id'));

        if(!Auth::check() || !(Auth::check() && Auth::user()->hasPower('manage_characters'))) $query->visible();
        $query = $query->orderBy('sort', 'DESC')->get()
        // group query folder, getting the name from the id
        ->groupBy(function($item) {
            return $item->folder ? $item->folder->name : 'Unsettled';
        });
        return view('user.characters', [
            'user' => $this->user,
            'characters' => $query,
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

        /**
     * Shows a user's characters.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserCharacterFolder($name, $folder)
    {
        $folder = CharacterFolder::where('name', $folder)->where('user_id', $this->user->id)->first();
        $query = Character::myo(0)->where('user_id', $this->user->id)->where('folder_id', $folder->id);
        $imageQuery = CharacterImage::images(Auth::check() ? Auth::user() : null)->with('features')->with('rarity')->with('species')->with('features');

        if($sublists = Sublist::where('show_main', 0)->get())
        $subCategories = []; $subSpecies = [];
        {   foreach($sublists as $sublist)
            {
                $subCategories = array_merge($subCategories, $sublist->categories->pluck('id')->toArray());
                $subSpecies = array_merge($subSpecies, $sublist->species->pluck('id')->toArray());
            }
        }

        $query->whereNotIn('character_category_id', $subCategories);
        $imageQuery->whereNotIn('species_id', $subSpecies);

        $query->whereIn('id', $imageQuery->pluck('character_id'));

        if(!Auth::check() || !(Auth::check() && Auth::user()->hasPower('manage_characters'))) $query->visible();

        return view('user.character_folder', [
            'user' => $this->user,
            'folder' => $folder,
            'characters' => $query->orderBy('sort', 'DESC')->get(),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's sublist characters.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserSublist($name, $key)
    {
        $query = Character::myo(0)->where('user_id', $this->user->id);
        $imageQuery = CharacterImage::images(Auth::check() ? Auth::user() : null)->with('features')->with('rarity')->with('species')->with('features');

        $sublist = Sublist::where('key', $key)->first();
        if(!$sublist) abort(404);
        $subCategories = $sublist->categories->pluck('id')->toArray();
        $subSpecies = $sublist->species->pluck('id')->toArray();

        if($subCategories) $query->whereIn('character_category_id', $subCategories);
        if($subSpecies) $imageQuery->whereIn('species_id', $subSpecies);

        $query->whereIn('id', $imageQuery->pluck('character_id'));

        if(!Auth::check() || !(Auth::check() && Auth::user()->hasPower('manage_characters'))) $query->visible();

        return view('user.sublist', [
            'user' => $this->user,
            'characters' => $query->orderBy('sort', 'DESC')->get(),
            'sublist' => $sublist,
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's MYO slots.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserMyoSlots($name)
    {
        $myo = $this->user->myoSlots();
        if(!Auth::check() || !(Auth::check() && Auth::user()->hasPower('manage_characters'))) $myo->visible();

        return view('user.myo_slots', [
            'user' => $this->user,
            'myos' => $myo->get(),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's inventory.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserInventory($name)
    {
        $categories = ItemCategory::orderBy('sort', 'DESC')->get();
        $items = count($categories) ?
            $this->user->items()
                ->where('count', '>', 0)
                ->orderByRaw('FIELD(item_category_id,'.implode(',', $categories->pluck('id')->toArray()).')')
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['item_category_id', 'id']) :
            $this->user->items()
                ->where('count', '>', 0)
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['item_category_id', 'id']);
        return view('user.inventory', [
            'user' => $this->user,
            'categories' => $categories->keyBy('id'),
            'items' => $items,
            'userOptions' => User::where('id', '!=', $this->user->id)->orderBy('name')->pluck('name', 'id')->toArray(),
            'user' => $this->user,
            'logs' => $this->user->getItemLogs(),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's pets.
     * *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserPets($name)
    {
        $categories = PetCategory::orderBy('sort', 'DESC')->get();
        $pets = count($categories) ? $this->user->pets()->orderByRaw('FIELD(pet_category_id,'.implode(',', $categories->pluck('id')->toArray()).')')->orderBy('name')->orderBy('updated_at')->get()->groupBy('pet_category_id') : $this->user->pets()->orderBy('name')->orderBy('updated_at')->get()->groupBy('pet_category_id');
        return view('user.pet', [
            'user' => $this->user,
            'categories' => $categories->keyBy('id'),
            'pets' => $pets,
            'userOptions' => User::where('id', '!=', $this->user->id)->orderBy('name')->pluck('name', 'id')->toArray(),
            'user' => $this->user,
            'logs' => $this->user->getPetLogs()
        ]);
    }

    /**
    * Shows a user's awardcase.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getUserAwardCase($name)
    {
        $categories = AwardCategory::orderBy('sort', 'DESC')->get();
        $awards = count($categories) ?
            $this->user->awards()
                ->where('count', '>', 0)
                ->orderByRaw('FIELD(award_category_id,'.implode(',', $categories->pluck('id')->toArray()).')')
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['award_category_id', 'id']) :
            $this->user->awards()
                ->where('count', '>', 0)
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['award_category_id', 'id']);
        return view('user.awardcase', [
            'user' => $this->user,
            'categories' => $categories->keyBy('id'),
            'awards' => $awards,
            'userOptions' => User::where('id', '!=', $this->user->id)->orderBy('name')->pluck('name', 'id')->toArray(),
            'user' => $this->user,
            'logs' => $this->user->getAwardLogs(),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's profile.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserBank($name)
    {
        $user = $this->user;
        return view('user.bank', [
            'user' => $this->user,
            'logs' => $this->user->getCurrencyLogs(),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ] + (Auth::check() && Auth::user()->id == $this->user->id ? [
            'currencyOptions' => Currency::where('allow_user_to_user', 1)->where('is_user_owned', 1)->whereIn('id', UserCurrency::where('user_id', $this->user->id)->pluck('currency_id')->toArray())->orderBy('sort_user', 'DESC')->pluck('name', 'id')->toArray(),
            'userOptions' => User::where('id', '!=', Auth::user()->id)->orderBy('name')->pluck('name', 'id')->toArray()
        ] : []));
    }

    /**
     * Shows a user's profile.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserLevel($name)
    {
        return view('user.level', [
            'user' => $this->user,
            'exps' => $this->user->getExpLogs(),
            'levels' => $this->user->getLevelLogs(),
            'stats' => $this->user->getStatLogs(),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's pets.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserArmoury($name)
    {
        $weaponCategories = WeaponCategory::orderBy('sort', 'DESC')->get();
        $gearCategories = GearCategory::orderBy('sort', 'DESC')->get();

        $gears = count($gearCategories) ? $this->user->gears()->orderByRaw('FIELD(gear_category_id,'.implode(',', $gearCategories->pluck('id')->toArray()).')')->orderBy('name')->orderBy('updated_at')->get()->groupBy('gear_category_id') : $this->user->gears()->orderBy('name')->orderBy('updated_at')->get()->groupBy('gear_category_id');
        $weapons = count($weaponCategories) ? $this->user->weapons()->orderByRaw('FIELD(weapon_category_id,'.implode(',', $weaponCategories->pluck('id')->toArray()).')')->orderBy('name')->orderBy('updated_at')->get()->groupBy('weapon_category_id') : $this->user->weapons()->orderBy('name')->orderBy('updated_at')->get()->groupBy('weapon_category_id');
        return view('user.armoury', [
            'user' => $this->user,
            'weaponCategories' => $weaponCategories->keyBy('id'),
            'gearCategories' => $gearCategories->keyBy('id'),
            'weapons' => $weapons,
            'gears' => $gears,
            'userOptions' => User::where('id', '!=', $this->user->id)->orderBy('name')->pluck('name', 'id')->toArray(),
            'user' => $this->user,
            'weaponLogs' => $this->user->getWeaponLogs(),
            'gearLogs' => $this->user->getGearLogs()
        ]);
    }

    /**
     * Shows a user's currency logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserCurrencyLogs($name)
    {
        $user = $this->user;
        return view('user.currency_logs', [
            'user' => $this->user,
            'logs' => $this->user->getCurrencyLogs(0),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's item logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserItemLogs($name)
    {
        $user = $this->user;
        return view('user.item_logs', [
            'user' => $this->user,
            'logs' => $this->user->getItemLogs(0),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

     /**
     * Shows a user's pet logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserPetLogs($name)
    {
        $user = $this->user;
        return view('user.pet_logs', [
            'user' => $this->user,
            'logs' => $this->user->getPetLogs(0)
        ]);
    }

    /**
     * Shows a user's exp logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserExpLogs($name)
    {
        $user = $this->user;
        return view('user.exp_logs', [
            'user' => $this->user,
            'logs' => $this->user->getExpLogs(0),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's level logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserLevelLogs($name)
    {
        $user = $this->user;
        return view('user.level_logs', [
            'user' => $this->user,
            'logs' => $this->user->getLevelLogs(0),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's stat logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserStatLogs($name)
    {
        $user = $this->user;
        return view('user.stat_logs', [
            'user' => $this->user,
            'logs' => $this->user->getStatLogs(0),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's item logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserGearLogs($name)
    {
        $user = $this->user;
        return view('user.gear_logs', [
            'user' => $this->user,
            'logs' => $this->user->getGearLogs(0),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's item logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserWeaponLogs($name)
    {
        $user = $this->user;
        return view('user.weapon_logs', [
            'user' => $this->user,
            'logs' => $this->user->getWeaponLogs(0),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's award logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserAwardLogs($name)
    {
        $user = $this->user;
        return view('user.award_logs', [
            'user' => $this->user,
            'logs' => $this->user->getAwardLogs(0)
        ]);
    }

    /**
     * Shows a user's character ownership logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserOwnershipLogs($name)
    {
        return view('user.ownership_logs', [
            'user' => $this->user,
            'logs' => $this->user->getOwnershipLogs(),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's submissions.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserSubmissions($name)
    {
        return view('user.submission_logs', [
            'user' => $this->user,
            'logs' => $this->user->getSubmissions(Auth::check() ? Auth::user() : null),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's recipe logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserRecipeLogs($name)
    {
        $user = $this->user;
        return view('user.recipe_logs', [
            'user' => $this->user,
            'logs' => $this->user->getRecipeLogs(0),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's gallery submissions.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  string                         $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserGallery(Request $request, $name)
    {
        return view('user.gallery', [
            'user' => $this->user,
            'submissions' => $this->user->gallerySubmissions()->paginate(20)->appends($request->query()),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's gallery submission favorites.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  string                         $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserFavorites(Request $request, $name)
    {
        return view('user.favorites', [
            'user' => $this->user,
            'characters' => false,
            'favorites' => GallerySubmission::whereIn('id', $this->user->galleryFavorites()->pluck('gallery_submission_id')->toArray())->visible(Auth::check() ? Auth::user() : null)->accepted()->orderBy('created_at', 'DESC')->paginate(20)->appends($request->query()),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's gallery submission favorites that contain characters they own.
     *
     * @param  \Illuminate\Http\Request       $request
     * @param  string                         $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserOwnCharacterFavorites(Request $request, $name)
    {
        $user = $this->user;
        $userCharacters = $user->characters()->pluck('id')->toArray();
        $userFavorites = $user->galleryFavorites()->pluck('gallery_submission_id')->toArray();

        return view('user.favorites', [
            'user' => $this->user,
            'characters' => true,
            'favorites' => $this->user->characters->count() ? GallerySubmission::whereIn('id', $userFavorites)->whereIn('id', GalleryCharacter::whereIn('character_id', $userCharacters)->pluck('gallery_submission_id')->toArray())->visible(Auth::check() ? Auth::user() : null)->accepted()->orderBy('created_at', 'DESC')->paginate(20)->appends($request->query()) : null,
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }

    /**
     * Shows a user's gallery submission favorites that contain characters they own.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getUserForumPosts($name)
    {
        $user = $this->user;

        $forums = Forum::all();
        $public = [];
        $posts = collect();

        foreach($forums as $key => $forum)
        {
            if(Auth::user()->canVisitForum($forum->id) && ($forum->parent ? (Auth::user()->canVisitForum($forum->parent->id) && ($forum->parent->parent ? Auth::user()->canVisitForum($forum->parent->parent->id) : true) ) : true)) $public[] = $forum->id;
        }
        $posts = Comment::with('parent')->where('commentable_type','App\Models\Forum')->where('commenter_id',$user->id)->orderBy('created_at', 'DESC')->get()->whereIn('commentable_id',$public);

        return view('user.forum_posts', [
            'user' => $this->user,
            'sublists' => Sublist::orderBy('sort', 'DESC')->get(),
            'posts' => $posts->paginate(20)
        ]);
    }

    /**
     * Shows a user's redeem logs.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserRedeemLogs($name)
    {
        $user = $this->user;
        return view('home._redeem_logs', [
            'user' => $this->user,
            'logs' => $this->user->getRedeemLogs(0),
            'sublists' => Sublist::orderBy('sort', 'DESC')->get()
        ]);
    }
}
