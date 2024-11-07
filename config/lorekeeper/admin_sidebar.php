<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Sidebar Links
    |--------------------------------------------------------------------------
    |
    | Admin panel sidebar links.
    | Add links here to have them show up in the admin panel.
    | Users that do not have the listed power will not be able to
    | view the links in that section.
    |
    */

    'Admin'      => [
        'power' => 'admin',
        'links' => [
            [
                'name' => 'User Ranks',
                'url' => 'admin/users/ranks'
            ],
            [
                'name' => 'Admin Logs',
                'url' => 'admin/logs'
            ]
        ]
    ],
    'Reports'    => [
        'power' => 'manage_reports',
        'links' => [
            [
                'name' => 'Report Queue',
                'url' => 'admin/reports/pending'
            ]
        ]
    ],
    'Site'       => [
        'power' => 'edit_pages',
        'links' => [
            [
                'name' => 'News',
                'url' => 'admin/news'
            ],
            [
                'name' => 'Sales',
                'url' => 'admin/sales'
            ],
            [
                'name' => 'Pages',
                'url' => 'admin/pages'
            ],
            [
                'name' => 'Forms & Polls',
                'url' => 'admin/forms'
            ],
        ]
    ],
    'Users'      => [
        'power' => 'edit_user_info',
        'links' => [
            [
                'name' => 'User Index',
                'url' => 'admin/users'
            ],
            [
                'name' => 'Invitation Keys',
                'url' => 'admin/invitations'
            ],
        ]
    ],
    'Queues'     => [
        'power' => 'manage_submissions',
        'links' => [
            [
                'name' => 'Gallery Submissions',
                'url' => 'admin/gallery/submissions'
            ],
            [
                'name' => 'Gallery Currency Awards',
                'url' => 'admin/gallery/currency'
            ],
            [
                'name' => 'Prompt Submissions',
                'url' => 'admin/submissions'
            ],
            [
                'name' => 'Claim Submissions',
                'url' => 'admin/claims'
            ],
            [
                'name' => 'Donated Characters',
                'url' => 'admin/surrenders/pending'
            ],
        ]
    ],
    'Grants'     => [
        'power' => 'edit_inventories',
        'links' => [
            [
                'name' => 'Currency Grants',
                'url' => 'admin/grants/user-currency'
            ],
            [
                'name' => 'Item Grants',
                'url' => 'admin/grants/items'
            ],
            [
                'name' => 'Recipe Grants',
                'url' => 'admin/grants/recipes'
            ],
            [
                'name' => 'EXP Grants',
                'url' => 'admin/grants/exp'
            ],
            [
                'name' => 'Critter Grants',
                'url' => 'admin/grants/pets'
            ],
            [
                'name' => 'Accessory Grants',
                'url' => 'admin/grants/gear'
            ],
            [
                'name' => 'Equipment Grants',
                'url' => 'admin/grants/weapons'
            ],
            [
                'name' => 'Award Grants',
                'url' => 'admin/grants/awards'
            ],
            [
                'name' => 'Skill Grants',
                'url' => 'admin/grants/skills'
            ],
            [
                'name' => 'Patreon Rewards',
                'url' => 'admin/patreon/rewards'
            ],
        ]
    ],
    'Foraging' => [
        'power' => 'edit_inventories',
        'links' => [
            [
                'name' => 'Forages',
                'url' => 'admin/data/forages'
            ],
        ]
    ],
    'Masterlist' => [
        'power' => 'manage_characters',
        'links' => [
            [
                'name' => 'Create Character',
                'url' => 'admin/masterlist/create-character'
            ],
            [
                'name' => 'Create MYO Slot',
                'url' => 'admin/masterlist/create-myo'
            ],
            [
                'name' => 'Manage Lineages',
                'url' => 'admin/masterlist/lineages'
            ],
            [
                'name' => 'Character Transfers',
                'url' => 'admin/masterlist/transfers/incoming'
            ],
            [
                'name' => 'Character Trades',
                'url' => 'admin/masterlist/trades/incoming'
            ],
            [
                'name' => 'Design Updates',
                'url' => 'admin/design-approvals/pending'
            ],
            [
                'name' => 'MYO Approvals',
                'url' => 'admin/myo-approvals/pending'
            ],
        ]
    ],
    'Stats' => [
        'power' => 'edit_stats',
        'links' => [
            [
                'name' => 'Stats',
                'url' => 'admin/stats'
            ],
        ]
    ],
    'Levels' => [
        'power' => 'edit_levels',
        'links' => [
            [
                'name' => 'User Levels',
                'url' => 'admin/levels/user'
            ],
            [
                'name' => 'Character Levels',
                'url' => 'admin/levels/character'
            ],
        ]
    ],
    'Data'       => [
        'power' => 'edit_data',
        'links' => [
            [
                'name' => 'Galleries',
                'url' => 'admin/data/galleries'
            ],
            [
                'name' => 'Award Categories',
                'url' => 'admin/data/award-categories'
            ],
            [
                'name' => 'Awards',
                'url' => 'admin/data/awards'
            ],
            [
                'name' => 'Character Categories',
                'url' => 'admin/data/character-categories'
            ],
            [
                'name' => 'Sub Masterlists',
                'url' => 'admin/data/sublists'
            ],
            [
                'name' => 'Rarities',
                'url' => 'admin/data/rarities'
            ],
            [
                'name' => 'Species',
                'url' => 'admin/data/species'
            ],
            [
                'name' => 'Subtypes',
                'url' => 'admin/data/subtypes'
            ],
            [
                'name' => 'Character Drops',
                'url' => 'admin/data/character-drops'
            ],
            [
                'name' => 'Traits',
                'url' => 'admin/data/traits'
            ],
            [
                'name' => 'Ailments',
                'url' => 'admin/data/status-effects'
            ],
            [
                'name' => 'Shops',
                'url' => 'admin/data/shops'
            ],
            [
                'name' => 'Adoption Center',
                'url' => 'admin/data/adoptions/edit/1'
            ],
            [
                'name' => 'Adopts',
                'url' => 'admin/data/stock'
            ],
            [
                'name' => 'Prompt Categories',
                'url' => 'admin/data/prompt-categories'
            ],
            [
                'name' => 'Dailies',
                'url' => 'admin/data/dailies'
            ],
            [
                'name' => 'Currencies',
                'url' => 'admin/data/currencies'
            ],
            [
                'name' => 'Prompts',
                'url' => 'admin/data/prompts'
            ],
            [
                'name' => 'Loot Tables',
                'url' => 'admin/data/loot-tables'
            ],
            [
                'name' => 'Items',
                'url' => 'admin/data/items'
            ],
            [
                'name' => 'Scavenger Hunts',
                'url' => 'admin/data/hunts'
            ],
            [
                'name' => 'Recipes',
                'url' => 'admin/data/recipes'
            ],
            [
                'name' => 'Critters',
                'url' => 'admin/data/pets'
            ],
            [
                'name' => 'Advent Calendars',
                'url' => 'admin/data/advent-calendars'
            ],
            [
                'name' => 'MYO Shop',
                'url'  => 'admin/data/products'
            ],
            [
                'name' => 'Garden Plots',
                'url' => 'admin/data/plots'
            ],
            [
                'name' => 'Referrals',
                'url' => 'admin/data/referrals'
            ],
            [
                'name' => 'Codes',
                'url' => 'admin/prizecodes'
            ]
        ]
    ],
    'Equipment' => [
        'power' => 'edit_claymores',
        'links' => [
            [
                'name' => 'Accessory',
                'url' => 'admin/gear'
            ],
            [
                'name' => 'Equipment',
                'url' => 'admin/weapon'
            ],
            [
                'name' => 'Character Classes',
                'url' => 'admin/character-classes'
            ],
            [
                'name' => 'Character Skills',
                'url' => 'admin/data/skills'
            ],
            [
                'name' => 'Forums',
                'url' => 'admin/forums'
            ]
        ],
    ],
    'Raffles'    => [
        'power' => 'manage_raffles',
        'links' => [
            [
                'name' => 'Raffles',
                'url' => 'admin/raffles'
            ],
        ]
    ],
    'Settings'   => [
        'power' => 'edit_site_settings',
        'links' => [
            [
                'name' => 'Site Settings',
                'url' => 'admin/settings'
            ],
            [
                'name' => 'Site Images',
                'url' => 'admin/images'
            ],
            [
                'name' => 'File Manager',
                'url' => 'admin/files'
            ],
            [
                'name' => 'Theme Manager',
                'url' => 'admin/themes'
            ],
        ]
    ],
];
