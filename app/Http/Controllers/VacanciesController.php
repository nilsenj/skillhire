<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;

/**
 * Class VacanciesController
 * @package App\Http\Controllers
 */
class VacanciesController extends Controller
{
    /**
     * @var Vacancy
     */
    private $vacancy;

    /**
     * VacanciesController constructor.
     * @param Vacancy $vacancy
     */
    public function __construct(Vacancy $vacancy)
    {
        $this->vacancy = $vacancy;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function all(Request $request)
    {
        $data = $request->all();
        $vacancies = [];
        $vacancies['items'] = $this->vacancy->all()->toArray();
        $vacancies['count'] = $this->vacancy->count();

        return json_encode($vacancies);
    }

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function byUser(Request $request, $id = null)
    {
        if(!$id && $request->user()->exists())
        {
            $user = $request->user();
        } else {
            $user = User::findOrFail($id);
        }
        $userTrend = $user->profile->main_trend;
        $vacancies = $this->vacancy->where('main_trend', $userTrend)->get();

        return response()->json($vacancies);
    }

    /**
     * @param Request $request
     * @param null $location
     * @return \Illuminate\Http\JsonResponse
     */
    public function byLocation(Request $request, $location = null)
    {
        $vacancies = $this->vacancy->where('location', $location)->get();

        return response()->json($vacancies);
    }

    /**
     * @param Request $request
     * @param null $trend
     * @return \Illuminate\Http\JsonResponse
     */
    public function byTrend(Request $request, $trend = null)
    {
        $vacancies = $this->vacancy->where('main_trend', $trend)->get();

        return response()->json($vacancies);
    }

    /**
     * @param Request $request
     * @param null $variant
     * @return \Illuminate\Http\JsonResponse
     */
    public function byVariant(Request $request, $variant = null)
    {
        $vacancies = $this->vacancy->where('working_variant', $variant)->get();

        return response()->json($vacancies);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistinctLocations(Request $request)
    {
        $data = $request->all();
        $locations = $this->vacancy->distinct('location')->select('location')->take(10)->pluck('location');
        $locationsData = [];
        foreach ($locations as $location) {
           $locationsData[]['name'] = $location;
        }

        return response()->json($locationsData);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function show(Request $request, $id)
    {
        $data = $request->all();

        return $this->vacancy->findOrFail($id)->toJson();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function create(Request $request, $id)
    {
        $data = $request->all();

        return $this->vacancy->create($data)->toJson();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        return $this->vacancy->update($data)->toJson();
    }

}
