<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicGroup extends Model
{
    protected $table = 'topic_groups';

    protected $fillable = ['name'];
    
    public $timestamps = false;

public function topics()
{
    return $this->belongsToMany(Topic::class, 'topic_group_topic', 'topic_group_id', 'topic_id');
}


public function users()
{
    return $this->belongsToMany(User::class);
}


}
