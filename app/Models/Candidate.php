<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function role() {
        return $this->belongsTo('App\Models\Role');
    }

    public function election() {
        return $this->belongsTo('App\Models\Election');
    }

    protected $guarded = [];

    protected $casts = [
      'contact' => 'array',
        'order' => 'integer',
        'election_id' => 'integer',
        'role_id' => 'integer',
        'approved' => 'boolean',
        'withdrawn' => 'boolean'
    ];
}
