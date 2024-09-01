<?php

namespace App\Actions;

use App\Models\Online;

class UpdateOnline
{
    public function handle(string $last_place)
    {
        $request = request();

        // get browser and os
        $browser = $request->header('User-Agent');
        $os = $request->header('Sec-Ch-Ua-Platform');

        $online = Online::where('user_id', auth()->id())->first();

        if (!$online) {
            $online = Online::create([
                'user_id' => auth()->id(),
                'last_place' => $last_place,
                'browser' => $browser,
                'os' => $os,
            ]);

            return $online;
        }

        $data = [
            'last_place' => $last_place,
            'updated_at' => now(),
        ];

        if (now()->diffInMinutes($online->updated_at) > 10 && $online->browser !== $browser && $online->os !== $os) {
            $data['browser'] = $browser;
            $data['os'] = $os;
        }

        $online->update($data);
    }
}
