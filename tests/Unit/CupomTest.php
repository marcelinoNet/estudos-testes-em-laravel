<?php

namespace Tests\Unit;

use App\Models\Cupom;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CupomTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_create_cupom()
    {

        $cupom = Cupom::factory()->create([
            'descount'=>20
        ]);
        $this->assertModelExists($cupom);
    }

    public function test_create_cupom_with_non_experated_date()
    {

        $cupom = Cupom::factory()->create([
            'descount'=>20
        ]);
        $is_experated = $cupom->is_Experated();
        $this->assertFalse($is_experated);
    }

    public function test_create_cupom_with_experated_date()
    {
        $cupom = Cupom::factory()->create([
            'descount'=>20,
            'experation_date'=> Carbon::yesterday()
        ]);
        $is_experated = $cupom->is_Experated();
        $this->assertTrue($is_experated);
    }
}
