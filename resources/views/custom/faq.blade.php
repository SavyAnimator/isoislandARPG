@extends('layouts.app')



@section('content')
<!--{!! breadcrumbs(['faq' => url('faq') ]) !!}-->
<h1>Frequently Asked Questions</h1>


<p>Have questions about the species, site, rules, or games, or are just not sure about something?
    Here are the most commonly asked questions. For any other questions and concerns, head over to the  <a href="/reports/bug-reports">Support Center</a>.</p>
<hr>

<h4 class="mb-0">General Questions</h4>
    <br>
<p class="mb-2"><strong class="text-primary">What is an 'Isomara'?</strong></p>
<p class="mb-2">
    Isomara, or for short Iso, are semi-aquatic mammals with huge paws and manes. They are often classified as dragons. They have feathered wings and large rounded canine teeth. You can learn more about Isomara and the other island species <a href="/info/inhabitants">here</a>.
</p>
    <br>
<p class="mb-2"><strong class="text-primary">How much would an Isomara cost, and how do I get one?</strong></p>
<p class="mb-2">
    Isomara can be acquired in many different ways this is covered in our  <a href="/guide">Beginner's Guide: Getting Started</a>. Prices range based on design and traits.
</p>
@if(Auth::user())
<a href="/hunts/targets/ZnxZ2xGa10"><img style="position: fixed; z-index: 4; bottom: 10%; right: 32%;" src="/images/data/items/218-image.png" alt="Grasshopper" height="100"/></a>
@else
@endif
<br>
<p class="mb-2"><strong class="text-primary">What's an ARPG?</strong></p>
<p class="mb-2">
    An ARPG or Art Role Playing Game in this sense is an art-driven game where you can fulfill prompts, events, and other activities while owning an original species and taking care of them as if they were real. In a sense, by completing prompts and games you develop your character.
</p>
<br>
<p class="mb-2"><strong class="text-primary">Do I have to participate in the ARPG if I own an Isomara?</strong></p>
<p class="mb-2">
    No, you don't even have to be in the group if you own one, it's all purely optional, and if you do happen to want to participate in the group you can at any time!
    The group also functions as an average closed species group, so feel free to submit any art or literature you make that contains any Isomara or other <a href="/info/inhabitants">Island Inhabitants</a>.
</p>
<br>
<p class="mb-2"><strong class="text-primary">What are Seashells and Sand Dollars?</strong></p>
<p class="mb-2">
    They are the <a href="/info/currency">In-game Currency</a> used for most transactions within the site.
</p>
<br>
<p class="mb-2"><strong class="text-primary">I'm more of an author than a visual artist does this ARPG support literature?</strong></p>
<p class="mb-2">
    Yes, Isomara-Island does support written works. All activities and events have alternate writing criteria, so whether someone wants to draw or write is up to them.
    We also have <a href="/forum">forums</a> designed for collaborations and solo stories to bring forth a better RP option to our community if they would like to publicly collaborate and write stories for this ARPG.
</p>
<br>
<p class="mb-2"><strong class="text-primary">How do I transfer ownership of an Isomara, Isoling, Egg, and/or Companion species?</strong></p>
<p class="mb-2">
    From your account profile select characters > choose the character > select transfer > enter in the new owner's account username or URL if they are offsite.
</p>
<br>
<p class="mb-2"><strong class="text-primary">I am earning items, but how do I see all items I own?</strong></p>
<p class="mb-2">
    From your account profile, there will be an inventory box. You can view all items you own there. In addition to inventory, there are boxes for Equipment, Accessories, and Critters.
</p>
    <br>
<p class="mb-2"><strong class="text-primary">Where can I go to remove all items from my inventory?</strong></p>
<p class="mb-2">
   From your inventory, you can select items and choose to transfer them to another user, sell them for seashells, or donate them to <a href="/shops/donation-shop">Darwin's Donations</a> for other users to grab.
</p>
<hr>
<br>
<h4 class="mb-0">Design Questions</h4>

    <br>
<p class="mb-2"><strong class="text-primary">Can Isomara wear clothing?</strong></p>
<p class="mb-2">
    Yes, although they are not materialistic by nature, Isomara may wear accessories and clothes if they craft their own.
    You are still allowed to draw clothes and accessories on your characters, but they will not be considered canon for the game unless the accessories are equipped on the characters official masterlist. You can buy clothes and accessories at <a href="/shops/8">Carmen's Fabrication Station</a>.
</p>
    <br>
<p class="mb-2"><strong class="text-primary">Can I change my Isomara's design?</strong></p>
<p class="mb-2">
    Redesigning Isomaras and other companions are very limited. We have some items such as Shears and Eyedrops which can be used on Isomara.
    We are working on granting players more freedom when it comes to color and design alteration, but for now, you may draw your characters so they may be simpler/ easier for you to draw, but don't stray too far from the original reference.
    Hairstyle changes are always allowed feel free to braid their hair, mane, and add ponytails and small basic clips. Trait changes are not allowed unless an item has been used or an event/activity grants you the ability to change your character's traits.
</p>
    <br>
<p class="mb-2"><strong class="text-primary">I made a MYO design and don't like it can I redesign it?</strong></p>
<p class="mb-2">
    Everyone gets one (1) free makeover, so if you happen to not like the MYO after you've designed it and it's official, you may give it a makeover (You may have someone else create/remake your MYO). For more information see to the <a href="/design">Character Design Guide</a>.
</p>
    <br>
<p class="mb-2"><strong class="text-primary">What part of an Isomara needs to be White?</strong></p>
<p class="mb-2">
    An Isomara's claws, teeth, mane, horns, inside ear fluff, wings, and underside of tails need to be white (long tails need to be nearly fully white).
    There is a Special Trait called Dyed Whites which allows the whites of an Isomara to be colored from birth or earned through being exiled. For more explanations and examples read the info card here- Mandatory Whites
</p>
<hr>
<br>
<h4 class="mb-0">Basic F.A.Q.</h4>

    <br>
<p class="mb-2"><strong class="text-primary">What are MYOs?</strong></p>
<p class="mb-2">
    Make-Your-Own or MYO is a way for you to make your own design of a species. View the <a href="/info/myo">MYO Slot Information</a> guide to read up on how to earn or buy a MYO slot.
</p>
    <br>
<p class="mb-2"><strong class="text-primary">What is a DTA?</strong></p>
<p class="mb-2">
    A DTA or Draw-to-Adopt is an alternate way to adopt a design. Instead of paying seashells or in-real-life money, you draw for a chance to adopt it.
    Out of all the entries, submitted the staff will pick one person and they will win the design. At times, there will be runner-up prizes such as other designs and MYO slots.
</p>
@endsection
