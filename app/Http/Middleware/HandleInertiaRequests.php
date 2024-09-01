<?php

namespace App\Http\Middleware;

use App\Models\Online;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $onlineCount = Online::select('updated_at')->where('updated_at', '>', now()->subMinutes(10))->count();

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'online' => $onlineCount,
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
