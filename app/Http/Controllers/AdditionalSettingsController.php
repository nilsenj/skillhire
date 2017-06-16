<?php

namespace App\Http\Controllers;

use App\Models\AdditionalSettings;
use Illuminate\Http\Request;

class AdditionalSettingsController extends Controller
{
    /**
     * @var AdditionalSettings
     */
    private $settings;

    public function __construct(AdditionalSettings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $user = $request->user();
        return response()->json($user->additionalSettings, 200);
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
            $formData = [
                'subscribe' => !empty($data['subscribe']) ? $data['subscribe'] : 0,
                'stop_list' => !empty($data['stop_list']) ?
                    (is_array($data['stop_list']) ? implode(',', $data['stop_list']) : $data['stop_list']) : ''
            ];
            $settings = $user->additionalSettings->update($formData);

            return response()->json(['data' => $settings], 200);
        } catch (\Throwable $exception) {
            return response()->json(['data' => 'Error appeared', 'error' => $exception->getMessage()], $exception->getCode());
        }
    }
}
