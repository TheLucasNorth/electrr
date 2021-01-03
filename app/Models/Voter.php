<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Voter extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;

    public function election() {
        return $this->belongsTo('App\Models\Election');
    }

    public function username() {
        $string[1] = Str::random(3);
        $string[2] = Str::random(3);
        $string[3] = Str::random(3);
        return Str::upper(implode('-', $string));
    }

    public function safeUsername($election) {
        $dupe = true;
        while ($dupe) {
            $username = $this->username();
            if(!Voter::where('election_id', $election)->where('username', $username)->exists()) {
                $dupe = false;
            }
        }
        return $username;
    }

    public function password() {
        return Str::upper(Str::random(6));
    }

    protected $guarded = [];

    protected $hidden = [
        'password'
    ];
}
