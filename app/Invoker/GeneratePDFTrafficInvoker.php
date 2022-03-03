<?php

namespace App\Invoker;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GeneratePDFTrafficInvoker
{
    public function __invoke()
    {
        $pdf = Pdf::setPaper('a4', 'landscape')->loadView('metrics',['clicks' => \App\Models\Click::with('link')->get()]);
        //Storage::put('public/pdf/traffic.pdf', $pdf->output());
        return Storage::put('traffic.pdf', $pdf->output(), 'public');
    }
}
