<?php

use Illuminate\http\Request; //Habilita usar Request
use App\Product;

Route::middleware('auth')->group(function () { //modulo de autenticacion


    Route::get('products', function () {

        $products = Product::orderBy('created_at', 'desc')->get();
        
        return view('products.index', compact('products')); // muestra los productos en Index de la var $products 
    })->name('products.index');

    Route::get('products/create', function () {
        return view('products.create');
    })->name('products.create');

    Route::post('products', function (Request $request) { //Injeccion de dependencias captura todo lo que envia el formulario

        $request->all();
        $newProduct = new Product; //Nueva instancia del modelo Product(origen App\Product)
        $newProduct->description = $request->input('description');
        $newProduct->price = $request->input('price');
        $newProduct->save(); // guarda los datos capturados 

        return redirect()->route('products.index')->with('infoC', 'Producto creado'); //retorna la vista product.index y crea a Info con un mensaje breve
    })->name('products.store');

    Route::delete('products/{id}', function ($id) {
        
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('products.index')->with('infoD', 'Producto eliminado exitosamente');
    })->name('products.destroy');

    Route::get('products/{id}/edit', function ($id) {
        
        $product = Product::findOrFail($id);
        
        return view('products.edit', compact('product'));
    })->name('products.edit');

    Route::put('/products/{id}', function (Request $request, $id) {
        
        $product = Product::findOrFail($id);
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
        
        return redirect()->route('products.index')->with('infoA', 'Producto Actualizado');
    })->name('products.update');
});

Auth::routes();