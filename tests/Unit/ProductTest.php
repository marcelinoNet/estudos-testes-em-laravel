<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_create_product()
    {
        $product = Product::factory()->create([
            'price'=>3.5
        ]);
        $this->assertModelExists($product);
    }

    public function test_create_product_with_negative_quantity_return_false()
    {
        $product = Product::factory()->create([
            'price'=>3.5,
            'quantity'=>-1
        ]);
        $is_valid = $product->is_Quantity_Valid();
        $this->assertFalse($is_valid);
    }

    public function test_create_product_with_positive_quantity()
    {
        $product = Product::factory()->create([
            'price'=>3.5,
            'quantity'=>2
        ]);
        $is_valid = $product->is_Quantity_Valid();
        $this->assertTrue($is_valid);
    }

    public function test_create_product_with_negative_weight_return_false()
    {
        $product = Product::factory()->create([
            'price'=>3.5,
            'weight'=>-10
        ]);
        $is_valid = $product->is_Weight_Valid();
        $this->assertFalse($is_valid);
    }

    public function test_create_product_with_positive_weight()
    {
        $product = Product::factory()->create([
            'price'=>3.5,
            'weight'=>10
        ]);
        $is_valid = $product->is_Weight_Valid();
        $this->assertTrue($is_valid);
    }


    public function test_create_product_with_negative_dimensions_return_false()
    {
        $product = Product::factory()->create([
            'height'=>-10,
            'depth'=>-10,
            'width'=>-10
        ]);
        $is_valid = $product->is_Dimensions_Valid();
        $this->assertFalse($is_valid);
    }

    public function test_create_product_with_positive_dimensions()
    {
        $product = Product::factory()->create();
        $is_valid = $product->is_Dimensions_Valid();
        $this->assertTrue($is_valid);
    }


    public function test_calculate_product_volume()
    {
        $product = Product::factory()->create([
            'height'=>20,
            'depth'=>15,
            'width'=>10
        ]);
        $volume = $product->calculate_Volume();
        $expected_value = 0.003;
        $this->assertEquals($expected_value, $volume);
    }

    public function test_calculate_product_density()
    {
        $product = Product::factory()->create([
            'height'=>20,
            'depth'=>15,
            'width'=>10,
            'weight'=>1
        ]);
        $density = $product->calculate_Density();
        $expected_value = 333;
        $this->assertEquals($expected_value, $density);
    }


    public function test_calculate_product_freight()
    {
        $product = Product::factory()->create([
            'name'=>'Geladeira',
            'height'=>200,
            'depth'=>100,
            'width'=>50,
            'weight'=>40
        ]);
        $volume = $product->calculate_Volume();
        $expected_volume = 1;
        $this->assertEquals($expected_volume, $volume);
        $density = $product->calculate_Density();
        $expected_density = 40;
        $this->assertEquals($expected_density, $density);
        $freight = $product->calculate_Freight();
        $expected_freigth = 400.00;
        $this->assertEquals($expected_freigth, $freight);
    }

    public function test_calculate_product_freight_camera()
    {
        $product = Product::factory()->create([
            'name'=>'Camera',
            'height'=>20,
            'depth'=>15,
            'width'=>10,
            'weight'=>1
        ]);
        $volume = $product->calculate_Volume();
        $expected_volume = 0.003;
        $this->assertEquals($expected_volume, $volume);
        $density = $product->calculate_Density();
        $expected_density = 333;
        $this->assertEquals($expected_density, $density);
        $freight = $product->calculate_Freight();
        $expected_freigth = 10.00;
        $this->assertEquals($expected_freigth, $freight);
    }

    public function test_calculate_product_total()
    {
        $product = Product::factory()->create([
            'price'=>3.5,
            'quantity'=>2
        ]);
        $freight = $product->calculate_total();
        $expected_total = 7.00;
        $this->assertEquals($expected_total, $freight);
    }

}
