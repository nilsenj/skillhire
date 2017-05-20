<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @var Profile
     */
    private $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $user = $request->user();
        return response()->json($user->profile, 200);
    }

    /**
     * TODO implement form request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $user = $request->user();
            $profile = $user->profile->update($data);

            return response()->json(['data' => $profile], 200);
        } catch (\Throwable $exception) {
            return response()->json(['data' => 'Error appeared', 'error' => $exception->getMessage()], $exception->getCode());
        }
    }

    /**
     * TODO implement form request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        try {
            $data = $request->all();
            $user = $request->user();
            $user->profile->delete();

            return response()->json(['data' => 'Profile Deleted'], 200);
        } catch (\Throwable $exception) {
            return response()->json(['data' => 'Error appeared', 'error' => $exception->getMessage()], $exception->getCode());
        }
    }
}
