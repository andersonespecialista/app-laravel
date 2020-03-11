<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('/', 'welcome', ['id' => 'teste']); // mesma função do get abaixo
Route::get('/', function () {
    return view('welcome');
});


/**
 *--------------------------------------------------------------------------
 * Qualquer Verbo
 *--------------------------------------------------------------------------
 * ex: get, post, put e etc
 */
Route::any('/rotaAny', function () {
    return 'Any';
});

/**
 *--------------------------------------------------------------------------
 * Especificando os Verbo
 *--------------------------------------------------------------------------
 * Você deve especificar no primeiro parametro
 * quais os verbos permitidos para essa rota
 */
Route::match(['get', 'post'], '/rotaMatch', function(){
    return 'Match';
});

/**
 *--------------------------------------------------------------------------
 * Paramentros dinâmicos na rota
 *--------------------------------------------------------------------------
 */
Route::get('/categorias/{param}', function ($dados) {
    return "Produtos da categoria: {$dados}";
});

/**
 * Mesmo exemplo de categoria, inserindo
 * parametro fixo no final da rota
 */
Route::get('/categoria/{param}/post/', function ($param) {
    return "Post da categoria: {$param}";
});

/**
 *--------------------------------------------------------------------------
 * Parametros Opcionais
 *--------------------------------------------------------------------------
 * obs.: Deve informar o ponto de interrogação
 * no parametro opcional e especificar o valor
 * padrão cado o valor não seja informado na rota
 * nesse exemplo o valor padrão é 'VAZIO'
 */
Route::get('/produtos/{produtoId?}', function ($produtoId = 'VAZIO') {
    return "Produto(s) {$produtoId}";
});

/**
 *--------------------------------------------------------------------------
 * Redirecionamento
 *--------------------------------------------------------------------------
 */
Route::get('/redirect1', function () {
    return redirect('/redirect2'); // direcionando usando um helper
});
Route::get('/redirect2', function () {
    return 'redirect2';
});
/**
 *--------------------------------------------------------------------------
 * Redirecionamento em apenas uma linha
 *--------------------------------------------------------------------------
 */
Route::redirect('/redirect1', 'redirect2');


/**
 *--------------------------------------------------------------------------
 * NOMEANDO ROTAS
 *--------------------------------------------------------------------------
 */
Route::get('/redirect3', function () {
    return redirect()->route('url.name'); // redirecionamento para o nome da rota
});
Route::get('/url-name', function () {
    return 'Hey hey hey';
})->name('url.name');


/**
 *--------------------------------------------------------------------------
 * GRUPO DE ROTAS
 *--------------------------------------------------------------------------
 */
 
 // Middleware - Veja uma forma de aplicar um middleware
Route::get('admin/rota1', function () {
    return 'Qualquer coisa';
})->middleware('auth');

Route::get('/login', function () {
    return 'Pagina de login';
})->name('login');

  // Middleware com group

Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', function () {
        return 'Dashboard Admin';
    });

    Route::get('admin/financeiro', function () {
        return 'financeiro Admin';
    });

    Route::get('admin/produtos', function () {
        return 'produtos Admin';
    });
});

  // Com uso de pre-fixo

Route::middleware([])->group(function () {
    // observe que não estou passando o middleware intencionalmente, para fins de teste
    Route::prefix('panel')->group(function () {
        Route::get('dashboard', function () {
            return 'Dashboard Admin';
        });
    
        Route::get('financeiro', function () {
            return 'financeiro Admin';
        });
    
        Route::get('produtos', function () {
            return 'produtos Admin';
        });

        Route::get('/', function () {
            return 'panel';
        });
    });
});

  // Agora sim com o uso de CONTROLLER
Route::middleware([])->group(function () {
    // observe que não estou passando o middleware intencionalmente, para fins de teste
    Route::prefix('gerenciador')->group(function () {
        
        Route::get('dashboard', 'admin\TesteController@teste');
        Route::get('financeiro', 'admin\TesteController@teste');
        Route::get('produtos', 'admin\TesteController@teste');
        Route::get('/', 'admin\TesteController@teste');
    });
});

  // NAMESPACE - caso venha ser alterado o caminho do controller
Route::middleware([])->group(function () {
    
    Route::prefix('painelcompleto')->group(function () {
        
        Route::namespace('admin')->group(function () {
            
            Route::get('dashboard', 'TesteController@teste')->name('painelcompleto.dashboard');
            Route::get('financeiro', 'TesteController@teste')->name('painelcompleto.financeiro');
            Route::get('produtos', 'TesteController@teste')->name('painelcompleto.produtos');
            Route::get('/', 'TesteController@teste')->name('painelcompleto.home');
        });
    });
});

  // TAMBÉM tem group para tratar os nomes das rotas
  Route::middleware([])->group(function () {
    
    Route::prefix('painelsuper')->group(function () {
        
        Route::namespace('admin')->group(function () {
            
            Route::name('painelsuper.')->group(function () {
                
                Route::get('dashboard', 'TesteController@teste')->name('dashboard');
                Route::get('financeiro', 'TesteController@teste')->name('financeiro');
                Route::get('produtos', 'TesteController@teste')->name('produtos');
                Route::get('/', 'TesteController@teste')->name('home');
            });
        });
    });
});
/**
 * Resumo 
 * o prefix é referente a rota
 * o namespace é referente ao caminho do controller
 * o name é uma especie de prefixo para nome das rotas
 */
    // AGORA O MESMO EXEMPLO DE FORMA BEM SIMPLIFICADA 
Route::group([
    'middleware' => [], // vazio apenas para teste
    'prefix' => 'painelhiper',
    'namespace' => 'admin',
    
], function () {
    
    Route::name('painelhiper.')->group(function () {
        
        Route::get('dashboard', 'TesteController@teste')->name('dashboard');
        Route::get('financeiro', 'TesteController@teste')->name('financeiro');
        Route::get('produtos', 'TesteController@teste')->name('produtos');
        Route::get('/', 'TesteController@teste')->name('home');
    });
    
});

/**
 * alguns comandos para usar no PHP ARTISAN
 * php artisan route:list
 * php artisan route:cache
 * -- Limpa o cache das rotas
 */

 // 
 /*
    -- dica, instalar o json view no chromer
    Antes do plugin mostrava assim o retorno de um array
        ["Product 01","Product 02","Product 03"]
    depois do plugin
    [
        "Product 01",
        "Product 02",
        "Product 03"
    ]
 */


/**
 *--------------------------------------------------------------------------
 * product
 *--------------------------------------------------------------------------
 */

Route::delete('products/{id}', 'ProductController@destroy')->name('products.destroy');
Route::put('products/{id}', 'ProductController@update')->name('products.update');
Route::get('products/{id}/edit', 'ProductController@edit')->name('products.edit');
Route::get('products/create', 'ProductController@create')->name('products.create');
Route::get('products/{id}', 'ProductController@show')->name('products.show');
Route::get('products', 'ProductController@index')->name('products.index');
Route::post('products', 'ProductController@store')->name('products.store');

/* 
    Todos os comandos acima poderiam ser subistituido por apenas 
        Route::resource('products', ProductController);
        -- Criando o controller
        php artisan make:controller ProductController --resource
*/
Route::resource('productspost', 'ProductsPostController');
// php artisan make:controller ProductPostController --resource

/**
 * Middelware nos controller, verificar em ProductsPostController
 */








