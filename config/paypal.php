<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'live'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', 'AbXoLb-ACd-HRAcmO-d74QB1maHCqgVB9l70webofHGhpfxDVKn8bUrixa4Ew2GEvNGpIpTSWvfxTf-t'),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', '3BtgL2P08Thmoh2kU3v7UAPiWZzXzVozIKjooftJW8hAPX2CxrcsyL5dM4gwWhBiAkODDFme0hjD5'),
        'app_id'            => env('PAYPAL_SANDBOX_APP_ID', ''),
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', 'Acnp03PfPoNqviYKLZ_FwS6-BeK78EWIimuqsOAazcpec9_EZC1BmOCXUGZaSa1yYAS1YoW6-quIS6fc'),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', 'EAXl0pNH5tZHtHoWUZtAzp03IsFY6NVoCgje1rW2bofyQH37XNGDh5OtHvbBjapSfcmoo1FRoGBUQdtQ'),
        'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
