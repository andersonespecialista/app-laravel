<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{   
    public function index() 
    {
        $products = ['Product 01', 'Product 02', 'Product 03'];
        return $products;
    }

    public function show($id)
    {
        return 'Exibir o produto id:' . $id;
    }

    public function create()
    {
        return 'Exibir formulario para criar produto';
    }

    public function edit($id)
    {
        return 'edit product id ' . $id;
    }

    public function store()
    {
        return 'Armazena o produto no banco de dados';
    }

    public function update($id)
    {
        return 'update product id ' . $id;
    }

    public function destroy($id)
    {
        return 'deletando o produdo id: ' . $id;
    }


}

