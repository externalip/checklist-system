<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        // Get Form Names & IDs
        $forms = DB::table('forms')->select('id', 'form_name')->get();

        // Return shared props
        return array_merge(parent::share($request), [
            'auth.user' => fn () => $request->user()
                ? $request->user()->only('id', 'username', 'role_id')
                : null,
            'auth.employee' => fn () => $request->user()
                ? $request->user()->employee
                : null,
            'sharedForms' => $forms,
        ]);
    }
}
