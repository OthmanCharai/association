<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SponsorController
 */
class SponsorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $sponsors = Sponsor::factory()->count(3)->create();

        $response = $this->get(route('sponsor.index'));

        $response->assertOk();
        $response->assertViewIs('sponsor.index');
        $response->assertViewHas('sponsors');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('sponsor.create'));

        $response->assertOk();
        $response->assertViewIs('sponsor.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SponsorController::class,
            'store',
            \App\Http\Requests\SponsorStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('sponsor.store'), [
            'name' => $name,
        ]);

        $sponsors = Sponsor::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $sponsors);
        $sponsor = $sponsors->first();

        $response->assertRedirect(route('sponsor.index'));
        $response->assertSessionHas('sponsor.id', $sponsor->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $sponsor = Sponsor::factory()->create();

        $response = $this->get(route('sponsor.show', $sponsor));

        $response->assertOk();
        $response->assertViewIs('sponsor.show');
        $response->assertViewHas('sponsor');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $sponsor = Sponsor::factory()->create();

        $response = $this->get(route('sponsor.edit', $sponsor));

        $response->assertOk();
        $response->assertViewIs('sponsor.edit');
        $response->assertViewHas('sponsor');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SponsorController::class,
            'update',
            \App\Http\Requests\SponsorUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $sponsor = Sponsor::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('sponsor.update', $sponsor), [
            'name' => $name,
        ]);

        $sponsor->refresh();

        $response->assertRedirect(route('sponsor.index'));
        $response->assertSessionHas('sponsor.id', $sponsor->id);

        $this->assertEquals($name, $sponsor->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $sponsor = Sponsor::factory()->create();

        $response = $this->delete(route('sponsor.destroy', $sponsor));

        $response->assertRedirect(route('sponsor.index'));

        $this->assertModelMissing($sponsor);
    }
}
