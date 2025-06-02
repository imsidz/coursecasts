<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    public function groups()
    {
    return $this->belongsToMany(TopicGroup::class, 'topic_group_topic', 'topic_id', 'topic_group_id');
    }

}
