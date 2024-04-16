<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Laukam :attribute jābūt apstiprinātam.',
    'accepted_if' => 'Laukam :attribute jābūt apstiprinātam, kad :other ir :value.',
    'active_url' => 'Laukam :attribute jābūt derīgam URL.',
    'after' => 'Laukam :attribute jābūt datumam pēc :date.',
    'after_or_equal' => 'Laukam :attribute jābūt datumam pēc vai vienādam ar :date.',
    'alpha' => 'Laukam :attribute drīkst saturēt tikai burtus.',
    'alpha_dash' => 'Laukam :attribute drīkst saturēt tikai burtus, ciparus, domuzīmes un apakšsvītras.',
    'alpha_num' => 'Laukam :attribute drīkst saturēt tikai burtus un ciparus.',
    'array' => 'Laukam :attribute jābūt masīvam.',
    'ascii' => 'Laukam :attribute drīkst saturēt tikai vienbaita alfa­numeriskos simbolus un simbolus.',
    'before' => 'Laukam :attribute jābūt datumam pirms :date.',
    'before_or_equal' => 'Laukam :attribute jābūt datumam pirms vai vienādam ar :date.',
    'between' => [
        'array' => 'Laukam :attribute jābūt ar :min un :max vienībām.',
        'file' => 'Laukam :attribute jābūt starp :min un :max kilobaitiem.',
        'numeric' => 'Laukam :attribute jābūt starp :min un :max.',
        'string' => 'Laukam :attribute jābūt starp :min un :max rakstzīmēm.',
    ],
    'boolean' => 'Laukam :attribute jābūt patiesam vai nepatiesam.',
    'can' => 'Laukā :attribute ir neautorizēta vērtība.',
    'confirmed' => 'Lauka :attribute apstiprinājums neatbilst.',
    'current_password' => 'Nepareiza parole.',
    'date' => 'Laukam :attribute jābūt derīgam datumam.',
    'date_equals' => 'Laukam :attribute jābūt datumam, kas vienāds ar :date.',
    'date_format' => 'Laukam :attribute jāatbilst formātam :format.',
    'decimal' => 'Laukam :attribute jābūt ar :decimal decimālcipariem.',
    'declined' => 'Laukam :attribute jābūt noraidītam.',
    'declined_if' => 'Laukam :attribute jābūt noraidītam, kad :other ir :value.',
    'different' => 'Laukam :attribute un :other jābūt atšķirīgiem.',
    'digits' => 'Laukam :attribute jābūt :digits cipariem.',
    'digits_between' => 'Laukam :attribute jābūt starp :min un :max cipariem.',
    'dimensions' => 'Lauka :attribute attēlam ir nederīgi izmēri.',
    'distinct' => 'Laukam :attribute ir dublēta vērtība.',
    'doesnt_end_with' => 'Laukam :attribute nedrīkst beigties ar vienu no šiem: :values.',
    'doesnt_start_with' => 'Laukam :attribute nedrīkst sākties ar vienu no šiem: :values.',
    'email' => 'Laukam :attribute jābūt derīgai e-pasta adresei.',
    'ends_with' => 'Laukam :attribute jābeidzas ar vienu no šiem: :values.',
    'enum' => 'Izvēlētā :attribute ir nederīga.',
    'exists' => 'Izvēlētais :attribute ir nederīgs.',
    'extensions' => 'Laukam :attribute jābūt vienai no šīm paplašinājumiem: :values.',
    'file' => 'Laukam :attribute jābūt failam.',
    'filled' => 'Laukam :attribute jābūt aizpildītam.',
    'gt' => [
        'array' => 'Laukam :attribute jābūt ar vairāk kā :value vienībām.',
        'file' => 'Laukam :attribute jābūt lielākam par :value kilobaitiem.',
        'numeric' => 'Laukam :attribute jābūt lielākam par :value.',
        'string' => 'Laukam :attribute jābūt garākam par :value rakstzīmēm.',
    ],
    'gte' => [
        'array' => 'Laukam :attribute jābūt ar vismaz :value vienībām.',
        'file' => 'Laukam :attribute jābūt lielākam vai vienādam ar :value kilobaitiem.',
        'numeric' => 'Laukam :attribute jābūt lielākam vai vienādam ar :value.',
        'string' => 'Laukam :attribute jābūt garākam vai vienādam ar :value rakstzīmēm.',
    ],
    'hex_color' => 'Laukam :attribute jābūt derīgai heksadecimālai krāsai.',
    'image' => 'Laukam :attribute jābūt attēlam.',
    'in' => 'Izvēlētais :attribute ir nederīgs.',
    'in_array' => 'Lauks :attribute jābūt klātienē :other.',
    'integer' => 'Laukam :attribute jābūt veselam skaitlim.',
    'ip' => 'Laukam :attribute jābūt derīgai IP adreses formai.',
    'ipv4' => 'Laukam :attribute jābūt derīgai IPv4 adreses formai.',
    'ipv6' => 'Laukam :attribute jābūt derīgai IPv6 adreses formai.',
    'json' => 'Laukam :attribute jābūt derīgai JSON virknei.',
    'list' => 'Laukam :attribute jābūt sarakstam.',
    'lowercase' => 'Laukam :attribute jābūt mazajiem burtiem.',
    'lt' => [
        'array' => 'Laukam :attribute jābūt ar mazāk kā :value vienībām.',
        'file' => 'Laukam :attribute jābūt mazākam par :value kilobaitiem.',
        'numeric' => 'Laukam :attribute jābūt mazākam par :value.',
        'string' => 'Laukam :attribute jābūt īsākam par :value rakstzīmēm.',
    ],
    'lte' => [
        'array' => 'Laukam :attribute nedrīkst būt ar vairāk kā :value vienībām.',
        'file' => 'Laukam :attribute nedrīkst būt lielākam par :value kilobaitiem.',
        'numeric' => 'Laukam :attribute nedrīkst būt lielākam par :value.',
        'string' => 'Laukam :attribute nedrīkst būt garākam par :value rakstzīmēm.',
    ],
    'mac_address' => 'Laukam :attribute jābūt derīgai MAC adreses formai.',
    'max' => [
        'array' => 'Laukam :attribute nedrīkst būt ar vairāk kā :max vienībām.',
        'file' => 'Laukam :attribute nedrīkst būt lielākam par :max kilobaitiem.',
        'numeric' => 'Laukam :attribute nedrīkst būt lielākam par :max.',
        'string' => 'Laukam :attribute nedrīkst būt garākam par :max rakstzīmēm.',
    ],
    'max_digits' => 'Laukam :attribute nedrīkst būt ar vairāk kā :max cipariem.',
    'mimes' => 'Laukam :attribute jābūt failam no šāda veida: :values.',
    'mimetypes' => 'Laukam :attribute jābūt failam no šāda veida: :values.',
    'min' => [
        'array' => 'Laukam :attribute jābūt ar vismaz :min vienībām.',
        'file' => 'Laukam :attribute jābūt vismaz :min kilobaitiem.',
        'numeric' => 'Laukam :attribute jābūt vismaz :min.',
        'string' => 'Laukam :attribute jābūt vismaz :min rakstzīmēm.',
    ],
    'min_digits' => 'Laukam :attribute jābūt ar vismaz :min cipariem.',
    'missing' => 'Laukam :attribute jābūt pazudis.',
    'missing_if' => 'Laukam :attribute jābūt pazudis, ja :other ir :value.',
    'missing_unless' => 'Laukam :attribute jābūt pazudis, ja :other nav :value.',
    'missing_with' => 'Laukam :attribute jābūt pazudis, ja ir klāt :values.',
    'missing_with_all' => 'Laukam :attribute jābūt pazudis, ja ir klāt :values.',
    'multiple_of' => 'Laukam :attribute jābūt vairāku :value reizinājumam.',
    'not_in' => 'Izvēlētais :attribute ir nederīgs.',
    'not_regex' => 'Lauka :attribute formāts ir nederīgs.',
    'numeric' => 'Laukam :attribute jābūt skaitlim.',
    'password' => [
        'letters' => 'Laukam :attribute jāsatur vismaz viens burts.',
        'mixed' => 'Laukam :attribute jāsatur vismaz viens lielais un viens mazais burts.',
        'numbers' => 'Laukam :attribute jāsatur vismaz viens cipars.',
        'symbols' => 'Laukam :attribute jāsatur vismaz viens simbols.',
        'uncompromised' => 'Norādītajam :attribute ir parādījies datu noplūdes gadījums. Lūdzu, izvēlieties citu :attribute.',
    ],
    'present' => 'Laukam :attribute jābūt klāt.',
    'present_if' => 'Laukam :attribute jābūt klāt, ja :other ir :value.',
    'present_unless' => 'Laukam :attribute jābūt klāt, ja :other nav :value.',
    'present_with' => 'Laukam :attribute jābūt klāt, ja ir klāt :values.',
    'present_with_all' => 'Laukam :attribute jābūt klāt, ja ir klāt :values.',
    'prohibited' => 'Lauka :attribute aizliegts.',
    'prohibited_if' => 'Lauka :attribute aizliegts, ja :other ir :value.',
    'prohibited_unless' => 'Lauka :attribute aizliegts, ja :other nav :value.',
    'prohibits' => 'Lauks :attribute aizliedz :other klātbūtni.',
    'regex' => 'Lauka :attribute formāts ir nederīgs.',
    'required' => 'Laukam :attribute jābūt obligāti aizpildītam.',
    'required_array_keys' => 'Laukam :attribute jāsatur ieraksti šādiem :values.',
    'required_if' => 'Laukam :attribute ir obligāti jābūt aizpildītam, ja :other ir :value.',
    'required_if_accepted' => 'Laukam :attribute ir obligāti jābūt aizpildītam, ja :other ir apstiprināts.',
    'required_unless' => 'Laukam :attribute ir obligāti jābūt aizpildītam, ja :other nav :values.',
    'required_with' => 'Laukam :attribute ir obligāti jābūt aizpildītam, ja ir klāt :values.',
    'required_with_all' => 'Laukam :attribute ir obligāti jābūt aizpildītam, ja ir klāt :values.',
    'required_without' => 'Laukam :attribute ir obligāti jābūt aizpildītam, ja nav klāt :values.',
    'required_without_all' => 'Laukam :attribute ir obligāti jābūt aizpildītam, ja nav klāt neviena no :values.',
    'same' => 'Laukam :attribute jāsakrīt ar :other.',
    'size' => [
        'array' => 'Laukam :attribute jāsatur :size vienības.',
        'file' => 'Laukam :attribute jābūt :size kilobaitiem.',
        'numeric' => 'Laukam :attribute jābūt :size.',
        'string' => 'Laukam :attribute jābūt :size rakstzīmēm.',
    ],
    'starts_with' => 'Laukam :attribute jāsākas ar vienu no šiem: :values.',
    'string' => 'Laukam :attribute jābūt virknei.',
    'timezone' => 'Laukam :attribute jābūt derīgai laika joslai.',
    'unique' => 'Šis :attribute jau ir aizņemts.',
    'uploaded' => 'Lauka :attribute augšupielāde neizdevās.',
    'uppercase' => 'Laukam :attribute jābūt lielajiem burtiem.',
    'url' => 'Laukam :attribute jābūt derīgam URL.',
    'ulid' => 'Laukam :attribute jābūt derīgam ULID.',
    'uuid' => 'Laukam :attribute jābūt derīgam UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
