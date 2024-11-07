<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Group Currency Form Fields
    |--------------------------------------------------------------------------
    |
    | The list of fields in the group currency form and their names for display.
    |
    */

    // This is the configuration for the group currency form presented to users when submitting pieces to the gallery.
    // It can be configured to your liking, though this configuration is presented as an example.
    // The precise formula for group currency awards is more or less hardcoded; it takes values from this form
    // and performs basic operations (addition, multiplication) to arrive at the final number.
    // In an effort to make it accessible, the function that countains it has been placed in app/Helpers/AssetHelpers, at the top.

    // Form names shouldn't have spaces, only underscores (_) like these examples.
    // Configuration values are given in pairs of keys and values, arranged like so:
    // 'key' => 'value'
    // and sometimes in arrays, like this:
    // ['key1' => 'value1', 'key2' => 'value2']
    // For multiple choice questions, for example the one immediately below, the options 'art', 'lit', etc
    // are hidden to the user, and the values are displayed instead. Rather, the keys are sent to be processed when
    // the form is submitted. Using this, we can have options that are secretly numeric values for the currency formula,
    // but appear to the user as human-readable options!

    // Each of these has a key, 'label', which corresponds to the form's label as displayed.

    // For convenience, this first field has all the possible options/keys, with each commented on!
    'piece_type' => [
        // This is the name as will be displayed on submissions, not the form itself.
        'name' => 'Type of Piece',
        // This is the label as will be displayed on the form itself, so provide any instruction for the user filling out the form here.
        'label' => 'Piece Type (Select as many as apply)',
        // The type of form. In this case, since the user is picking from several options, it's "choice"!
        'type' => 'choice',
        // These are the choices themselves. The key is what the form outputs, and the value is the text shown to the user.
        'choices' => ['art' => '2D Digital or Traditional Art', 'lit' => 'Writing and Poetry', 'craft' => '3D Model, Craft, or Other Physical Item'],
        // This makes this field required!
        'rules' => 'required',
        // This allows the user to select multiple options! You don't need to set it at all unless you want it to be true,
        // since it will otherwise assume false.
        'multiple' => true,
        // For checkboxes/toggles, this is what the toggle outputs when "on".
        'value' => null,
    ],
    'art_finish' => [
        'name' => 'Level of Finish',
        'label' => 'Level of Finish (For 2D Digital/Traditional Artwork)',
        'type' => 'choice',
        'choices' => ['1' => 'Sketch', '3' => 'Clean Lines or Lineless', '5' => 'Painted'],
    ],
    'chara_vis_hd' => [
        'name' => 'Headshot',
        'label' => 'Headshot Amount:',
        'type' => 'number',
    ],
    'chara_vis_bst' => [
      'name' => 'Bust',
      'label' => 'Bust Amount:',
      'type' => 'number',
    ],
    'chara_vis_fbc' => [
        'name' => 'Full Body Chibi',
        'label' => 'Full Body Chibi Amount:',
        'type' => 'number',
    ],
    'chara_vis_fb' => [
        'name' => 'Full Body',
        'label' => 'Full Body Amount:',
        'type' => 'number',
    ],
    'art_bonus' => [
        'name' => 'Art Bonuses',
        'type' => 'choice',
        'label' => 'Bonus Options (Select as many as apply)',
        // If you wish to have options with all the same value, in this case 1, give them a .1 difference,
        // which can easily be rounded out, but allows for the computer to distinguish between them.
        'choices' => ['5' => 'Colored', '5.1' => 'Simple Shading', '15' => 'Complex Shading', '5.2' => 'Partial Background', '10' => 'Basic Background', '25' => 'Advanced Background', '15.1' => 'Isomara of the Month', '5.3' => 'Companion Species of the Month', '5.4' => 'NPC Included', '10.1' => 'Collaboration'],
        'multiple' => true,
    ],
    'iso_count' => [
        'name' => 'Isomara Count',
        'label' => 'Isomara Count (For Artwork, if the same Isomara appears more than once count them each time)',
        'type' => 'number',
    ],
    'scomp_count' => [
        'name' => 'Small Companion Count',
        'label' => 'Small Companion/Critter Count (For Artwork, if the same character appears more than once count them each time)',
        'type' => 'number',
    ],
    'lcomp_count' => [
        'name' => 'Large Companion Count',
        'label' => 'Large Companion Count (For Artwork, if the same character appears more than once count them each time)',
        'type' => 'number',
    ],
    'base' => [
        'name' => 'On Base/YCH',
        'label' => 'Is this a Base (P2U/F2U) or YCH? (Checkbox for Yes)',
        // This makes the option a toggle!
        'type' => 'checkbox',
        'value' => 1,
    ],
    'activity_bonus' => [
        'name' => 'Activity Bonuses',
        'type' => 'choice',
        'label' => 'Activity Bonus (Select one or none)',
        'choices' => ['0' => 'None', '2' => 'Training', '2.1' => 'Exploration', '5' => 'Voyaging', '5.1' => 'Prompt Pavilion', '20' => 'Event'],
    ],
    'anim_type' => [
        'name' => 'Animation Level',
        'type' => 'choice',
        'label' => 'Animation Level',
        'choices' => ['0' => 'Not an Animation', '20' => 'Basic', '60' => 'Intermediate', '150' => 'Advanced'],
    ],
    'frame_count' => [
        'name' => 'Frame Count',
        'label' => 'Frame Count (For Animations)',
        // This makes a field the user can enter a number in!
        'type' => 'number',
    ],
    'crafts_3d' => [
        'name' => 'Physical Crafts & 3D Bonuses',
        'type' => 'choice',
        'label' => 'Craft & 3D Options (Select as many as apply)',
        'choices' => ['60' => 'General Craft/Simple 3D Model', '120' => 'Enhanced Craft/Complex 3D Model', '15' => 'Textured', '30' => 'Rigged/Posed'],
        'multiple' => true,
    ],
    'word_count' => [
        'name' => 'Word Count',
        'label' => 'Word Count (For Writing, Poetry, or any included Story text)',
        'type' => 'number',
    ],

];
