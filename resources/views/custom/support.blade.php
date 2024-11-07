@extends('layouts.sup')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /*fakeimg can be removed once replaced*/
        .fakeimg {
            background-color: rgb(59, 183, 237);
            width: 100%;
            padding: 250px;
        }

        .fakeimg2 {
            background-color: rgb(59, 183, 237);
            width: 200px;
            padding: 200px;
            margin: 10px;
        }

        .img-responsive {
          max-width: 100%;
        }

        p {
          align: justify;
          text-indent: .5cm;
          font-size: 16px;
        }

        img {

          margin: 5 5 5 5px;
        }

        /*Table Styling*/
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #B0DFFF;
        text-align: left;
        padding: 10px;
        }

        th {
        background-color:  #B0DFFF;
        }

        tr:hover {background-color: #d6efff;}

        /*Container Styling*/
        .container-bg {
        background: #d6efff;
        padding-bottom: 4px;
        }

        .home-icons  {
        padding: 15px;
        font-size: 20px;
        width: 50px;
        text-align: center;
        text-decoration: none;
        margin: 15px 5px;
        border-radius: 10%;
        }

        .home-icons:hover {
            opacity: 0.7;
            color: white
        }

        .home-icons.fa-deviantart {
        background: #05CC46;
        color: white;
        }

        .home-icons.fa-discord {
        background: #7289DA;
        color: white;
        }

        .home-icons.fa-twitter {
        background: #55ACEE;
        color: white;
        }

        .home-icons.fa-tumblr {
        background: #2c4762;
        color: white;
        }

        .home-icons.fa-patreon {
        background: #f96854;
        color: white;
        }
    </style>
</head>

<body>

    <img style="margin-bottom:10px" width="100%" src="{{ asset('images/iibeach.png') }}"/>


<p align="center">
    Isomara Island is an online Art Role Playing Game️ (ARPG). Members can create a character or adopt a premade one and complete prompts through drawings or written fiction to develop their characters, earn items and virtual currency, and shape the island's future.
</p>

<br>
<div class="hr1"></div><br><br>

<h2>Virtual pet site meets Art creation</h2><img class="float-right" width="35%" src="{{ asset('images/subinit.png') }}"/>

<p>
    Instead of typical pet sites or video games where quests, activities, and all other forms of gameplay are done through clicks and button presses, Isomara Island pushes players to develop their characters and complete activities through artwork and stories. This ARPG mixes the classic pet site gameplay with an on-site submission system for art and literature. Every single peice of art drawn and short adventure written will earn you <a href="/info/currency">in-game currency</a> and other rewards depending on the activity and prompt.
</p>
<br>
<h2>Support Isomara Island to help fund the development</h2>
<p>
    Every dollar sent goes right back into the development of the website and ARPG. Support the developers and artists continued efforts on this ARPG and in return receive in-game items, virtual currency, critters, and luxury of being at the front of the line to register using an Early Access Invitiation Key. Available support packages and tiers can be found further below.
</p>
<br>
<h2>The Species and World</h2>
<p>
    The primary species of the ARPG, Isomara, are fluffy semi-aquatic dragons but are not the only playable characters here. Plenty of unique creatures and wildlife across the island and surrounding sea exist. Develop your character's personality and story by completing prompts, forming families, training their skills, and exploring the vast island and beyond.
    With plenty of activities, prompts to complete, items to collect, and characters to meet and more added regularly, there is much to explore and fun to be had!
</p>
<img style="margin-bottom:10px" width="100%" src="{{ asset('images/bbanner.png') }}"/>
<br><br>
<h2>Activities, Prompts & Games</h2>
<img class="float-left" style="margin-right:10px" width="25%" src="{{ asset('images/playcache.png') }}"/><br>
<p>
    Complete quests by NPCs, explore different biomes across the island, train up stats, and even go lurking for treasure in the cavernous territory of the Queen Memora. There are many activities for Isomara and their companions to do, and completing activities rewards currency that can be spent in shops and materials to craft new items, meals, equipment, and accessories.
</p>
<p>
    Isomara can also enroll in a class in which you can level up by earning experience through activities. When your characters level up, they will gain exclusive class perks and skills, such as heightened item finding and an increased chance to succeed in enemy encounters.
</p>
<p>
    Events will also occur that can tie in various activities and games. Events will often provide lore and context and change the island. Participate in events to have sway in the future of the ARPG..
</p>
<br><br><br>
<p class="mb-2" align="center">
    <iframe width="800" height="450" align="center" src="https://www.youtube.com/embed/NhdQ46LKEDI" frameborder="0" allow="accelerometer; picture-in-picture; web-share" allowfullscreen></iframe>
</p>

<br>
<div class="hr1"></div>

<h2>Tier Packages</h2>

<p>By supporting us you will also be able to claim in-game rewards and join our early access today.</p>

<div class="card character-bio">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="firstTab" data-toggle="tab" href="#first" role="tab">Tier Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="secondTab" data-toggle="tab" href="#second" role="tab">Tier Comparison</a>
            </li>
        </ul>
    </div>
    <div class="card-body tab-content">
        <div class="tab-pane fade show active" id="first">
            <div class="container">
                <div class="wrapper">
                        <div>
                            <div id="list" class="list"><img align="right" height="130px" src="{{ asset('images/Tier1.png') }}"/>
                                <ul>
                                    <br><h5>Gracious Goom · $5 USD</h5>
                                </ul>
                            </div>
                            <p> Have your <b>name on the <a href="/info/credits">Credits page</a></b> as one of the first supporters of Isomara Island. Gracious Goom supporters will also receive the <b>Supporter Badge</b> to display on their account profiles.</p>
                        <br>
                        </div>
                </div>
            </div>
            <div class="container-bg">
                <div class="container">
                    <div class="wrapper">
                        <br>
                            <div>
                                <div id="list" class="list"><img align="left" height="140px" src="{{ asset('images/Tier2.png') }}"/>
                                    <ul>
                                        <h5>Macho Memic · $10 USD</h5>
                                    </ul>
                                </div>
                                <p> Your <b>name in the <a href="/info/credits">Credits</a></b> and the <b>Supporter Badge</b>; Macho Memic tier supporters also receive an <b>Early Access Invitation Key</b>, allowing you to register for an account on Isomara Island and be the begin playing today. An in-game <b>Currency Bundle</b> of 5 Sand Dollars and 500 Seashells will be added to your account once registered too!</p>
                            <br>
                            </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="wrapper">
                    <br>
                        <div>
                            <div id="list" class="list"><img align="right" height="140px" src="{{ asset('images/Tier3.png') }}"/>
                                <ul>
                                    <h5>Turbulent Titan · $20 USD</h5>
                                </ul>
                            </div>
                            <p> Supporters of this tier receive their <b>name in the <a href="/info/credits">Credits</a></b>, the <b>Supporter Badge</b>, an <b>Early Access Invitation Key</b>, an in-game <b>Currency Bundle</b>, the <b>Nightfall Variant - Cloud Hopper</b> critter, and a <b>Queens Conch</b>. The Queens Conch is an in-game item that can be used to adopt one character for free from <a href="/adoptions">The Daycare</a>.</p>
                        <br>
                        </div>
                </div>
            </div>
            <div class="container-bg">
                <div class="container">
                    <div class="wrapper">
                        <br>
                            <div>
                                <div id="list" class="list"><img align="left" height="140px" src="{{ asset('images/Tier4.png') }}"/>
                                    <ul>
                                        <h5>Dazzling Deustrum · $49 USD</h5>
                                    </ul>
                                </div>
                                <p> Be rewarded with everything a Turbulent Titan receives along with a <b>Legendary Fruit Bundle</b> (2 Dragon Fruit & 2 Star Fruit), a <b>Shop Coupon Bundle</b> (one coupon item for Pacings' Shop, Hasha's Hut, Thyme's Taming Tavern, and Charlotte's Iron Emporium), and another critter the legendary <b>Invader Variant - Cloud Hopper</b></p>
                            <br>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="second">
            <table>
                <tr>
                    <th>Supporter Tiers</th>
                    <th>5 USD</th>
                    <th>10 USD</th>
                    <th>20 USD</th>
                    <th>49 USD</th>
                </tr>
                <tr>
                    <td>Name in Credits</td>
                    <td>✔</td>
                    <td>✔</td>
                    <td>✔</td>
                    <td>✔</td>
                </tr>
                <tr>
                    <td>Supporter Badge</td>
                    <td>✔</td>
                    <td>✔</td>
                    <td>✔</td>
                    <td>✔</td>
                </tr>
                <tr>
                    <td>Currency Bundle</td>
                    <td></td>
                    <td>✔</td>
                    <td>✔</td>
                    <td>✔</td>
                </tr>
                <tr>
                    <td>Early Access Invitation Key</td>
                    <td></td>
                    <td>✔</td>
                    <td>✔</td>
                    <td>✔</td>
                </tr>
                <tr>
                    <td>Cloud Hopper - Nightfall Variant Critter</td>
                    <td></td>
                    <td></td>
                    <td>✔</td>
                    <td>✔</td>
                </tr>
                <tr>
                <td>Queens Conch Item</td>
                    <td></td>
                    <td></td>
                    <td>✔</td>
                    <td>✔</td>
                </tr>
                <tr>
                    <td>Legendary Fruit Item Bundle</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>✔</td>
                    </tr>
                <tr>
                    <td>Shop Coupon Item Bundle</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>✔</td>
                </tr>
                <tr>
                    <td>Cloud Hopper - Invader Variant Critter</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>✔</td>
                  </tr>

              </table>



        </div>
    </div>

<hr>
    <div id="smart-button-container">
        <div style="text-align: center;">
          <div style="margin-bottom: 1.25rem;">
            <select id="item-options"><option value="Gracious Goom" price="5">Gracious Goom - 5 USD</option><option value="Macho Memic" price="10">Macho Memic - 10 USD</option><option value="Turbulent Titan" price="20">Turbulent Titan - 20 USD</option><option value="Dazzling Deustrum" price="49">Dazzling Deustrum - 49 USD</option></select>
            <select style="visibility: hidden" id="quantitySelect"></select>
          </div>
            <div id="paypal-button-container"></div>
        <script src="https://www.paypal.com/sdk/js?client-id=Aa2Bqh92dVjybS2C6SsIORGHIPjo-1QblCxiSNukcYCga_N2cFI1DC28pBzYHZoJeJ5zFVwNLTuB_cIH&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
        <script>
            function initPayPalButton() {
                var shipping = 0;
                var itemOptions = document.querySelector("#smart-button-container #item-options");
                var quantity = parseInt();
                var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
                    if (!isNaN(quantity)) {
                        quantitySelect.style.visibility = "visible";
                    }
                    var orderDescription = '';
                    if(orderDescription === '') {
                        orderDescription = 'Item';
                    }
                paypal.Buttons({
                    style: {
                    shape: 'rect',
                    color: 'gold',
                    layout: 'horizontal',
                    label: 'checkout',

                    },
                    createOrder: function(data, actions) {
                    var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
                    var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
                    var tax = (0 === 0 || false) ? 0 : (selectedItemPrice * (parseFloat(0)/100));
                    if(quantitySelect.options.length > 0) {
                        quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
                    } else {
                        quantity = 1;
                    }

                    tax *= quantity;
                    tax = Math.round(tax * 100) / 100;
                    var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
                    priceTotal = Math.round(priceTotal * 100) / 100;
                    var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;

                    return actions.order.create({
                        purchase_units: [{
                        description: orderDescription,
                        amount: {
                            currency_code: 'USD',
                            value: priceTotal,
                            breakdown: {
                            item_total: {
                                currency_code: 'USD',
                                value: itemTotalValue,
                            },
                            shipping: {
                                currency_code: 'USD',
                                value: shipping,
                            },
                            tax_total: {
                                currency_code: 'USD',
                                value: tax,
                            }
                            }
                        },
                        items: [{
                            name: selectedItemDescription,
                            unit_amount: {
                            currency_code: 'USD',
                            value: selectedItemPrice,
                            },
                            quantity: quantity
                        }]
                        }]
                    });
                    },
                    onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                        // Full available details
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                        // Show a success message within this page, e.g.
                        const element = document.getElementById('paypal-button-container');
                        element.innerHTML = '';
                        element.innerHTML = '<h3>Thank you for your payment!</h3><p align="center">Once payment has been sent fill out <a href="https://forms.gle/K7cAPPMwJFZkuRiz9">this form</a> in order to receive your in-game rewards - <a href="https://forms.gle/K7cAPPMwJFZkuRiz9">Reward Redemption & Early Access Sign-Up Form</a>';

                        // Or go to another URL:  actions.redirect('thank_you.html');

                    });
                    },
                    onError: function(err) {
                    console.log(err);
                    },
                    }).render('#paypal-button-container');
                    }
                    initPayPalButton();
        </script>
        </div>
    </div>
<p align="center">All Sales are final. There are absolutely no refunds. <br>You must have parental permission or be 18 or over to make a purchase.</p>
<hr>

</div>

<br>
<div class="hr1"></div>

<h4 class="mb-0">Frequently Asked Questions</h4>

<br>
<p class="mb-2"><strong class="text-primary">Q. How long will the Supporter tier be available for?</strong></p>
<p class="mb-2">A. Supporter tiers will remain available up through 2024. We will provide an update months prior to if we decide on a date to close supporter tier availability.</p>
<br>
<p class="mb-2"><strong class="text-primary">Q. Can I upgrade my tier later?</strong></p>
<p class="mb-2">A. Yes, if you would like to purchase a higher tier, send an email to npc@isomaraisland.com, and we can invoice you the difference in cost.</p>
<br>
<p class="mb-2"><strong class="text-primary">Q. How can I buy a supporter tier for a friend/ multiple tiers?</strong></p>
<p class="mb-2">A. Checkout as normal and send an email to npc@isomaraisland.com letting us know what tiers and how many you purchased. Note we may need additional information to ensure you/friends receive their rewards and invite keys.</p>
<br>
<p class="mb-2"><strong class="text-primary">Q. When will I receive my supporter rewards?</strong></p>
<p class="mb-2">A. Rewards are granted once you have a verified account on <a href="isomaraisland.com">isomaraisland.com</a>. Those who buy a Macho Memic, Turbulent Titan, or Dazzling Deustrum supporter tier will be able to make an account the same day. Those tiers will be receiving an invite key to sign-up through their email. For all those who purchased the Gracious Gooms supporter tier they will need to wait until open registration to make an account and receive their Supporter badge.</p>
<br>
<p class="mb-2"><strong class="text-primary">Q. When is open registration?</strong></p>
<p class="mb-2">A. The first round of Early Access will be limited to those who support us via the $10+ tiers above. Limited Early Access is expected to last at least a few months. We do not have a set date for when registration will be available to all. Keep an eye out for update via our <a href="https://twitter.com/Isomaraarpg">Twitter</a> and <a href="https://discord.gg/62ZGCYFUDu">Discord</a>.</p>
<br>

<p>  If you still have any questions or concerns, please email us at <a href="mailto:npc@isomaraisland.com">npc@isomaraisland.com</a> or toss us a message on <a href="https://twitter.com/Isomaraarpg">Twitter.</a></p>

    <div class="site-footer mt-4" id="footer">
        @include('layouts._footer')
    </div>

</body>
</html>
@endsection
