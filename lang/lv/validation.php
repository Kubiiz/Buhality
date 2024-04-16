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

    'accepted' => 'Laukam jābūt apstiprinātam.',
    'accepted_if' => 'Laukam jābūt apstiprinātam, kad :other ir :value.',
    'active_url' => 'Laukam jābūt derīgam URL.',
    'after' => 'Laukam jābūt datumam pēc :date.',
    'after_or_equal' => 'Laukam jābūt datumam pēc vai vienādam ar :date.',
    'alpha' => 'Laukam drīkst saturēt tikai burtus.',
    'alpha_dash' => 'Laukam drīkst saturēt tikai burtus, ciparus, domuzīmes un apakšsvītras.',
    'alpha_num' => 'Laukam drīkst saturēt tikai burtus un ciparus.',
    'array' => 'Laukam jābūt masīvam.',
    'ascii' => 'Laukam drīkst saturēt tikai vienbaita alfa­numeriskos simbolus un simbolus.',
    'before' => 'Laukam jābūt datumam pirms :date.',
    'before_or_equal' => 'Laukam jābūt datumam pirms vai vienādam ar :date.',
    'between' => [
        'array' => 'Laukam jābūt ar :min un :max vienībām.',
        'file' => 'Laukam jābūt starp :min un :max kilobaitiem.',
        'numeric' => 'Laukam jābūt starp :min un :max.',
        'string' => 'Laukam jābūt starp :min un :max rakstzīmēm.',
    ],
    'boolean' => 'Laukam jābūt patiesam vai nepatiesam.',
    'can' => 'Laukā ir neautorizēta vērtība.',
    'confirmed' => 'Lauka apstiprinājums neatbilst.',
    'current_password' => 'Nepareiza parole.',
    'date' => 'Laukam jābūt derīgam datumam.',
    'date_equals' => 'Laukam jābūt datumam, kas vienāds ar :date.',
    'date_format' => 'Laukam jāatbilst formātam :format.',
    'decimal' => 'Laukam jābūt ar :decimal decimālcipariem.',
    'declined' => 'Laukam jābūt noraidītam.',
    'declined_if' => 'Laukam jābūt noraidītam, kad :other ir :value.',
    'different' => 'Laukam un :other jābūt atšķirīgiem.',
    'digits' => 'Laukam jābūt :digits cipariem.',
    'digits_between' => 'Laukam jābūt starp :min un :max cipariem.',
    'dimensions' => 'Lauka attēlam ir nederīgi izmēri.',
    'distinct' => 'Lauka saturs dublējas.',
    'doesnt_end_with' => 'Laukam nedrīkst beigties ar vienu no šiem: :values.',
    'doesnt_start_with' => 'Laukam nedrīkst sākties ar vienu no šiem: :values.',
    'email' => 'Epasta adresei jābūt derīgai.',
    'ends_with' => 'Laukam jābeidzas ar vienu no šiem: :values.',
    'enum' => 'Izvēlētā ir nederīga.',
    'exists' => 'Izvēlētais ir nederīgs.',
    'extensions' => 'Laukam jābūt vienai no šīm paplašinājumiem: :values.',
    'file' => 'Laukam jābūt failam.',
    'filled' => 'Laukam jābūt aizpildītam.',
    'gt' => [
        'array' => 'Laukam jābūt ar vairāk kā :value vienībām.',
        'file' => 'Laukam jābūt lielākam par :value kilobaitiem.',
        'numeric' => 'Laukam jābūt lielākam par :value.',
        'string' => 'Laukam jābūt garākam par :value rakstzīmēm.',
    ],
    'gte' => [
        'array' => 'Laukam jābūt ar vismaz :value vienībām.',
        'file' => 'Laukam jābūt lielākam vai vienādam ar :value kilobaitiem.',
        'numeric' => 'Laukam jābūt lielākam vai vienādam ar :value.',
        'string' => 'Laukam jābūt garākam vai vienādam ar :value rakstzīmēm.',
    ],
    'hex_color' => 'Laukam jābūt derīgai heksadecimālai krāsai.',
    'image' => 'Laukam jābūt attēlam.',
    'in' => 'Lauka saturam jābūt 1',
    'in_array' => 'Lauks jābūt klātienē :other.',
    'integer' => 'Laukam jābūt veselam skaitlim.',
    'ip' => 'Laukam jābūt derīgai IP adreses formai.',
    'ipv4' => 'Laukam jābūt derīgai IPv4 adreses formai.',
    'ipv6' => 'Laukam jābūt derīgai IPv6 adreses formai.',
    'json' => 'Laukam jābūt derīgai JSON virknei.',
    'list' => 'Laukam jābūt sarakstam.',
    'lowercase' => 'Laukam jāsatur tikai mazie burti.',
    'lt' => [
        'array' => 'Laukam jābūt ar mazāk kā :value vienībām.',
        'file' => 'Laukam jābūt mazākam par :value kilobaitiem.',
        'numeric' => 'Laukam jābūt mazākam par :value.',
        'string' => 'Laukam jābūt īsākam par :value rakstzīmēm.',
    ],
    'lte' => [
        'array' => 'Laukam nedrīkst būt ar vairāk kā :value vienībām.',
        'file' => 'Laukam nedrīkst būt lielākam par :value kilobaitiem.',
        'numeric' => 'Laukam nedrīkst būt lielākam par :value.',
        'string' => 'Laukam nedrīkst būt garākam par :value rakstzīmēm.',
    ],
    'mac_address' => 'Laukam jābūt derīgai MAC adreses formai.',
    'max' => [
        'array' => 'Laukam nedrīkst būt ar vairāk kā :max vienībām.',
        'file' => 'Laukam nedrīkst būt lielākam par :max kilobaitiem.',
        'numeric' => 'Lauks nedrīkst būt lielāks par :max.',
        'string' => 'Lauks nedrīkst būt garāks par :max rakstzīmēm.',
    ],
    'max_digits' => 'Laukam nedrīkst būt ar vairāk kā :max cipariem.',
    'mimes' => 'Laukam jābūt failam no šāda veida: :values.',
    'mimetypes' => 'Laukam jābūt failam no šāda veida: :values.',
    'min' => [
        'array' => 'Laukam jābūt ar vismaz :min vienībām.',
        'file' => 'Laukam jābūt vismaz :min kilobaitiem.',
        'numeric' => 'Laukam jābūt vismaz :min.',
        'string' => 'Laukam jāsatur vismaz :min rakstzīmes.',
    ],
    'min_digits' => 'Laukam jābūt ar vismaz :min cipariem.',
    'missing' => 'Laukam jābūt pazudis.',
    'missing_if' => 'Laukam jābūt pazudis, ja :other ir :value.',
    'missing_unless' => 'Laukam jābūt pazudis, ja :other nav :value.',
    'missing_with' => 'Laukam jābūt pazudis, ja ir klāt :values.',
    'missing_with_all' => 'Laukam jābūt pazudis, ja ir klāt :values.',
    'multiple_of' => 'Laukam jābūt vairāku :value reizinājumam.',
    'not_in' => 'Izvēlētais ir nederīgs.',
    'not_regex' => 'Lauka formāts ir nederīgs.',
    'numeric' => 'Laukam jābūt skaitlim.',
    'password' => [
        'letters' => 'Laukam jāsatur vismaz viens burts.',
        'mixed' => 'Laukam jāsatur vismaz viens lielais un viens mazais burts.',
        'numbers' => 'Laukam jāsatur vismaz viens cipars.',
        'symbols' => 'Laukam jāsatur vismaz viens simbols.',
        'uncompromised' => 'Norādītajam ir parādījies datu noplūdes gadījums. Lūdzu, izvēlieties citu.',
    ],
    'present' => 'Laukam jābūt klāt.',
    'present_if' => 'Laukam jābūt klāt, ja :other ir :value.',
    'present_unless' => 'Laukam jābūt klāt, ja :other nav :value.',
    'present_with' => 'Laukam jābūt klāt, ja ir klāt :values.',
    'present_with_all' => 'Laukam jābūt klāt, ja ir klāt :values.',
    'prohibited' => 'Lauka aizliegts.',
    'prohibited_if' => 'Lauka aizliegts, ja :other ir :value.',
    'prohibited_unless' => 'Lauka aizliegts, ja :other nav :value.',
    'prohibits' => 'Lauks aizliedz :other klātbūtni.',
    'regex' => 'Lauka formāts ir nederīgs.',
    'required' => 'Laukam jābūt aizpildītam.',
    'required_array_keys' => 'Laukam jāsatur ieraksti šādiem :values.',
    'required_if' => 'Laukam ir obligāti jābūt aizpildītam, ja :other ir :value.',
    'required_if_accepted' => 'Laukam ir obligāti jābūt aizpildītam, ja :other ir apstiprināts.',
    'required_unless' => 'Laukam ir obligāti jābūt aizpildītam, ja :other nav :values.',
    'required_with' => 'Laukam ir obligāti jābūt aizpildītam, ja ir klāt :values.',
    'required_with_all' => 'Laukam ir obligāti jābūt aizpildītam, ja ir klāt :values.',
    'required_without' => 'Laukam ir obligāti jābūt aizpildītam, ja nav klāt :values.',
    'required_without_all' => 'Laukam ir obligāti jābūt aizpildītam, ja nav klāt neviena no :values.',
    'same' => 'Laukam jāsakrīt ar :other.',
    'size' => [
        'array' => 'Laukam jāsatur :size vienības.',
        'file' => 'Laukam jābūt :size kilobaitiem.',
        'numeric' => 'Laukam jābūt :size.',
        'string' => 'Laukam jābūt :size rakstzīmēm.',
    ],
    'starts_with' => 'Laukam jāsākas ar vienu no šiem: :values.',
    'string' => 'Laukam jāsatur arī burtus.',
    'timezone' => 'Laukam jābūt derīgai laika joslai.',
    'unique' => 'Šis jau ir aizņemts.',
    'uploaded' => 'Lauka augšupielāde neizdevās.',
    'uppercase' => 'Laukam jābūt lielajiem burtiem.',
    'url' => 'Laukam jābūt derīgam URL.',
    'ulid' => 'Laukam jābūt derīgam ULID.',
    'uuid' => 'Laukam jābūt derīgam UUID.',

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
