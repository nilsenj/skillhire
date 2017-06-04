<?php

namespace TagsCloud\Tagging\Model;

use App\Models\User;
use App\Models\UserSkillCounter;
use TagsCloud\Tagging\Util;

class UserTagged extends Tagged
{
    protected $table = 'user_tagging_tagged';
    public $tagModel = '';

    protected $with = ['counter'];
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->tagModel = '\TagsCloud\Tagging\Model\\' . (new User())->getShortModelName() . 'Tag';
        $this->taggingUtility = new Util($this->tagModel);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function counter()
    {
        return $this->hasMany(UserSkillCounter::class, 'tagged_id');
    }

    /**
     * Get instance of tag linked to the tagged value
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo($this->tagModel, 'tag_slug', 'slug');
    }

}
