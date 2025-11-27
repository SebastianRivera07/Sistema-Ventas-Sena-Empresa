<?php

// use App\Livewire\Categories\Index as CategoriesIndex;
// use App\Livewire\Measures\Index as MeasuresIndex;


use App\Livewire\Products\Index;
use App\Livewire\Clients\Index as ClientsIndex;
use App\Livewire\CategoriesAndMeasures\Index as CategoriesAndMeasuresIndex;
use App\Livewire\ProductDeliveries\Index as ProductDeliveriesIndex;
use App\Livewire\Reports\Index as ReportsIndex;
use App\Livewire\Sales\Index as SalesIndex;
use App\Livewire\Providers\Index as ProvidersIndex;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

Route::get('/pruebasbuscador', function () {
    return view('pruebasbuscador');
})->name('pruebasbuscador');

Route::get('/pruebaslista', function () {
    return view('pruebaslista');
})->name('pruebaslista');

Route::get('products', Index::class)->name('products.index');
// Route::get('categories', CategoriesIndex::class)->name('categories.index');
// Route::get('measures', MeasuresIndex::class)->name('measures.index');
Route::get('categoriesandmeasures', CategoriesAndMeasuresIndex::class)->name('categoriesandmeasures.index');
Route::get('clients', ClientsIndex::class)->name('clients.index');
Route::get('sales', SalesIndex::class)->name('sales.index');
Route::get('reports', ReportsIndex::class)->name('reports.index');
Route::get('providers', ProvidersIndex::class)->name('providers.index');
Route::get('productdeliveries', ProductDeliveriesIndex::class)->name('productdeliveries.index');

/*          Ejemplo del curso de Livewire */
// Route::get('products', Index::class)->name('products.index');
// Route::get('products/create', Create::class)->name('products.create');
// Route::get('products/{product}/edit', Update::class)->name('products.edit');
