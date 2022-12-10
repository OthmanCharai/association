<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Widow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\WidowController
 */
class WidowControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $widows = Widow::factory()->count(3)->create();

        $response = $this->get(route('widow.index'));

        $response->assertOk();
        $response->assertViewIs('widow.index');
        $response->assertViewHas('widows');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('widow.create'));

        $response->assertOk();
        $response->assertViewIs('widow.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WidowController::class,
            'store',
            \App\Http\Requests\WidowStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $cnss = $this->faker->word;
        $cin = $this->faker->word;
        $phone = $this->faker->phoneNumber;
        $address = $this->faker->text;
        $priority = $this->faker->boolean;

        $response = $this->post(route('widow.store'), [
            'name' => $name,
            'cnss' => $cnss,
            'cin' => $cin,
            'phone' => $phone,
            'address' => $address,
            'priority' => $priority,
        ]);

        $widows = Widow::query()
            ->where('name', $name)
            ->where('cnss', $cnss)
            ->where('cin', $cin)
            ->where('phone', $phone)
            ->where('address', $address)
            ->where('priority', $priority)
            ->get();
        $this->assertCount(1, $widows);
        $widow = $widows->first();

        $response->assertRedirect(route('widow.index'));
        $response->assertSessionHas('widow.id', $widow->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $widow = Widow::factory()->create();

        $response = $this->get(route('widow.show', $widow));

        $response->assertOk();
        $response->assertViewIs('widow.show');
        $response->assertViewHas('widow');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $widow = Widow::factory()->create();

        $response = $this->get(route('widow.edit', $widow));

        $response->assertOk();
        $response->assertViewIs('widow.edit');
        $response->assertViewHas('widow');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WidowController::class,
            'update',
            \App\Http\Requests\WidowUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $widow = Widow::factory()->create();
        $name = $this->faker->name;
        $cnss = $this->faker->word;
        $cin = $this->faker->word;
        $phone = $this->faker->phoneNumber;
        $address = $this->faker->text;
        $priority = $this->faker->boolean;

        $response = $this->put(route('widow.update', $widow), [
            'name' => $name,
            'cnss' => $cnss,
            'cin' => $cin,
            'phone' => $phone,
            'address' => $address,
            'priority' => $priority,
        ]);

        $widow->refresh();

        $response->assertRedirect(route('widow.index'));
        $response->assertSessionHas('widow.id', $widow->id);

        $this->assertEquals($name, $widow->name);
        $this->assertEquals($cnss, $widow->cnss);
        $this->assertEquals($cin, $widow->cin);
        $this->assertEquals($phone, $widow->phone);
        $this->assertEquals($address, $widow->address);
        $this->assertEquals($priority, $widow->priority);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $widow = Widow::factory()->create();

        $response = $this->delete(route('widow.destroy', $widow));

        $response->assertRedirect(route('widow.index'));

        $this->assertModelMissing($widow);
    }
}
