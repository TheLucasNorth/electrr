<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    /**
     *
     */
    public function election() {
        return $this->belongsTo('App\Models\Election');
    }

    public function candidates() {
        return $this->hasMany('App\Models\Candidate');
    }

    public function activeCandidates() {
        return $this->candidates()->where('approved', true)->where('withdrawn', false)->orderBy('order', 'asc')->get();
    }

    public function votes() {
        return $this->hasMany('App\Models\Ballot');
    }

    protected $guarded = [];
}
