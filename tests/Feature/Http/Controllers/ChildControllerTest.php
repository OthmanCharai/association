<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Child;
use App\Models\Sponsor;
use App\Models\Widow;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ChildController
 */
class ChildControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $children = Child::factory()->count(3)->create();

        $response = $this->get(route('child.index'));

        $response->assertOk();
        $response->assertViewIs('child.index');
        $response->assertViewHas('children');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('child.create'));

        $response->assertOk();
        $response->assertViewIs('child.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChildController::class,
            'store',
            \App\Http\Requests\ChildStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $username = $this->faker->userName;
        $gender = $this->faker->randomElement(/** enum_attributes **/);
        $birth_day = $this->faker->date();
        $educated = $this->faker->boolean;
        $vaccinated = $this->faker->boolean;
        $widow = Widow::factory()->create();
        $sponsor = Sponsor::factory()->create();

        $response = $this->post(route('child.store'), [
            'username' => $username,
            'gender' => $gender,
            'birth_day' => $birth_day,
            'educated' => $educated,
            'vaccinated' => $vaccinated,
            'widow_id' => $widow->id,
            'sponsor_id' => $sponsor->id,
        ]);

        $children = Child::query()
            ->where('username', $username)
            ->where('gender', $gender)
            ->where('birth_day', $birth_day)
            ->where('educated', $educated)
            ->where('vaccinated', $vaccinated)
            ->where('widow_id', $widow->id)
            ->where('sponsor_id', $sponsor->id)
            ->get();
        $this->assertCount(1, $children);
        $child = $children->first();

        $response->assertRedirect(route('child.index'));
        $response->assertSessionHas('child.id', $child->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $child = Child::factory()->create();

        $response = $this->get(route('child.show', $child));

        $response->assertOk();
        $response->assertViewIs('child.show');
        $response->assertViewHas('child');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $child = Child::factory()->create();

        $response = $this->get(route('child.edit', $child));

        $response->assertOk();
        $response->assertViewIs('child.edit');
        $response->assertViewHas('child');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChildController::class,
            'update',
            \App\Http\Requests\ChildUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $child = Child::factory()->create();
        $username = $this->faker->userName;
        $gender = $this->faker->randomElement(/** enum_attributes **/);
        $birth_day = $this->faker->date();
        $educated = $this->faker->boolean;
        $vaccinated = $this->faker->boolean;
        $widow = Widow::factory()->create();
        $sponsor = Sponsor::factory()->create();

        $response = $this->put(route('child.update', $child), [
            'username' => $username,
            'gender' => $gender,
            'birth_day' => $birth_day,
            'educated' => $educated,
            'vaccinated' => $vaccinated,
            'widow_id' => $widow->id,
            'sponsor_id' => $sponsor->id,
        ]);

        $child->refresh();

        $response->assertRedirect(route('child.index'));
        $response->assertSessionHas('child.id', $child->id);

        $this->assertEquals($username, $child->username);
        $this->assertEquals($gender, $child->gender);
        $this->assertEquals(Carbon::parse($birth_day), $child->birth_day);
        $this->assertEquals($educated, $child->educated);
        $this->assertEquals($vaccinated, $child->vaccinated);
        $this->assertEquals($widow->id, $child->widow_id);
        $this->assertEquals($sponsor->id, $child->sponsor_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $child = Child::factory()->create();

        $response = $this->delete(route('child.destroy', $child));

        $response->assertRedirect(route('child.index'));

        $this->assertModelMissing($child);
    }
}
