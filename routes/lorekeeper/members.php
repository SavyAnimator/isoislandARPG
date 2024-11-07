<?php

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
|
| Routes for logged in users with a linked dA account.
|
*/

/**************************************************************************************************
    Users
**************************************************************************************************/

Route::group(['prefix' => 'notifications', 'namespace' => 'Users'], function() {
    Route::get('/', 'AccountController@getNotifications');
    Route::get('delete/{id}', 'AccountController@getDeleteNotification');
    Route::post('clear', 'AccountController@postClearNotifications');
    Route::post('clear/{type}', 'AccountController@postClearNotifications');
});

Route::group(['prefix' => 'account', 'namespace' => 'Users'], function() {
    Route::get('settings', 'AccountController@getSettings');
    Route::post('profile', 'AccountController@postProfile');
    Route::post('password', 'AccountController@postPassword');
    Route::post('email', 'AccountController@postEmail');
    Route::post('avatar', 'AccountController@postAvatar');
    Route::post('theme', 'AccountController@postTheme');
    Route::get('aliases', 'AccountController@getAliases');
    Route::get('make-primary/{id}', 'AccountController@getMakePrimary');
    Route::post('make-primary/{id}', 'AccountController@postMakePrimary');
    Route::get('hide-alias/{id}', 'AccountController@getHideAlias');
    Route::post('hide-alias/{id}', 'AccountController@postHideAlias');
    Route::get('remove-alias/{id}', 'AccountController@getRemoveAlias');
    Route::post('remove-alias/{id}', 'AccountController@postRemoveAlias');
    Route::post('dob', 'AccountController@postBirthday');
    Route::post('socials', 'AccountController@postLinks');
    Route::post('onl', 'AccountController@postOnline');

    /*
    Route::get('bookmarks', 'BookmarkController@getBookmarks');
    Route::get('bookmarks/create', 'BookmarkController@getCreateBookmark');
    Route::get('bookmarks/edit/{id}', 'BookmarkController@getEditBookmark');
    Route::post('bookmarks/create', 'BookmarkController@postCreateEditBookmark');
    Route::post('bookmarks/edit/{id}', 'BookmarkController@postCreateEditBookmark');
    Route::get('bookmarks/delete/{id}', 'BookmarkController@getDeleteBookmark');
    Route::post('bookmarks/delete/{id}', 'BookmarkController@postDeleteBookmark');
    */
});

Route::group(['prefix' => 'inventory', 'namespace' => 'Users'], function() {
    Route::get('/', 'InventoryController@getIndex');
    Route::post('edit', 'InventoryController@postEdit');
    Route::get('account-search', 'InventoryController@getAccountSearch');
    Route::get('consolidate-inventory', 'InventoryController@getConsolidateInventory');
    Route::post('consolidate', 'InventoryController@postConsolidateInventory');

    Route::get('selector', 'InventoryController@getSelector');
});

Route::group(['prefix' => 'critters', 'namespace' => 'Users'], function() {
    Route::get('/', 'PetController@getIndex');
    Route::post('transfer/{id}', 'PetController@postTransfer');
    Route::post('delete/{id}', 'PetController@postDelete');
    Route::post('name/{id}', 'PetController@postName');
    Route::post('attach/{id}', 'PetController@postAttach');
    Route::post('detach/{id}', 'PetController@postDetach');
    Route::post('variant/{id}', 'PetController@postVariant');

    Route::get('selector', 'PetController@getSelector');

    Route::post('critter/{id}', 'PetController@postClaimPetDrops');
});

Route::group(['prefix' => 'accessory', 'namespace' => 'Users'], function() {
    Route::get('/', 'GearController@getIndex');
    Route::post('transfer/{id}', 'GearController@postTransfer');
    Route::post('delete/{id}', 'GearController@postDelete');
    Route::post('name/{id}', 'GearController@postName');
    Route::post('attach/{id}', 'GearController@postAttach');
    Route::post('detach/{id}', 'GearController@postDetach');
    Route::post('upgrade/{id}', 'GearController@postUpgrade');

    Route::get('selector', 'GearController@getSelector');
});

Route::group(['prefix' => 'equipment', 'namespace' => 'Users'], function() {
    Route::get('/', 'WeaponController@getIndex');
    Route::post('transfer/{id}', 'WeaponController@postTransfer');
    Route::post('delete/{id}', 'WeaponController@postDelete');
    Route::post('name/{id}', 'WeaponController@postName');
    Route::post('attach/{id}', 'WeaponController@postAttach');
    Route::post('detach/{id}', 'WeaponController@postDetach');
    Route::post('upgrade/{id}', 'WeaponController@postUpgrade');
    Route::post('image/{id}', 'WeaponController@postImage');

    Route::get('selector', 'WeaponController@getSelector');
});

Route::group(['prefix' => 'awardcase', 'namespace' => 'Users'], function() {
    Route::get('/', 'AwardCaseController@getIndex');
    Route::post('edit', 'AwardCaseController@postEdit');

    Route::get('selector', 'AwardCaseController@getSelector');

});

Route::group(['prefix' => 'characters', 'namespace' => 'Users'], function() {
    Route::get('/', 'CharacterController@getIndex');
    Route::post('sort', 'CharacterController@postSortCharacters');
    Route::get('folder/create', 'CharacterController@getCreateFolder');
    Route::get('folder/edit/{id}', 'CharacterController@getEditFolder');
    Route::post('folder/create', 'CharacterController@postCreateEditFolder');
    Route::post('folder/edit/{id}', 'CharacterController@postCreateEditFolder');
    Route::post('folder/delete/{id}', 'CharacterController@postDeleteFolder');
    Route::get('transfers/{type}', 'CharacterController@getTransfers');
    Route::post('transfer/act/{id}', 'CharacterController@postHandleTransfer');

    Route::get('myos', 'CharacterController@getMyos');

    # CLASS
    Route::get('class/edit/{id}', 'CharacterController@getClassModal');
    Route::post('class/edit/{id}', 'CharacterController@postClassModal');
});

Route::group(['prefix' => 'bank', 'namespace' => 'Users'], function() {
    Route::get('/', 'BankController@getIndex');
    Route::post('transfer', 'BankController@postTransfer');
});

Route::group(['prefix' => 'level', 'namespace' => 'Users'], function() {
    Route::get('/', 'LevelController@getIndex');
    Route::post('up', 'LevelController@postLevel');
    Route::post('transfer', 'LevelController@postTransfer');
});

Route::group(['prefix' => 'trades', 'namespace' => 'Users'], function() {
    Route::get('{status}', 'TradeController@getIndex')->where('status', 'open|pending|completed|rejected|canceled');
    Route::get('create', 'TradeController@getCreateTrade');
    Route::get('{id}/edit', 'TradeController@getEditTrade')->where('id', '[0-9]+');
    Route::post('create', 'TradeController@postCreateTrade');
    Route::post('{id}/edit', 'TradeController@postEditTrade')->where('id', '[0-9]+');
    Route::get('{id}', 'TradeController@getTrade')->where('id', '[0-9]+');

    Route::get('{id}/confirm-offer', 'TradeController@getConfirmOffer');
    Route::post('{id}/confirm-offer', 'TradeController@postConfirmOffer');
    Route::get('{id}/confirm-trade', 'TradeController@getConfirmTrade');
    Route::post('{id}/confirm-trade', 'TradeController@postConfirmTrade');
    Route::get('{id}/cancel-trade', 'TradeController@getCancelTrade');
    Route::post('{id}/cancel-trade', 'TradeController@postCancelTrade');
});

Route::group(['prefix' => 'crafting', 'namespace' => 'Users'], function() {
    Route::get('/', 'CraftingController@getIndex');
    Route::get('craft/{id}', 'CraftingController@getCraftRecipe');
    Route::post('craft/{id}', 'CraftingController@postCraftRecipe');
});



/**************************************************************************************************
    Users - Moved from browse.php
**************************************************************************************************/

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
    Route::get('{name}/sublist/{key}', 'UserController@getUserSublist');
    Route::get('{name}/myos', 'UserController@getUserMyoSlots');
    Route::get('{name}/inventory', 'UserController@getUserInventory');
    Route::get('{name}/bank', 'UserController@getUserBank');
    Route::get('{name}/critters', 'UserController@getUserPets');
    Route::get('{name}/level', 'UserController@getUserLevel');
    Route::get('{name}/equipment', 'UserController@getUserArmoury');

    Route::get('{name}/currency-logs', 'UserController@getUserCurrencyLogs');
    Route::get('{name}/item-logs', 'UserController@getUserItemLogs');
    Route::get('{name}/critter-logs', 'UserController@getUserPetLogs');
    Route::get('{name}/ownership', 'UserController@getUserOwnershipLogs');
    Route::get('{name}/submissions', 'UserController@getUserSubmissions');
    Route::get('{name}/awardcase', 'UserController@getUserAwardCase');
    Route::get('{name}/award-logs', 'UserController@getUserAwardLogs');
    Route::get('{name}/recipe-logs', 'UserController@getUserRecipeLogs');
    Route::get('{name}/exp-logs', 'UserController@getUserExpLogs');
    Route::get('{name}/level-logs', 'UserController@getUserLevelLogs');
    Route::get('{name}/stat-logs', 'UserController@getUserStatLogs');
    Route::get('{name}/accessory-logs', 'UserController@getUserGearLogs');
    Route::get('{name}/equipment-logs', 'UserController@getUserWeaponLogs');
    Route::get('{name}/redeem-logs', 'UserController@getUserRedeemLogs');
});

/**************************************************************************************************
    Characters
**************************************************************************************************/
Route::get('/masterlist', 'BrowseController@getCharacters');
Route::get('/myos', 'BrowseController@getMyos');
Route::get('/sublist/{key}', 'BrowseController@getSublist');

Route::group(['prefix' => 'character', 'namespace' => 'Characters'], function() {
    Route::get('{slug}/profile', 'CharacterController@getCharacterProfile');
    Route::get('{slug}/awards', 'CharacterController@getCharacterAwards');
    Route::get('{slug}/inventory', 'CharacterController@getCharacterInventory');
    Route::get('{slug}/images', 'CharacterController@getCharacterImages');
    Route::get('{slug}/drops', 'CharacterController@getCharacterDrops');
    Route::post('{slug}/drops', 'CharacterController@postClaimCharacterDrops');

    Route::get('{slug}/currency-logs', 'CharacterController@getCharacterCurrencyLogs');
    Route::get('{slug}/item-logs', 'CharacterController@getCharacterItemLogs');
    Route::get('{slug}/ownership', 'CharacterController@getCharacterOwnershipLogs');
    Route::get('{slug}/change-log', 'CharacterController@getCharacterLogs');
    Route::get('{slug}/submissions', 'CharacterController@getCharacterSubmissions');

    Route::get('{slug}/profile/edit', 'CharacterController@getEditCharacterProfile');
    Route::post('{slug}/profile/edit', 'CharacterController@postEditCharacterProfile');

    Route::post('{slug}/awardcase/edit', 'CharacterController@postAwardEdit');
    Route::post('{slug}/inventory/edit', 'CharacterController@postInventoryEdit');
    Route::post('{slug}/bank/transfer', 'CharacterController@postCurrencyTransfer');
    Route::get('{slug}/transfer', 'CharacterController@getTransfer');
    Route::post('{slug}/transfer', 'CharacterController@postTransfer');
    Route::post('{slug}/transfer/{id}/cancel', 'CharacterController@postCancelTransfer');

    Route::get('{slug}/bank', 'CharacterController@getCharacterBank');
    Route::get('{slug}/level', 'CharacterController@getCharacterLevel');
    Route::post('{slug}/approval', 'CharacterController@postCharacterApproval');
    Route::get('{slug}/approval', 'CharacterController@getCharacterApproval');

    Route::get('{slug}/level-area', 'LevelController@getIndex');
    Route::get('{slug}/stats-area', 'LevelController@getStatsIndex');
    Route::post('{slug}/level-area/up', 'LevelController@postLevel');
    Route::post('{slug}/stats-area/{id}', 'LevelController@postStat');
    Route::post('{slug}/stats-area/admin/{id}', 'LevelController@postAdminStat');
    Route::post('{slug}/stats-area/edit/{id}', 'LevelController@postEditStat');
    Route::post('{slug}/stats-area/edit/base/{id}', 'LevelController@postEditBaseStat');

    # History and Logs
    Route::get('{slug}/status-effects', 'CharacterController@getCharacterStatusEffects');
    Route::get('{slug}/award-logs', 'CharacterController@getCharacterAwardLogs');
    Route::get('{slug}/currency-logs', 'CharacterController@getCharacterCurrencyLogs');
    Route::get('{slug}/item-logs', 'CharacterController@getCharacterItemLogs');
    Route::get('{slug}/status-effect-logs', 'CharacterController@getCharacterStatusEffectLogs');
    Route::get('{slug}/ownership', 'CharacterController@getCharacterOwnershipLogs');
    Route::get('{slug}/change-log', 'CharacterController@getCharacterLogs');
    Route::get('{slug}/skill-logs', 'CharacterController@getCharacterSkillLogs');
    Route::get('{slug}/submissions', 'CharacterController@getCharacterSubmissions');
    Route::get('{slug}/exp-logs', 'CharacterController@getCharacterExpLogs');
    Route::get('{slug}/stat-logs', 'CharacterController@getCharacterStatLogs');
    Route::get('{slug}/level-logs', 'CharacterController@getCharacterLevelLogs');
    Route::get('{slug}/count-logs', 'CharacterController@getCharacterCountLogs');
    Route::get('{slug}/gallery', 'CharacterController@getCharacterGallery');

    # EXP
    Route::post('{slug}/level-area/exp-grant', 'LevelController@postExpGrant');
    Route::post('{slug}/level-area/stat-grant', 'LevelController@postStatGrant');

     # lineage
    Route::get('{slug}/lineage', 'CharacterLineageController@getCharacterLineage');
    Route::get('{slug}/children', 'CharacterLineageController@getCharacterChildren');
    Route::get('{slug}/grandchildren', 'CharacterLineageController@getCharacterGrandChildren');
    Route::get('{slug}/great-grandchildren', 'CharacterLineageController@getCharacterGreatGrandChildren');

    Route::get('{slug}/ancestors', 'LineageController@getAncestors');
    Route::get('{slug}/offspring', 'LineageController@getDescendants');
    Route::get('{slug}/relatives', 'LineageController@getCousins');
    Route::get('{slug}/lineage/{relation}', 'LineageController@getList')->where(['relation' => 'parents|grandparents|great-grandparents|children|grandchildren|great-grandchildren|siblings|niblings|aunts-uncles|cousins']);
});

    # Rogue Lineages
    Route::group(['prefix' => 'rogue', 'namespace' => 'Characters'], function() {
    Route::get('{rogue}', 'LineageController@getRogue')->where(['rogue' => '[0-9]+']);
    Route::get('{rogue}/ancestors', 'LineageController@getAncestors')->where(['rogue' => '[0-9]+']);
    Route::get('{rogue}/offspring', 'LineageController@getDescendants')->where(['rogue' => '[0-9]+']);
    Route::get('{rogue}/relatives', 'LineageController@getCousins')->where(['rogue' => '[0-9]+']);
    Route::get('{rogue}/lineage/{relation}', 'LineageController@getList')->where(['rogue' => '[0-9]+', 'relation' => 'parents|grandparents|great-grandparents|children|grandchildren|great-grandchildren|siblings|niblings|aunts-uncles|cousins']);
});

    #MYOs
    Route::group(['prefix' => 'myo', 'namespace' => 'Characters'], function() {
    Route::get('{id}', 'MyoController@getCharacter');
    Route::get('{id}/profile', 'MyoController@getCharacterProfile');
    Route::get('{id}/ownership', 'MyoController@getCharacterOwnershipLogs');

    Route::get('{id}/profile/edit', 'MyoController@getEditCharacterProfile');
    Route::post('{id}/profile/edit', 'MyoController@postEditCharacterProfile');

    Route::get('{id}/transfer', 'MyoController@getTransfer');
    Route::post('{id}/transfer', 'MyoController@postTransfer');
    Route::post('{id}/transfer/{id2}/cancel', 'MyoController@postCancelTransfer');

    Route::post('{id}/approval', 'MyoController@postCharacterApproval');
    Route::get('{id}/approval', 'MyoController@getCharacterApproval');

    Route::get('{id}/change-log', 'MyoController@getCharacterLogs');

    // LINEAGE
    Route::get('{id}/ancestors', 'LineageController@getAncestors')->where(['id' => '[0-9]+']);
    Route::get('{id}/relatives', 'LineageController@getCousins')->where(['id' => '[0-9]+']);
    Route::get('{id}/lineage/{relation}', 'LineageController@getList')->where(['id' => '[0-9]+', 'relation' => 'parents|grandparents|great-grandparents|children|grandchildren|great-grandchildren|siblings|niblings|aunts-uncles|cousins']);
});

Route::group(['prefix' => 'level', 'namespace' => 'Users'], function() {
    Route::get('/', 'LevelController@getIndex');

});



/**************************************************************************************************
    Raffles
**************************************************************************************************/
Route::group(['prefix' => 'raffles'], function () {
    Route::get('/', 'RaffleController@getRaffleIndex');
    Route::get('view/{id}', 'RaffleController@getRaffleTickets');
});

/**************************************************************************************************
    Submissions
**************************************************************************************************/

Route::group(['prefix' => 'gallery'], function() {
    Route::get('submissions/{type}', 'GalleryController@getUserSubmissions')->where('type', 'draft|pending|accepted|rejected');

    Route::post('favorite/{id}', 'GalleryController@postFavoriteSubmission');

    Route::get('submit/{id}', 'GalleryController@getNewGallerySubmission');
    Route::get('submit/character/{slug}', 'GalleryController@getCharacterInfo');
    Route::get('edit/{id}', 'GalleryController@getEditGallerySubmission');
    Route::get('queue/{id}', 'GalleryController@getSubmissionLog');
    Route::post('submit', 'GalleryController@postCreateEditGallerySubmission');
    Route::post('edit/{id}', 'GalleryController@postCreateEditGallerySubmission');

    Route::post('collaborator/{id}', 'GalleryController@postEditCollaborator');

    Route::get('archive/{id}', 'GalleryController@getArchiveSubmission');
    Route::post('archive/{id}', 'GalleryController@postArchiveSubmission');
});

Route::group(['prefix' => 'submissions', 'namespace' => 'Users'], function() {
    Route::get('/', 'SubmissionController@getIndex');
    Route::get('new', 'SubmissionController@getNewSubmission');
    Route::get('new/character/{slug}', 'SubmissionController@getCharacterInfo');
    Route::get('new/prompt/{id}', 'SubmissionController@getPromptInfo');
    Route::post('new', 'SubmissionController@postNewSubmission');
    Route::post('new/{draft}', 'SubmissionController@postNewSubmission')->where('draft', 'draft');
    Route::get('draft/{id}', 'SubmissionController@getEditSubmission');
    Route::post('draft/{id}', 'SubmissionController@postEditSubmission');
    Route::post('draft/{id}/{submit}', 'SubmissionController@postEditSubmission')->where('submit', 'submit');
    Route::post('draft/{id}/delete', 'SubmissionController@postDeleteSubmission');
    Route::post('draft/{id}/cancel', 'SubmissionController@postCancelSubmission');
});

Route::group(['prefix' => 'claims', 'namespace' => 'Users'], function() {
    Route::get('/', 'SubmissionController@getClaimsIndex');
    Route::get('new', 'SubmissionController@getNewClaim');
    Route::post('new', 'SubmissionController@postNewClaim');
    Route::post('new/{draft}', 'SubmissionController@postNewClaim')->where('draft', 'draft');
    Route::get('draft/{id}', 'SubmissionController@getEditClaim');
    Route::post('draft/{id}', 'SubmissionController@postEditClaim');
    Route::post('draft/{id}/{submit}', 'SubmissionController@postEditClaim')->where('submit', 'submit');
    Route::post('draft/{id}/delete', 'SubmissionController@postDeleteClaim');
    Route::post('draft/{id}/cancel', 'SubmissionController@postCancelClaim');
});

Route::group(['prefix' => 'reports', 'namespace' => 'Users'], function() {
    Route::get('/', 'ReportController@getReportsIndex');
    Route::get('new', 'ReportController@getNewReport');
    Route::post('new', 'ReportController@postNewReport');
    Route::get('view/{id}', 'ReportController@getReport');
});

Route::group(['prefix' => 'designs', 'namespace' => 'Characters'], function() {
    Route::get('{type?}', 'DesignController@getDesignUpdateIndex')->where('type', 'draft|pending|approved|rejected');
    Route::get('{id}', 'DesignController@getDesignUpdate');

    Route::get('{id}/comments', 'DesignController@getComments');
    Route::post('{id}/comments', 'DesignController@postComments');

    Route::get('{id}/image', 'DesignController@getImage');
    Route::post('{id}/image', 'DesignController@postImage');

    Route::get('{id}/addons', 'DesignController@getAddons');
    Route::post('{id}/addons', 'DesignController@postAddons');

    Route::get('{id}/traits', 'DesignController@getFeatures');
    Route::post('{id}/traits', 'DesignController@postFeatures');
    Route::get('traits/subtype', 'DesignController@getFeaturesSubtype');

    Route::get('{id}/confirm', 'DesignController@getConfirm');
    Route::post('{id}/submit', 'DesignController@postSubmit');

    Route::get('{id}/delete', 'DesignController@getDelete');
    Route::post('{id}/delete', 'DesignController@postDelete');
});

/**************************************************************************************************
    Games
**************************************************************************************************/

Route::group(['prefix' => 'apple', 'namespace' => 'Users'], function() {
    Route::get('/', 'AppleController@getApple');
    Route::post('/forage/{id}', 'AppleController@postForage');
    Route::post('/claim', 'AppleController@postClaim');
});

Route::group(['prefix' => 'pool', 'namespace' => 'Users'], function() {
    Route::get('/', 'TideController@getTide');
    Route::post('/forage/{id}', 'TideController@postForage');
    Route::post('/claim', 'TideController@postClaim');
});

Route::group(['prefix' => 'cache', 'namespace' => 'Users'], function() {
    Route::get('/', 'CacheController@getCache');
    Route::post('/forage/{id}', 'CacheController@postForage');
    Route::post('/claim', 'CacheController@postClaim');
});
/**************************************************************************************************
    Shops
**************************************************************************************************/

Route::group(['prefix' => 'shops'], function() {
    Route::post('buy', 'ShopController@postBuy');
    Route::post('collect', 'ShopController@postCollect');
    Route::get('history', 'ShopController@getPurchaseHistory');

    // PRODUCT SPECIFIC
    Route::get('invoice/{id}', 'PaymentController@getInvoice'); // modal
    Route::get('products', 'PaymentController@getStoreFront');
    Route::get('products/cart/{ids?}', 'PaymentController@getCart'); // modal
    Route::post('products/purchase/{ids?}', 'PaymentController@postCheckout');

    // PAYPAL SPECIFIC
    Route::get('products/paypal/confirm', 'PaymentController@getPaypalConfirm');
    Route::post('products/paypal/confirm/{id}', 'PaymentController@postPaypalConfirm');
    Route::get('products/paypal/success', 'PaymentController@getPaypalSuccess');
    Route::get('products/paypal/cancel', 'PaymentController@getPaypalCancel');
    Route::post('products/paypal/cancel/{id}', 'PaymentController@postPaypalCancel');
});

/**************************************************************************************************
    Adoptions
**************************************************************************************************/

Route::group(['prefix' => 'adoptions'], function() {
    Route::post('buy', 'AdoptionController@postBuy');
    Route::get('history', 'AdoptionController@getPurchaseHistory');
});

Route::group(['prefix' => 'surrenders'], function() {
Route::get('new', 'SurrenderController@getSurrender');
Route::get('/', 'SurrenderController@getIndex')->where('status', 'pending|approved|rejected');
Route::post('new/post', 'SurrenderController@postSurrender');
});


/**************************************************************************************************
    Scavenger Hunts
**************************************************************************************************/

Route::group(['prefix' => 'hunts'], function() {
    Route::get('{id}', 'HuntController@getHunt');
    Route::get('targets/{pageId}', 'HuntController@getTarget');
    Route::post('targets/claim', 'HuntController@postClaimTarget');
});


/**************************************************************************************************
    Dailies
**************************************************************************************************/

Route::group(['prefix' => __('dailies.dailies')], function() {
    // throttle requests to 1 per ~10 seconds
    Route::middleware('throttle:1,0.16')->group(function () {
        Route::post('{id}', 'DailyController@postRoll');
    });
});


/**************************************************************************************************
    Comments
**************************************************************************************************/
Route::group(['prefix' => 'comments', 'namespace' => 'Comments'], function() {
    Route::post('/', 'CommentController@store')->name('comments.store');
    Route::delete('/{comment}', 'CommentController@destroy')->name('comments.destroy');
    Route::put('/{comment}', 'CommentController@update')->name('comments.update');
    Route::post('/{comment}', 'CommentController@reply')->name('comments.reply');
    Route::post('/{id}/feature', 'CommentController@feature')->name('comments.feature');
    Route::post('/{id}/lock', 'CommentController@lock')->name('comments.lock');
});


/**************************************************************************************************
    Forums
**************************************************************************************************/
Route::group(['prefix' => 'forum'], function() {
    Route::get('{id}/new', 'ForumController@getCreateThread');
    Route::get('{id}/~{thread_id}/edit', 'ForumController@getEditThread');
    Route::get('{board_id}/~{id}', 'ForumController@getThread');
    Route::get('{id}', 'ForumController@getForum');
});

Route::group(['prefix' => 'user', 'namespace' => 'Users'], function() {
    Route::get('{name}/forum', 'UserController@getUserForumPosts'); // Placed here so I don't have to mess with
});

/**************************************************************************************************
    Site Pages
**************************************************************************************************/
Route::get('/me', function() {return view('custom.me');});

/**************************************************************************************************
    Reports
**************************************************************************************************/
Route::group(['prefix' => 'reports', 'namespace' => 'Users'], function() {
    Route::get('/bug-reports', 'ReportController@getBugIndex');
});

/**************************************************************************************************
    Advent Calendars
**************************************************************************************************/

Route::group(['prefix' => 'advent-calendars'], function() {
    Route::get('{id}', 'AdventController@getAdvent');
    Route::post('{id}', 'AdventController@postClaimPrize');
});

/**************************************************************************************************
    Foraging
**************************************************************************************************/
Route::group(['prefix' => 'foraging', 'namespace' => 'Users'], function() {
    Route::get('/', 'ForagingController@getIndex');
    Route::post('/forage/{id}', 'ForagingController@postForage');
    Route::post('/claim', 'ForagingController@postClaim');
    Route::post('edit/character', 'ForagingController@postEditCharacter');
});

/**************************************************************************************************
    Patreon
**************************************************************************************************/
Route::group(['prefix' => 'patreon', 'namespace' => 'Users'], function() {
    Route::get('/', 'PatreonController@getIndex');
    Route::get('/refresh', 'PatreonController@getRefresh');
    Route::post('/refresh', 'PatreonController@postRefresh');
    Route::get('/link', 'PatreonController@link');
    Route::post('/claim', 'PatreonController@claim');
});

/**************************************************************************************************
Garden
**************************************************************************************************/
Route::group(['prefix' => 'garden', 'namespace' => 'Games'],  function(){
    Route::get('/', 'GardenController@getIndex');
    Route::get('skull/{id}', 'GardenController@getSkull');
    Route::post('destroy/{id}', 'GardenController@destroyCrop');
    Route::post('/plant', 'GardenController@postPlantSeed');
    Route::post('/mod', 'GardenController@postAddMod');
    Route::post('/water', 'GardenController@postWaterPlot');
    Route::post('/clear', 'GardenController@postClearPlot');
    Route::post('/plots/purchase/{id}', 'GardenController@postPurchasePlot');
    Route::post('/claim/{id}', 'GardenController@postClaim');
    Route::post('/collect/{type}', 'GardenController@postCollectAll');
});

Route::group(['prefix' => 'wishingwell'], function() {
    Route::get('/', 'WishingWellController@getWishingWell');
    Route::post('editwish', 'WishingWellController@postCreateEditWish');
    Route::post('editwish/{id}', 'WishingWellController@postCreateEditWish');
    Route::post('createwish', 'WishingWellController@postCreateEditWish');
});

/**************************************************************************************************
    Carnival Games
**************************************************************************************************/

Route::group(['prefix' => 'carnivalgames'], function() {
    Route::get('/', 'CarnivalGamesController@getCarnivalGames');
    Route::post('editgame', 'CarnivalGamesController@postCreateEditGame');
    Route::post('editgame/{id}', 'CarnivalGamesController@postCreateEditGame');
    Route::post('creategame', 'CarnivalGamesController@postCreateEditGame');
});

Route::group(['prefix' => 'carnivalrock'], function() {
    Route::get('/', 'CarnivalRockController@getCarnivalRock');
    Route::post('editrock', 'CarnivalRockController@postCreateEditRock');
    Route::post('editrock/{id}', 'CarnivalRockController@postCreateEditRock');
    Route::post('createrock', 'CarnivalRockController@postCreateEditRock');
});

Route::group(['prefix' => 'carnivalfluke'], function() {
    Route::get('/', 'CarnivalFlukeController@getCarnivalFluke');
    Route::post('editfluke', 'CarnivalFlukeController@postCreateEditFluke');
    Route::post('editfluke/{id}', 'CarnivalFlukeController@postCreateEditFluke');
    Route::post('createfluke', 'CarnivalFlukeController@postCreateEditFluke');
});

Route::group(['prefix' => 'carnivalwhap'], function() {
    Route::get('/', 'CarnivalWhapController@getCarnivalWhap');
    Route::post('editwhap', 'CarnivalWhapController@postCreateEditWhap');
    Route::post('editwhap/{id}', 'CarnivalWhapController@postCreateEditWhap');
    Route::post('createwhap', 'CarnivalWhapController@postCreateEditWhap');
});

Route::group(['prefix' => 'carnivalpalm'], function() {
    Route::get('/', 'CarnivalPalmController@getCarnivalPalm');
    Route::post('editpalm', 'CarnivalPalmController@postCreateEditPalm');
    Route::post('editpalm/{id}', 'CarnivalPalmController@postCreateEditPalm');
    Route::post('createpalm', 'CarnivalPalmController@postCreateEditPalm');
});

Route::group(['prefix' => 'carnivalpin'], function() {
    Route::get('/', 'CarnivalPinController@getCarnivalPin');
    Route::post('editpin', 'CarnivalPinController@postCreateEditPin');
    Route::post('editpin/{id}', 'CarnivalPinController@postCreateEditPin');
    Route::post('createpin', 'CarnivalPinController@postCreateEditPin');
});

/**************************************************************************************************
    Forums
**************************************************************************************************/
Route::group(['prefix' => 'forum'], function() {
    Route::get('/', 'ForumController@getIndex');
});

/**************************************************************************************************
    Forms & Polls
**************************************************************************************************/
Route::group(['prefix' => 'forms'], function() {
    Route::post('/send/{id}', 'SiteFormController@postSiteForm');
    Route::get('/send/{id}', 'SiteFormController@editSiteForm');
    Route::post('/like/{id}', 'SiteFormController@postLikeAnswer');
    Route::post('/unlike/{id}', 'SiteFormController@postUnlikeAnswer');
});

Route::group(['prefix' => 'redeem-code', 'namespace' => 'Users'], function() {
    Route::get('/', 'PrizeCodeController@getIndex');
    Route::post('/redeem', 'PrizeCodeController@postRedeemPrize');
});
