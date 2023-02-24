<?php

namespace Tests\Feature;

use App\Models\Cupom;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CupomFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_open_cupom_index()
    {
        $response = $this->get('/cupom');

        $response->assertStatus(200);
    }

    public function test_open_cupom_index_contains_empty_table()
    {
        $response = $this->get('/cupom');

        $response->assertStatus(200);
        $response->assertSee(__('No cupoms found!'));
    }

    public function test_open_cupom_index_non_contains_empty_table()
    {
        $cupom = Cupom::factory()->create([
            'name' => 'Cupom 1'
        ]);

        $response = $this->get('/cupom');

        $response->assertStatus(200);
        $response->assertDontSee(__('No cupoms found!'));
        $response->assertSee('Cupom 1');
        $response->assertViewHas("cupoms", function ($collections) use ($cupom) {
            return $collections->contains($cupom);
        });
    }

    public function test_open_cupom_index_doesnt_contain_11th_record()
    {
        $cupoms = Cupom::factory(11)->create([
            'name' => 'Cupom 1'
        ]);
        $lastCupom = $cupoms->last();
        $response = $this->get('/cupom');
        $response->assertStatus(200);
        $response->assertViewHas("cupoms", function ($collections) use ($lastCupom) {
            return !$collections->contains($lastCupom);
        });
    }

    public function test_open_cupom_create()
    {
        $response = $this->get('/cupom/create');

        $response->assertStatus(200);
    }

    public function test_create_cupom_successful()
    {
        $cupom = [
            'name' => 'Cupom10',
            'descount' => 10,
            'experation_date' => Carbon::tomorrow()
        ];

        $response = $this->post('/cupom', $cupom);
        $response->assertStatus(302);
        $response->assertRedirect('cupom');
        $this->assertDatabaseHas('cupoms', $cupom);

        $lastCupom = Cupom::latest()->first();
        $this->assertEquals($cupom['name'], $lastCupom->name);
        $this->assertEquals($cupom['descount'], $lastCupom->descount);
    }

    public function test_cupom_create_validation_erros_redirects_back_to_form()
    {
        $cupom = [
            'name' => '',
            'descount' => 10,
            'experation_date' => Carbon::tomorrow()
        ];

        $response = $this->post('/cupom', $cupom);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $response->assertInvalid(['name']);
    }

    public function test_edit_cupom_contains_correct_values()
    {
        $cupom = Cupom::factory()->create();

        $response = $this->get('cupom/' . $cupom->id . '/edit');

        $response->assertStatus(200);
        $response->assertSee('value="' . $cupom->name . '"', false);
        $response->assertSee('value="' . $cupom->descount . '"', false);
        $response->assertViewHas('cupom', $cupom);
    }

    public function test_cupom_update_validation_erros_redirects_back_to_form()
    {
        $cupom = Cupom::factory()->create();

        $response = $this->put('cupom/' . $cupom->id, [
            'name' => '',
            'descount' => 10,
            'experation_date' => Carbon::tomorrow()
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $response->assertInvalid(['name']);
    }


    public function test_cupom_delete_successful()
    {
        $cupom = Cupom::factory()->create();

        $response = $this->delete('cupom/' . $cupom->id);

        $response->assertStatus(302);
        $response->assertRedirect('cupom');
        $this->assertDatabaseMissing('cupoms', $cupom->toArray());
        $this->assertDatabaseCount('cupoms',0);
    }
}
