<?php

namespace Modules\Auth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Skip if not JSON response
        if (!$response instanceof \Illuminate\Http\JsonResponse) {
            return $response;
        }

        $responseData = $response->getData(true);

        // If response is already formatted, return as is
        if (isset($responseData['success'])) {
            return $response;
        }

        // Format the response
        $formattedResponse = [
            'success' => $response->isSuccessful(),
            'data' => $responseData,
        ];

        if (!$response->isSuccessful() && isset($responseData['message'])) {
            $formattedResponse['message'] = $responseData['message'];
            unset($formattedResponse['data']['message']);
        }

        if (empty($formattedResponse['data']) || (is_array($formattedResponse['data']) && count($formattedResponse['data']) === 0)) {
            $formattedResponse['data'] = null;
        }

        return $response->setData($formattedResponse);
    }
} 