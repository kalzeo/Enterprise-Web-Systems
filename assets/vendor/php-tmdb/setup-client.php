<?php
/**
 * Script to setup a client connection to the TMDB API using the php-TMDB wrapper.
 * @see https://github.com/php-tmdb/api
 */

use Tmdb\Client;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\AcceptJsonRequestListener;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener;
use Tmdb\Event\Listener\Request\UserAgentRequestListener;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Token\Api\BearerToken;

// Define the API & Bearer tokens.
define("TMDB_BEARER_TOKEN", getenv("TMDB_BEARER"));
define("TMDB_API_KEY", getenv("TMDB_API"));

// Determines which kind of token is used, Bearer tokens are preferred since they're more updated.
$token = defined("TMDB_BEARER_TOKEN") && TMDB_BEARER_TOKEN !== "TMDB_BEARER_TOKEN" ?
    new BearerToken(TMDB_BEARER_TOKEN) :
    new ApiToken(TMDB_API_KEY);

$ed = new Symfony\Component\EventDispatcher\EventDispatcher();

// Create the client connection.
$client = new Client(
    [
        /** @var ApiToken|BearerToken */
        "api_token" => $token,
        "event_dispatcher" => [
            'adapter' => $ed
        ],
        // We make use of PSR-17 and PSR-18 auto discovery to automatically guess these, but preferably set these explicitly.
        "http" => [
            "client" => null,
            "request_factory" => null,
            "response_factory" => null,
            "stream_factory" => null,
            "uri_factory" => null
        ]
    ]
);


// Required event listeners and events to be registered with the PSR-14 Event Dispatcher.
$requestListener = new RequestListener($client->getHttpClient(), $ed);
$ed->addListener(RequestEvent::class, $requestListener);

$apiTokenListener = new ApiTokenRequestListener($client->getToken());
$ed->addListener(BeforeRequestEvent::class, $apiTokenListener);

$acceptJsonListener = new AcceptJsonRequestListener();
$ed->addListener(BeforeRequestEvent::class, $acceptJsonListener);

$jsonContentTypeListener = new ContentTypeJsonRequestListener();
$ed->addListener(BeforeRequestEvent::class, $jsonContentTypeListener);

$userAgentListener = new UserAgentRequestListener();
$ed->addListener(BeforeRequestEvent::class, $userAgentListener);

return $client;