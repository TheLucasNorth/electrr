<?php

namespace Tests\Feature;

use App\Models\Election;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class VotersTest extends TestCase
{
    use RefreshDatabase;

//    /** @test */
//    public function canBulkAdd100Voters()
//    {
//        $this->withoutExceptionHandling();
//        $user = User::factory()->create();
//        $response = $this->actingAs($user)->post('/api/elections', [
//            'slug' => 'slug',
//            'name' => 'name',
//            'description' => 'description',
//            'email' => 'email@example.com',
//            'imprint' => 'imprint'
//        ]);
//        $response->assertCreated();
//        $this->assertCount(1, Election::all());
//        $time_pre = microtime(true);
//        $voter = $this->actingAs($user)->post('/api/elections/slug/voters/factory', [
//            'quantity' => 100
//        ]);
//        $time_post = microtime(true);
//        $exec_time = $time_post - $time_pre;
//        $voter->assertNoContent();
//        $this->assertCount(100, Voter::all());
//        echo '100 in '.$exec_time." seconds\n";
//    }
//
//    /** @test */
//    public function canBulkAdd500Voters()
//    {
//        $this->withoutExceptionHandling();
//        $user = User::factory()->create();
//        $response = $this->actingAs($user)->post('/api/elections', [
//            'slug' => 'slug',
//            'name' => 'name',
//            'description' => 'description',
//            'email' => 'email@example.com',
//            'imprint' => 'imprint'
//        ]);
//        $response->assertCreated();
//        $this->assertCount(1, Election::all());
//        $time_pre = microtime(true);
//        $voter = $this->actingAs($user)->post('/api/elections/slug/voters/factory', [
//            'quantity' => 500
//        ]);
//        $time_post = microtime(true);
//        $exec_time = $time_post - $time_pre;
//        $voter->assertNoContent();
//        $this->assertCount(500, Voter::all());
//        echo '500 in '.$exec_time." seconds\n";
//    }
//
//    /** @test */
//    public function canBulkAdd1000Voters()
//    {
//        $this->withoutExceptionHandling();
//        $user = User::factory()->create();
//        $response = $this->actingAs($user, 'admin')->post('/api/elections', [
//            'slug' => 'slug',
//            'name' => 'name',
//            'description' => 'description',
//            'email' => 'email@example.com',
//            'imprint' => 'imprint'
//        ]);
//        $response->assertCreated();
//        $this->assertCount(1, Election::all());
//        $time_pre = microtime(true);
//        $voter = $this->actingAs($user)->post('/api/elections/slug/voters/factory', [
//            'quantity' => 1000
//        ]);
//        $time_post = microtime(true);
//        $exec_time = $time_post - $time_pre;
//        $voter->assertNoContent();
//        $this->assertCount(1000, Voter::all());
//        echo '1000 in '.$exec_time." seconds\n";
//    }
//
//    /** @test */
//    public function canBulkAdd5000Voters()
//    {
//        $this->withoutExceptionHandling();
//        $user = User::factory()->create();
//        $response = $this->actingAs($user, 'admin')->post('/api/elections', [
//            'slug' => 'slug',
//            'name' => 'name',
//            'description' => 'description',
//            'email' => 'email@example.com',
//            'imprint' => 'imprint'
//        ]);
//        $response->assertCreated();
//        $this->assertCount(1, Election::all());
//        $time_pre = microtime(true);
//        $voter = $this->actingAs($user)->post('/api/elections/slug/voters/factory', [
//            'quantity' => 5000
//        ]);
//        $time_post = microtime(true);
//        $exec_time = $time_post - $time_pre;
//        $voter->assertNoContent();
//        $this->assertCount(5000, Voter::all());
//        echo '5000 in '.$exec_time." seconds\n";
//    }

//    /** @test */
//    public function canBulkAdd10000Voters()
//    {
//        $this->withoutExceptionHandling();
//        $user = User::factory()->create();
//        $response = $this->actingAs($user)->post('/api/elections', [
//            'slug' => 'slug',
//            'name' => 'name',
//            'description' => 'description',
//            'email' => 'email@example.com',
//            'imprint' => 'imprint'
//        ]);
//        $response->assertCreated();
//        $this->assertCount(1, Election::all());
//        $time_pre = microtime(true);
//        $voter = $this->actingAs($user)->post('/api/elections/slug/voters/factory', [
//            'quantity' => 10000
//        ]);
//        $time_post = microtime(true);
//        $exec_time = $time_post - $time_pre;
//        $voter->assertNoContent();
//        $this->assertCount(10000, Voter::all());
//        echo '10000 in '.$exec_time." seconds\n";
//    }

//    /** @test */
//    public function canBulkAdd100000Voters()
//    {
//        $this->withoutExceptionHandling();
//        $user = User::factory()->create();
//        $response = $this->actingAs($user)->post('/api/elections', [
//            'slug' => 'slug',
//            'name' => 'name',
//            'description' => 'description',
//            'email' => 'email@example.com',
//            'imprint' => 'imprint'
//        ]);
//        $response->assertCreated();
//        $this->assertCount(1, Election::all());
//        $time_pre = microtime(true);
//        $voter = $this->actingAs($user)->post('/api/elections/slug/voters/factory', [
//            'quantity' => 100000
//        ]);
//        $time_post = microtime(true);
//        $exec_time = $time_post - $time_pre;
//        $voter->assertNoContent();
//        $this->assertCount(100000, Voter::all());
//        echo '100000 in '.$exec_time." seconds\n";
//    }
//
//    /** @test */
//    public function canBulkAddHalfMillionVoters()
//    {
//        $this->withoutExceptionHandling();
//        $user = User::factory()->create();
//        $response = $this->actingAs($user)->post('/api/elections', [
//            'slug' => 'slug',
//            'name' => 'name',
//            'description' => 'description',
//            'email' => 'email@example.com',
//            'imprint' => 'imprint'
//        ]);
//        $response->assertCreated();
//        $this->assertCount(1, Election::all());
//        $time_pre = microtime(true);
//        $voter = $this->actingAs($user)->post('/api/elections/slug/voters/factory', [
//            'quantity' => 500000
//        ]);
//        $time_post = microtime(true);
//        $exec_time = $time_post - $time_pre;
//        $voter->assertNoContent();
//        $this->assertCount(500000, Voter::all());
//        echo 'Half Million in '.$exec_time." seconds\n";
//    }

//    /** @test */
//    public function canBulkAddOneMillionVoters()
//    {
//        $this->withoutExceptionHandling();
//        $user = User::factory()->create();
//        $response = $this->actingAs($user)->post('/api/elections', [
//            'slug' => 'slug',
//            'name' => 'name',
//            'description' => 'description',
//            'email' => 'email@example.com',
//            'imprint' => 'imprint'
//        ]);
//        $response->assertCreated();
//        $this->assertCount(1, Election::all());
//        $time_pre = microtime(true);
//        $voter = $this->actingAs($user)->post('/api/elections/slug/voters/factory', [
//            'quantity' => 1000000
//        ]);
//        $time_post = microtime(true);
//        $exec_time = $time_post - $time_pre;
//        $voter->assertNoContent();
//        $this->assertCount(1000000, Voter::all());
//        echo 'One Million in '.$exec_time." seconds\n";
//    }

}
