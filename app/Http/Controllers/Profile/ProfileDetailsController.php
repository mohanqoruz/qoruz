<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Profiles\Models\Profile;
use App\Http\Controllers\Controller;
use App\Profiles\Exceptions\ProfileDoesNotExist;

class ProfileDetailsController extends Controller
{
    /**
     * Get qoruz profile details
     */
    public function showProfile(Request $request)
    {
        $profile = null;

        if ($request->has('profile_id')) {
            $profile = Profile::find($request->profile_id);
        }

        if ($request->has('handle')) {
            $profile = Profile::findHandle($request->handle);
        }

        if (! $profile) {
            throw ProfileDoesNotExist::create($request);
        }

        return $profile;
    }
}
