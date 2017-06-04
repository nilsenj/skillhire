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
            $mainTrend = $data['main_trend'];
            $secondTrend = $data['second_trend'];
            $mainTrend = !empty($mainTrend['name']) ? $mainTrend['name'] : '';
            $secondTrend = !empty($secondTrend['name']) ? $secondTrend['name'] : '';
            $formData = [
                'position' => !empty($data['position']) ? $data['position'] : '',
                'salary' => !empty($data['salary']) ? $data['salary'] : 0,
                'experience' => !empty($data['experience']) ? $data['experience'] : '',
                'expectations' => !empty($data['expectations']) ? $data['expectations'] : '',
                'achievement' => !empty($data['achievement']) ? $data['achievement'] : '',
                'experience_time' => !empty($data['experience_time']) ? $data['experience_time'] : 0,
                'main_trend' => $mainTrend,
                'second_trend' => $secondTrend,
                'english_skill' => !empty($data['english_skill']) ? $data['english_skill'] : '',
                'location' => !empty($data['location']) ? $data['location'] : ''
            ];

            $profile = $user->profile->update($formData);

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
