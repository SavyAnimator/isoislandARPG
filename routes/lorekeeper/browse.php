<?php

/*
|--------------------------------------------------------------------------
| Browse Routes
|--------------------------------------------------------------------------
|
| Routes for pages that don't require being logged in to view,
| specifically the information pages.
|
*/

/**************************************************************************************************
    Widgets
**************************************************************************************************/

Route::get('items/{id}', 'Users\InventoryController@getStack');
Route::get('critters/{id}', 'Users\PetController@getStack');
Route::get('equipment/{id}', 'Users\WeaponController@getStack');
Route::get('accessory/{id}', 'Users\GearController@getStack');
Route::get('awards/{id}', 'Users\AwardCaseController@getStack');
Route::get('items/character/{id}', 'Users\InventoryController@getCharacterStack');
Route::get('awards/character/{id}', 'Users\AwardCaseController@getCharacterStack');

/**************************************************************************************************
    News
**************************************************************************************************/
# PROFILES
Route::group(['prefix' => 'news'], function() {
    Route::get('/', 'NewsController@getIndex');
    Route::get('{id}.{slug?}', 'NewsController@getNews');
    Route::get('{id}.', 'NewsController@getNews');
});

/**************************************************************************************************
    Sales
**************************************************************************************************/
# PROFILES
Route::group(['prefix' => 'sales'], function() {
    Route::get('/', 'SalesController@getIndex');
    Route::get('{id}.{slug?}', 'SalesController@getSales');
    Route::get('{id}.', 'SalesController@getSales');
});

/**************************************************************************************************
    Users - Moved to members.php
**************************************************************************************************/
/*
Route::get('/users', 'BrowseController@getUsers');
Route::get('/blacklist', 'BrowseController@getBlacklist');

# PROFILES
Route::group(['prefix' => 'user', 'namespace' => 'Users'], function() {
    Route::get('{name}/gallery', 'UserController@getUserGallery');
    Route::get('{name}/favorites', 'UserController@getUserFavorites');
    Route::get('{name}/favorites/own-characters', 'UserController@getUserOwnCharacterFavorites');

    Route::get('{name}', 'UserController@getUser');
    Route::get('{name}/aliases', 'UserController@getUserAliases');
    Route::get('{name}/characters', 'UserController@getUserCharacters');
    Route::get('{name}/characters/{folder}', 'UserController@getUserCharacterFolder');
    Route::get('{name}/sublist/{key}', 'UserController@getUserSublist');
    Route::get('{name}/myos', 'UserController@getUserMyoSlots');
    Route::get('{name}/inventory', 'UserController@getUserInventory');
    Route::get('{name}/pets', 'UserController@getUserPets');
    Route::get('{name}/bank', 'UserController@getUserBank');
    Route::get('{name}/level', 'UserController@getUserLevel');
    Route::get('{name}/equipment', 'UserController@getUserArmoury');
    Route::get('{name}/currency-logs', 'UserController@getUserCurrencyLogs');
    Route::get('{name}/item-logs', 'UserController@getUserItemLogs');
    Route::get('{name}/pet-logs', 'UserController@getUserPetLogs');
    Route::get('{name}/awardcase', 'UserController@getUserAwardCase');
    Route::get('{name}/currency-logs', 'UserController@getUserCurrencyLogs');
    Route::get('{name}/item-logs', 'UserController@getUserItemLogs');
    Route::get('{name}/award-logs', 'UserController@getUserAwardLogs');
    Route::get('{name}/ownership', 'UserController@getUserOwnershipLogs');
    Route::get('{name}/submissions', 'UserController@getUserSubmissions');
    Route::get('{name}/recipe-logs', 'UserController@getUserRecipeLogs');
    Route::get('{name}/exp-logs', 'UserController@getUserExpLogs');
    Route::get('{name}/level-logs', 'UserController@getUserLevelLogs');
    Route::get('{name}/stat-logs', 'UserController@getUserStatLogs');
    Route::get('{name}/gear-logs', 'UserController@getUserGearLogs');
    Route::get('{name}/weapon-logs', 'UserController@getUserWeaponLogs');
    Route::get('{name}/redeem-logs', 'UserController@getUserRedeemLogs');
});
*/

/**************************************************************************************************
    Characters
**************************************************************************************************/

Route::group(['prefix' => 'character', 'namespace' => 'Characters'], function() {
    Route::get('{slug}', 'CharacterController@getCharacter');
});


/**************************************************************************************************
    World
**************************************************************************************************/

Route::group(['prefix' => 'world'], function() {
    Route::get('/', 'WorldController@getIndex');

    Route::get('currencies', 'WorldController@getCurrencies');
    Route::get('rarities', 'WorldController@getRarities');
    Route::get('species', 'WorldController@getSpecieses');
    Route::get('subtypes', 'WorldController@getSubtypes');
    Route::get('species/{id}/traits', 'WorldController@getSpeciesFeatures');
    Route::get('status-effects', 'WorldController@getStatusEffects');
    Route::get('species/{speciesId}/trait/{id}', 'WorldController@getSpeciesFeatureDetail')->where(['id' => '[0-9]+', 'speciesId' => '[0-9]+']);
    Route::get('kitchensink', 'WorldController@getKitchenSinkFeatures');
    Route::get('kitchensink/trait/{id}', 'WorldController@getKitchenSinkFeatureDetail')->where(['id' => '[0-9]+']);
    Route::get('item-categories', 'WorldController@getItemCategories');
    Route::get('items', 'WorldController@getItems');
    Route::get('award-categories', 'WorldController@getAwardCategories');
    Route::get('awards', 'WorldController@getAwards');
    Route::get('awards/{id}', 'WorldController@getAward');
    Route::get('items/{id}', 'WorldController@getItem');
    Route::get('trait-categories', 'WorldController@getFeatureCategories');
    Route::get('traits', 'WorldController@getFeatures');
    Route::get('critter-categories', 'WorldController@getPetCategories');
    Route::get('critters', 'WorldController@getPets');
    /*Route::get('prompt-categories', 'WorldController@getPromptCategories');*/
    Route::get('prompts', 'WorldController@getPrompts');
    Route::get('character-categories', 'WorldController@getCharacterCategories');
    Route::get('recipes', 'WorldController@getRecipes');
    Route::get('recipes/{id}', 'WorldController@getRecipe');
    Route::get('levels', 'WorldController@getLevels');
    Route::get('levels/{type}', 'WorldController@getLevelTypes');
    Route::get('levels/{type}/{level}', 'WorldController@getSingleLevel');
    Route::get('stats', 'WorldController@getStats');
    Route::get('equipment-categories', 'WorldController@getWeaponCategories');
    Route::get('equipment', 'WorldController@getWeapons');
    Route::get('equipment/{id}', 'WorldController@getWeapon');
    Route::get('accessory-categories', 'WorldController@getGearCategories');
    Route::get('accessory', 'WorldController@getGear');
    Route::get('accessory/{id}', 'WorldController@getGear');
    Route::get('character-classes', 'WorldController@getCharacterClasses');
    Route::get('skill-categories', 'WorldController@getSkillCategories');
    Route::get('skills', 'WorldController@getSkills');
    Route::get('skills/{id}', 'WorldController@getSkill');
});

Route::group(['prefix' => 'prompts'], function() {
    Route::get('/', 'PromptsController@getIndex');
    Route::get('prompt-categories', 'PromptsController@getPromptCategories');
    Route::get('prompts', 'PromptsController@getPrompts');
    Route::get('{id}', 'PromptsController@getPrompt');
});

Route::group(['prefix' => 'shops'], function() {
    Route::get('/', 'ShopController@getIndex');
    Route::get('{id}', 'ShopController@getShop')->where(['id' => '[0-9]+']);
    Route::get('{id}/{stockId}', 'ShopController@getShopStock')->where(['id' => '[0-9]+', 'stockId' => '[0-9]+']);
    Route::get('donation-shop', 'ShopController@getDonationShop');
    Route::get('donation-shop/{id}', 'ShopController@getDonationShopStock')->where(['id' => '[0-9]+']);
});

Route::group(['prefix' => 'adoptions'], function() {
    Route::get('/', 'AdoptionController@getAdoption');
    Route::get('{id}/{stockId}', 'AdoptionController@getAdoptionStock')->where(['id' => '[0-9]+', 'stockId' => '[0-9]+']);
});

Route::group(['prefix' => __('dailies.dailies')], function() {
    Route::get('/', 'DailyController@getIndex');
    Route::get('{id}', 'DailyController@getDaily')->where(['id' => '[0-9]+']);
});


/**************************************************************************************************
    Critter Drops
**************************************************************************************************/
Route::get('critters/critter/{id}', 'Users\PetController@getPetDrops');

/**************************************************************************************************
    Site Pages
**************************************************************************************************/
Route::get('credits', 'PageController@getCreditsPage');
Route::get('info/{key}', 'PageController@getPage');
Route::get('/achieve', function() {return view('custom.achieve');});
Route::get('/care', function() {return view('custom.care');});
Route::get('/classes', function() {return view('custom.classes');});
Route::get('/club', function() {return view('custom.club');});
Route::get('/craft', function() {return view('custom.craft');});
Route::get('/dash', function() {return view('custom.dash');});
Route::get('/design', function() {return view('custom.design');});
Route::get('/explore', function() {return view('custom.explore');});
Route::get('/features', 'HomeController@getFeatures');
Route::get('/faq', function() {return view('custom.faq');});
Route::get('/glossary', function() {return view('custom.glossary');});
Route::get('/guide', function() {return view('custom.guide');});
Route::get('/island', function() {return view('custom.island');});
Route::get('/map', function() {return view('custom.map');});
Route::get('/prompt', function() {return view('custom.prompt');});
Route::get('/race', function() {return view('custom.race');});
Route::get('/training', function() {return view('custom.training');});
Route::get('/tame', function() {return view('custom.tame');});
Route::get('/voyage', function() {return view('custom.voyage');});
Route::get('/well', function() {return view('home.wishingwell');});
Route::get('/support', function() {return view('custom.support');});
Route::get('/NPCs', function() {return view('custom.npc');});
Route::get('/NPCs/Slayer', function() {return view('custom.npc_slayer');});
Route::get('/NPCs/Pacings', function() {return view('custom.npc_pacings');});
Route::get('/NPCs/Carmen', function() {return view('custom.npc_carmen');});
Route::get('/NPCs/Frio', function() {return view('custom.npc_frio');});
Route::get('/NPCs/Darwin', function() {return view('custom.npc_darwin');});
Route::get('/NPCs/Hasha', function() {return view('custom.npc_hasha');});
Route::get('/NPCs/Thyme', function() {return view('custom.npc_thyme');});
Route::get('/NPCs/Sugar', function() {return view('custom.npc_sugar');});
Route::get('/NPCs/Aycorn', function() {return view('custom.npc_aycorn');});
Route::get('/NPCs/Charlotte', function() {return view('custom.npc_charlotte');});
Route::get('/NPCs/Deustrum', function() {return view('custom.npc_deus');});
Route::get('/carnival', function() {return view('custom.carnival');});

/**************************************************************************************************
    Raffles - Moved to Members
**************************************************************************************************/
/*Route::group(['prefix' => 'raffles'], function () {
    Route::get('/', 'RaffleController@getRaffleIndex');
    Route::get('view/{id}', 'RaffleController@getRaffleTickets');
});*/

/**************************************************************************************************
    Fetch Quests (chaned from fetch to pavilion url)
**************************************************************************************************/
Route::group(['prefix' => 'pavilion'], function() {
    Route::get('/', 'FetchQuestController@getIndex');
    Route::post('/new', 'FetchQuestController@postFetchQuest');
});

/**************************************************************************************************
    Higher or Lower (Sink or Soar)
**************************************************************************************************/

Route::group(['prefix' => 'sink-or-soar'], function() {
    Route::get('/', 'HolController@getIndex');

    Route::get('play', 'HolController@playHol');
    Route::post('play/guess', 'HolController@postGuess');
});

/**************************************************************************************************
    Submissions
**************************************************************************************************/
Route::group(['prefix' => 'submissions', 'namespace' => 'Users'], function() {
    Route::get('view/{id}', 'SubmissionController@getSubmission');
});
Route::group(['prefix' => 'claims', 'namespace' => 'Users'], function() {
    Route::get('view/{id}', 'SubmissionController@getClaim');
});
Route::group(['prefix' => 'surrender'], function() {
    Route::get('view/{id}', 'SurrenderController@getPublicSurrender');
});

/**************************************************************************************************
    Comments
**************************************************************************************************/
Route::get('comment/{id}', 'PermalinkController@getComment');

/**************************************************************************************************
    Galleries
**************************************************************************************************/
Route::group(['prefix' => 'gallery'], function() {
    Route::get('/', 'GalleryController@getGalleryIndex');
    Route::get('all', 'GalleryController@getAll');
    Route::get('{id}', 'GalleryController@getGallery');
    Route::get('view/{id}', 'GalleryController@getSubmission');
    Route::get('view/favorites/{id}', 'GalleryController@getSubmissionFavorites');
});

/**************************************************************************************************
    Reports
**************************************************************************************************/
Route::group(['prefix' => 'reports', 'namespace' => 'Users'], function() {
    Route::get('/bug-reports', 'ReportController@getBugIndex');
});

Route::get('time' , function() {
    return date('Y-m-d H:i:s');
});

/**************************************************************************************************
    Forms & Polls
**************************************************************************************************/
Route::group(['prefix' => 'forms'], function() {
    Route::get('/', 'SiteFormController@getIndex');
    Route::get('{id}.{slug?}', 'SiteFormController@getSiteForm');
    Route::get('{id}.', 'SiteFormController@getSiteForm');
});
