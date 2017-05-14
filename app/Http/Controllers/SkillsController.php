<?php

namespace App\Http\Controllers;

use App\Models\UserSkillCounter;
use Illuminate\Http\Request;
use TagsCloud\Tagging\Model\Tag;
use TagsCloud\Tagging\Model\UserTag;
use TagsCloud\Tagging\Model\UserTagged;
use TagsCloud\Tagging\Taggable;

/**
 * Class SkillsController
 * @package App\Http\Controllers
 */
class SkillsController extends Controller
{
    /**
     * @var Tag
     */
    private $tag;


    /**
     * SkillsController constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userSkills(Request $request)
    {
        $data = $request->all();
        $search = $request->get('q');
        $data = [];
        if($search) {
            $items = [];
            foreach ($request->user()->tags->toArray() as $item) {
                similar_text($item['slug'], $search, $percent);
                if($percent > 0) {
                    $items[] = $item;
                }
            }
            $data['items'] = $items;
        } else {
            $data['items'] = $request->user()->tags;
        }
        $data['count'] = count($data['items']);

        return response()->json($data);
    }

    /**
     * @param Request $request
     */
    public function updateUserSkills(Request $request) {

        $user = $request->user();
        $taglist = $request->input('tags_list');

        if(is_array($taglist)) {
            if(!empty($taglist['name'])) {
                $taglist = $taglist['name'];
            } else {
                $taglist = implode(',', $taglist);
            }
        }

        if (!empty($taglist)) {
            $request->user()->tag($taglist);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSkillCounter(Request $request)
    {
        $user = $request->user();
        $counter = $request->input('counter');

        $userSkillCounter = new UserSkillCounter();
        $newCounter = $userSkillCounter->find($counter['id'])->update($counter);

        return response()->json(['message' => 'ok', 'data' => $newCounter], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSkill(Request $request)
    {
        $user = $request->user();
        $tag = $request->input('tag');
        $tagUser = UserTag::find($tag['id']);
        if($tagUser->count) {
            $tagUser->decrement('count');
        }
        $tagged = $user->tagged->where('tag_name', $tagUser->name)->first();
        $tagged->delete();

        return response()->json(['message' => 'ok', 'data' => 'Item deleted!'], 200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function all(Request $request)
    {
        $data = $request->all();
        $skills = [];
        $search = $request->get('q');
        if($search) {
            $skills['items'] = UserTag::where('slug', 'LIKE', '%'.$search.'%')->get()->toArray();
        } else {
            $skills['items'] = UserTag::all()->toArray();
        }

        $skills['count'] = count($skills['items']);

        return json_encode($skills);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function show(Request $request, $id)
    {
        $data = $request->all();

        return $this->tag->findOrFail($id)->toJson();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function create(Request $request, $id)
    {
        $data = $request->all();

        return $this->tag->create($data)->toJson();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        return $this->tag->update($data)->toJson();
    }

}
