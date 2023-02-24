<?php

namespace Tests\Unit;

use App\Models\Cupom;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_new_order_with_3_products()
    {

        $product1_preco = 5;
        $product1_quantidade = 2;

        $product1 = Product::factory()->create([
            'name'=>'Geladeira',
            'height'=>200,
            'depth'=>100,
            'width'=>50,
            'weight'=>40,
            'price'=>$product1_preco,
            'quantity'=>$product1_quantidade
        ]);
        
        $product2_preco = 7;
        $product2_quantidade = 5;
        $product2 = Product::factory()->create([
            'name'=>'Camera',
            'height'=>20,
            'depth'=>15,
            'width'=>10,
            'weight'=>1,
            'price'=>$product2_preco,
            'quantity'=>$product2_quantidade
        ]);
        $product3_preco = 2;
        $product3_quantidade = 10;
        $product3 = Product::factory()->create([
            'name'=>'Guitarra',
            'height'=>100,
            'depth'=>30,
            'width'=>10,
            'weight'=>3,
            'price'=>$product3_preco,
            'quantity'=>$product3_quantidade
        ]);
      
        $order = new Order();
        $cpf = '880.951.380-02';
        $total = $order->createNewOrderAndReturnTotal([$product1, $product2, $product3],$cpf);

        $expect_total = 65;

        $this->assertEquals($expect_total, $total);
    }

    public function test_cannot_create_new_order_with_3_products_with_duplicated_products()
    {

        $product1_preco = 5;
        $product1_quantidade = 2;

        $product1 = Product::factory()->create([
            'name'=>'Geladeira',
            'height'=>200,
            'depth'=>100,
            'width'=>50,
            'weight'=>40,
            'price'=>$product1_preco,
            'quantity'=>$product1_quantidade
        ]);
        
        $product2_preco = 7;
        $product2_quantidade = 5;
        $product2 = Product::factory()->create([
            'name'=>'Camera',
            'height'=>20,
            'depth'=>15,
            'width'=>10,
            'weight'=>1,
            'price'=>$product2_preco,
            'quantity'=>$product2_quantidade
        ]);
        $product3_preco = 2;
        $product3_quantidade = 10;
        $product3 = Product::factory()->create([
            'name'=>'Guitarra',
            'height'=>100,
            'depth'=>30,
            'width'=>10,
            'weight'=>3,
            'price'=>$product3_preco,
            'quantity'=>$product3_quantidade
        ]);
      
        $order = new Order();
        $cpf = '880.951.380-02';
        $error = $order->createNewOrderAndReturnTotal([$product1, $product1, $product3],$cpf);

        $expect_error = 'duplicate products is not allowed';

        $this->assertEquals($expect_error, $error);
    }

    public function test_cannot_create_new_order_with_3_products_with_invalid_quantity()
    {

        $product1_preco = 5;
        $product1_quantidade = -2;

        $product1 = Product::factory()->create([
            'name'=>'Geladeira',
            'height'=>200,
            'depth'=>100,
            'width'=>50,
            'weight'=>40,
            'price'=>$product1_preco,
            'quantity'=>$product1_quantidade
        ]);
        
        $product2_preco = 7;
        $product2_quantidade = 5;
        $product2 = Product::factory()->create([
            'name'=>'Camera',
            'height'=>20,
            'depth'=>15,
            'width'=>10,
            'weight'=>1,
            'price'=>$product2_preco,
            'quantity'=>$product2_quantidade
        ]);
        $product3_preco = 2;
        $product3_quantidade = 10;
        $product3 = Product::factory()->create([
            'name'=>'Guitarra',
            'height'=>100,
            'depth'=>30,
            'width'=>10,
            'weight'=>3,
            'price'=>$product3_preco,
            'quantity'=>$product3_quantidade
        ]);
      
        $order = new Order();
        $cpf = '880.951.380-02';
        $error = $order->createNewOrderAndReturnTotal([$product1, $product2, $product3],$cpf);

        $expect_error = 'invalid product quantity';

        $this->assertEquals($expect_error, $error);
    }
    public function test_cannot_create_new_order_with_3_products_with_invalid_dimesions()
    {

        $product1_preco = 5;
        $product1_quantidade = 2;

        $product1 = Product::factory()->create([
            'name'=>'Geladeira',
            'height'=>200,
            'depth'=>100,
            'width'=>-50,
            'weight'=>40,
            'price'=>$product1_preco,
            'quantity'=>$product1_quantidade
        ]);
        
        $product2_preco = 7;
        $product2_quantidade = 5;
        $product2 = Product::factory()->create([
            'name'=>'Camera',
            'height'=>20,
            'depth'=>15,
            'width'=>10,
            'weight'=>1,
            'price'=>$product2_preco,
            'quantity'=>$product2_quantidade
        ]);
        $product3_preco = 2;
        $product3_quantidade = 10;
        $product3 = Product::factory()->create([
            'name'=>'Guitarra',
            'height'=>100,
            'depth'=>30,
            'width'=>10,
            'weight'=>3,
            'price'=>$product3_preco,
            'quantity'=>$product3_quantidade
        ]);
      
        $order = new Order();
        $cpf = '880.951.380-02';
        $error = $order->createNewOrderAndReturnTotal([$product1, $product2, $product3],$cpf);

        $expect_error = 'invalid product dimesions';

        $this->assertEquals($expect_error, $error);
    }

    public function test_cannot_create_new_order_with_3_products_with_invalid_weight()
    {

        $product1_preco = 5;
        $product1_quantidade = 2;

        $product1 = Product::factory()->create([
            'name'=>'Geladeira',
            'height'=>200,
            'depth'=>100,
            'width'=>50,
            'weight'=>-40,
            'price'=>$product1_preco,
            'quantity'=>$product1_quantidade
        ]);
        
        $product2_preco = 7;
        $product2_quantidade = 5;
        $product2 = Product::factory()->create([
            'name'=>'Camera',
            'height'=>20,
            'depth'=>15,
            'width'=>10,
            'weight'=>1,
            'price'=>$product2_preco,
            'quantity'=>$product2_quantidade
        ]);
        $product3_preco = 2;
        $product3_quantidade = 10;
        $product3 = Product::factory()->create([
            'name'=>'Guitarra',
            'height'=>100,
            'depth'=>30,
            'width'=>10,
            'weight'=>3,
            'price'=>$product3_preco,
            'quantity'=>$product3_quantidade
        ]);
      
        $order = new Order();
        $cpf = '880.951.380-02';
        $error = $order->createNewOrderAndReturnTotal([$product1, $product2, $product3],$cpf);

        $expect_error = 'invalid product weight';

        $this->assertEquals($expect_error, $error);
    }

    public function test_create_new_order_with_3_products_with_valid_cupom()
    {
        $product1_preco = 5;
        $product1_quantidade = 2;

        $product1 = Product::factory()->create([
            'name'=>'Geladeira',
            'height'=>200,
            'depth'=>100,
            'width'=>50,
            'weight'=>40,
            'price'=>$product1_preco,
            'quantity'=>$product1_quantidade
        ]);
        
        $product2_preco = 7;
        $product2_quantidade = 5;
        $product2 = Product::factory()->create([
            'name'=>'Camera',
            'height'=>20,
            'depth'=>15,
            'width'=>10,
            'weight'=>1,
            'price'=>$product2_preco,
            'quantity'=>$product2_quantidade
        ]);
        $product3_preco = 2;
        $product3_quantidade = 10;
        $product3 = Product::factory()->create([
            'name'=>'Guitarra',
            'height'=>100,
            'depth'=>30,
            'width'=>10,
            'weight'=>3,
            'price'=>$product3_preco,
            'quantity'=>$product3_quantidade
        ]);
      
       
        $cpf = '880.951.380-02';

        $cupom = Cupom::factory()->create([
            'descount'=>20
        ]);

        $order = new Order();
        $total = $order->createNewOrderAndReturnTotal([$product1, $product2, $product3],$cpf,$cupom);

        $expect_total = 52;

        $this->assertEquals($expect_total, $total);
    }
}
