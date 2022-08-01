<?php declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | PseudoCA Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for pseudoca class maker.
    |
    */

    'usecase_namespace' => env('PSEUDOCA_USECASE_NS', '\UseCases'),
    'request_namespace' => env('PSEUDOCA_REQUEST_NS', '\Http\Requests'),
    'resource_namespace' => env('PSEUDOCA_RESOURCE_NS', '\Http\Resources'),
    'usecase_suffix' => env('PSEUDOCA_USECASE_SUFFIX', 'Usecase'),
    'request_suffix' => env('PSEUDOCA_REQUEST_SUFFIX', 'Request'),
    'resource_suffix' => env('PSEUDOCA_RESOURCE_SUFFIX', 'Resource'),
];
