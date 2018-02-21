<?php

declare(strict_types=1);

namespace Cortex\Foundation\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Watson\Validating\ValidationException as WatsonValidationException;

class Handler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return intend([
                'back' => true,
                'with' => ['warning' => trans('cortex/foundation::messages.token_mismatch')],
            ]);
        } elseif ($exception instanceof WatsonValidationException) {
            return intend([
                'back' => true,
                'withInput' => $request->all(),
                'withErrors' => $exception->errors(),
            ]);
        } elseif ($exception instanceof ValidationException) {
            return intend([
                'back' => true,
                'withInput' => $request->all(),
                'withErrors' => $exception->errors(),
            ]);
        } elseif ($exception instanceof GenericException) {
            return intend([
                'url' => $exception->getRedirection() ?? route($request->route('accessarea').'.home'),
                'withInput' => $exception->getInputs() ?? $request->all(),
                'with' => ['warning' => $exception->getMessage()],
            ]);
        } elseif ($exception instanceof AuthorizationException) {
            return intend([
                'url' => in_array($request->route('accessarea'), ['tenantarea', 'managerarea']) ? route('tenantarea.home') : route('frontarea.home'),
                'with' => ['warning' => $exception->getMessage()],
            ]);
        } elseif ($exception instanceof NotFoundHttpException) {
            // Catch localized routes with missing {locale}
            // and redirect them to the correct localized version
            if (config('cortex.foundation.route.locale_redirect')) {
                $originalUrl = $request->url();
                $localizedUrl = app('laravellocalization')->getLocalizedURL(null, $originalUrl);

                try {
                    // Will return `NotFoundHttpException` exception if no match found!
                    app('router')->getRoutes()->match(request()->create($localizedUrl));

                    return intend([
                        'url' => $originalUrl !== $localizedUrl ? $localizedUrl : route($request->route('accessarea').'.home'),
                        'with' => ['warning' => $exception->getMessage()],
                    ]);
                } catch (Exception $exception) {
                }
            }

            return $this->prepareResponse($request, $exception);
        } elseif ($exception instanceof ModelNotFoundException) {
            $area = $request->route('accessarea');
            $model = str_replace('Contract', '', $exception->getModel());
            $single = mb_strtolower(mb_substr($model, mb_strrpos($model, '\\') + 1));
            $plural = str_plural($single);

            return intend([
                'url' => $area ? route("{$area}.{$plural}.index") : route("{$area}.home"),
                'with' => ['warning' => trans('cortex/foundation::messages.resource_not_found', ['resource' => $single, 'id' => $request->route($single)])],
            ]);
        }

        return parent::render($request, $exception);
    }

    /**
     * Render the given HttpException.
     *
     * @param \Symfony\Component\HttpKernel\Exception\HttpException $exception
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpException $exception)
    {
        $status = $exception->getStatusCode();

        if (view()->exists("cortex/foundation::common.errors.{$status}")) {
            return response()->view("cortex/foundation::common.errors.{$status}", ['exception' => $exception], $status, $exception->getHeaders());
        } else {
            return parent::renderHttpException($exception);
        }
    }

    /**
     * Convert a validation exception into a response.
     *
     * @param \Illuminate\Http\Request                   $request
     * @param \Illuminate\Validation\ValidationException $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function invalid($request, ValidationException $exception)
    {
        $url = $exception->redirectTo ?? url()->previous();

        return redirect($url)
            ->withInput($request->except($this->dontFlash))
            ->withErrors(
                $exception->errors(),
                $exception->errorBag
            );
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return intend([
            'url' => route($request->route('accessarea').'.login'),
            'with' => ['warning' => trans('cortex/foundation::messages.session_required')],
        ]);
    }
}
