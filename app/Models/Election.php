<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Election extends Authenticatable
{
    use SoftDeletes;
    use HasApiTokens;
    protected $guarded = [];

    protected $casts = [
        'nominations' => 'boolean',
        'shuffle_manifestos' => 'boolean',
        'shuffle_candidates' => 'boolean',
        'description_home' => 'boolean',
        'description_nomination' => 'boolean',
        'custom' => 'array'
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)->firstOrFail();
    }

    /**
     * @return BelongsToMany
     */
    public function managers()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * @return BelongsTo
     */
    public function owner() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function managedBy(User $user) {
        if($user->is($this->owner)) {
            return true;
        }
        foreach ($this->managers as $manager) {
            if($manager->is($user)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return HasMany
     */
    public function roles() {
        return $this->hasMany('App\Models\Role');
    }

    public function voters() {
        return $this->hasMany('App\Models\Voter');
    }

    public function turnout() {
        $voters = Voter::where('election_id', $this->id)->count();
        $ballots = Ballot::where('election_id', $this->id)->count();
        $unique_voters = DB::table('ballots')->select('voter_id')->where('election_id', $this->id)->distinct()->count();
        $turnout = [];
        $turnout['voters'] = $voters;
        $turnout['ballots'] = $ballots;
        $turnout['unique'] = $unique_voters;
        return $turnout;
    }

    public function activeRoles() {
        $today = Carbon::now();
        $activeRoles = [];
        foreach ($this->roles as $role) {
            if ($role->voting_open->lte($today) && $role->voting_close->gt($today)) {
                $activeRoles[] = $role;
            }
        }
        return $activeRoles;
    }
}
