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
        $data = $request->all();
        if(!$id && $request->user()->exists())
        {
            $user = $request->user();
        } else {
            $user = User::findOrFail($id);
        }
        $userTags = $request->user()->tags->toArray();
        $data = [];

        return response()->json($data);
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
