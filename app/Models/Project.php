<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'type_id',
        'url',
        'client',
        'slug',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getRelatedProject()
    {
        return $this->type->projects()->where('id', '!=', $this->id)->get();
    }

    public function getTechnologyIds()
    {
        return $this->technologies->pluck('id')->all();
    }
}
