<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    /**
     * Success redirect with flash message
     */
    protected function successRedirect(string $route, string $message, array $params = []): RedirectResponse
    {
        return redirect()->route($route, $params)->with('success', $message);
    }

    /**
     * Error redirect with message
     */
    protected function errorRedirect(string $route, string $message, array $params = []): RedirectResponse
    {
        return redirect()->route($route, $params)->with('error', $message);
    }

    /**
     * Back with error
     */
    protected function backWithError(string $message): RedirectResponse
    {
        return back()->withInput()->with('error', $message);
    }

    /**
     * Back with success
     */
    protected function backWithSuccess(string $message): RedirectResponse
    {
        return back()->with('success', $message);
    }

    /**
     * Get current institution ID
     */
    protected function institutionId(): ?int
    {
        return auth()->user()?->institution_id;
    }
}