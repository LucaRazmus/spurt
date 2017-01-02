<?php

namespace Spurt\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class EnvironmentHeadersOnResponse{
    public function __invoke(Request $request, Response $response, $next)
    {
        /** @var Response $response */
        $response = $next($request, $response);

        if(stripos($response->getHeader('Content-Type')[0], 'application/json') !== false){

            $body = $response->getBody();
            $body->rewind();

            $json = json_decode($body->getContents(), true);

            $json['Environment'] = [
                'Hostname' => gethostname(),
                'Time' => [
                    'Exec' => number_format(microtime(true) - APP_START, 4) . " sec"
                ]
            ];
            return $response->withJson($json);
        }

        return $response;
    }
}