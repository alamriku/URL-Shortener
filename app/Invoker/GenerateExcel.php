<?php

namespace App\Invoker;

class GenerateExcel
{
    public function __invoke()
    {
        return \Maatwebsite\Excel\Facades\Excel::store(new \App\Exports\MetricsExport(), 'traffics.xlsx');
    }
}
