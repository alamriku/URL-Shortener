<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as C1;
use Barryvdh\DomPDF\Facade\Pdf;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function()  {
    Route::post('/short-url', [C1\LinkController::class, 'store'])->name('short-url.store');
    Route::get('/generate-qr-code',[C1\QrCodeController::class,'index']);
    Route::get('/short-links', function (){
        return view('table', ['short_links'=>\App\Models\Link::orderBy('id','desc')->get()]);
    })->name('short_link.index');

    Route::get('/pdf-metrics',function (){

        $pdf = PDF::loadView('metrics',['clicks' => \App\Models\Click::get()]);
        $pdf = Pdf::loadView('metrics',['clicks' => \App\Models\Click::get()]);
        $content = $pdf->download()->getOriginalContent();
        return $pdf->download('metrics.pdf');
    })->name('metrics.pdf');

    Route::get('/excel-metrics', function (){
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\MetricsExport(), 'traffics.xlsx');
    })->name('excel-metrics');
});

require __DIR__.'/auth.php';

Route::get('/{short_url}', [C1\LinkController::class, 'forwarding']);

