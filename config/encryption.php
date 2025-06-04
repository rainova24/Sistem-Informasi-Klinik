<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */
    
    'key' => env('APP_KEY'),
    
    /*
    |--------------------------------------------------------------------------
    | Encryption Cipher
    |--------------------------------------------------------------------------
    |
    | This option controls the default encryption cipher that will be used to
    | encrypt data. Supported ciphers are AES-128-CBC, AES-256-CBC, and
    | AES-256-GCM. The AES-256-CBC is the most secure option.
    |
    */
    
    'cipher' => 'AES-256-CBC',
    
    /*
    |--------------------------------------------------------------------------
    | Encryption Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the encryption driver that will be utilized.
    | This driver manages the encryption keys and ciphers used for
    | encrypting and decrypting values.
    |
    | Supported: "openssl", "sodium"
    |
    */
    
    'driver' => 'openssl',
    
    /*
    |--------------------------------------------------------------------------
    | Encryption Block Cipher Mode
    |--------------------------------------------------------------------------
    |
    | This option controls the block cipher mode that will be used to encrypt
    | data. The CBC mode is the most secure mode available.
    |
    */
    
    'block_mode' => 'CBC',
    
    /*
    |--------------------------------------------------------------------------
    | Encryption Key Length
    |--------------------------------------------------------------------------
    |
    | This option controls the key length used for encryption. A longer key
    | provides more security but may impact performance.
    |
    */
    
    'key_length' => 256,
];