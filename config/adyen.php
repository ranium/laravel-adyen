<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Adyen Merchant Account
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default adyen merchant account that should be used.
    | Find this at the top of the screen in the Adyen Customer Area,
    | where you will see [YourCompanyAccount] > [YourMerchantAccount].
    |
    */

    'default' => env('ADYEN_MERCHANT_ACCOUNT', 'default'),


    /*
     |-----------------------------------------------------------------------------
     | Default settings for all the merchant accounts (company wide)
     |-----------------------------------------------------------------------------
     |
     | These are the default settings which are merged with account specific settings.
     | To override any of these settings for a specific merchant account, just put the same
     | in the account specific settings array in the "Merchant Accounts" section below.
     |
     | NOTE: Typically the values for most of the below config values will be coming from environment
     | configuration. It is advisable to store all sensitive credentials (like username, password etc.)
     | in the environment file (.env). Example: env('ADYEN_PASSWORD')
     |
     */

    'settings' => [
        'username' => 'REPLACE_WITH_YOUR_WEBSERVICE_USERNAME',
        'password' => 'REPLACE_WITH_YOUR_WEBSERVICE_PASSWORD',
        'environment' => \Adyen\Environment::TEST, // For production use \Adyen\Environment::LIVE
        'skinCode' => 'REPLACE_WITH_YOUR_SKINCODE',
        'hmacSignature' => 'REPLACE_WITH_YOUR_SIGNATURE',
        'currency' => 'GBP',
        'storePayoutUsername' => 'REPLACE_WITH_YOUR_STORE_PAYOUT_USERNAME',
        'storePayoutPassword' => 'REPLACE_WITH_YOUR_STORE_PAYOUT_PASSWORD',
        'reviewPayoutUsername' => 'REPLACE_WITH_YOUR_PAYOUT_USERNAME',
        'reviewPayoutPassword' => 'REPLACE_WITH_YOUR_PAYOUT_PASSWORD',
    ],


    /*
    |--------------------------------------------------------------------------
    | Merchant Accounts
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many merchant "accounts" as you wish.
    | Please note that the merchant account is different from the company account;
    | a company account can have one or more merchant accounts in Adyen.
    |
    | NOTE: Merchant Account specific settings are merged with the "settings" array defined above.
    | Merchant Account specific settings take precedence over "settings" defined above.
    |
    */

    'accounts' => [

        'default' => [
            'merchantAccount' => 'REPLACE_WITH_YOUR_ACCOUNT',
        ],

    ],

];
