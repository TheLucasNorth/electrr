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

    public function election()
    {
        return $this->belongsTo('App\Models\Election');
    }

    /**
     * Sets the format for the username
     * @return string
     */
    public function username()
    {
        $string[1] = Str::random(3);
        $string[2] = Str::random(3);
        $string[3] = Str::random(3);
        return Str::upper(implode('-', $string));
    }

    /**
     * Generates and returns a username, making sure it is unique in the election
     * @param $election
     * @return string
     */
    public function safeUsername($election)
    {
        $dupe = true;
        while ($dupe) {
            $username = $this->username();
            if (!Voter::where('election_id', $election)->where('username', $username)->exists()) {
                $dupe = false;
            }
        }
        return $username;
    }

    /**
     * Generates and returns a password according to the format desccribed here.
     * @return string
     */
    public function password()
    {
        return Str::upper(Str::random(6));
    }

    protected $guarded = [];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'voted' => 'boolean',
        'delivered' => 'boolean',
        'opened' => 'boolean',
        'unsubscribed' => 'boolean',
        'complained' => 'boolean',
        'bounced' => 'boolean',
        'election_id' => 'integer'
    ];
}
