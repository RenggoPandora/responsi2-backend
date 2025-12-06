<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Cross-Origin Resource Sharing (CORS) Configuration
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
 */
class Cors extends BaseConfig
{
    /**
     * The default CORS configuration.
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'allowedOrigins'         => ['*'],
        'allowedOriginsPatterns' => [],
        'allowedHeaders'         => ['*'],
        'allowedMethods'         => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH'],
        'exposedHeaders'         => [],
        'maxAge'                 => 7200,
        'supportsCredentials'    => false,
    ];

    /**
     * The default allowed origins.
     *
     * @var list<string>
     */
    public array $allowedOrigins = ['*'];

    /**
     * The default allowed origins patterns.
     *
     * @var list<string>
     */
    public array $allowedOriginsPatterns = [];

    /**
     * The default allowed headers.
     *
     * @var list<string>
     */
    public array $allowedHeaders = ['*'];

    /**
     * The default allowed methods.
     *
     * @var list<string>
     */
    public array $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH'];

    /**
     * The default exposed headers.
     *
     * @var list<string>
     */
    public array $exposedHeaders = [];

    /**
     * The default max age.
     */
    public int $maxAge = 7200;

    /**
     * The default supports credentials.
     */
    public bool $supportsCredentials = false;
}