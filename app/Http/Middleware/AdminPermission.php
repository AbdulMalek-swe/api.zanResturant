<?php

namespace App\Http\Middleware;

use App\Helpers\HttpResponseHelper;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class AdminPermission
{
    /* admin permission */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                $errorArray = ['User not found'];
                return HttpResponseHelper::errorResponse($errorArray, 404);
            }
        } catch (TokenExpiredException $e) {
            $errorArray = ['Your session has expired. Please log in again'];
            return HttpResponseHelper::errorResponse($errorArray, 401);
        } catch (TokenInvalidException $e) {
            $errorArray = ['The token provided is invalid. Please check your login details.'];
            return HttpResponseHelper::errorResponse($errorArray, 401);
        } catch (JWTException $e) {
            $errorArray = ['No token was provided. Please log in to receive a token.'];
            return HttpResponseHelper::errorResponse($errorArray, 401);
        } catch (Exception $e) {
            $errorArray = [$e->getMessage()];
            return HttpResponseHelper::errorResponse($errorArray, 500);
        }
        return $next($request);
    }
}
