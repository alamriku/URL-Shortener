<?php

namespace App\Exports;

use App\Factories\LinkFactory;
use App\Models\Click;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MetricsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Click::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Link',
            'IP',
            'Location',
            'Latitude',
            'Longitude',
            'Referer',
            'browser',
            'OS',
            'Device',
            'Created',
            'Updated'
        ];
    }

    public function map($click): array
    {
        return [
            $click->id,
            LinkFactory::formatLink($click->link->short_chars),
            $click->ip,
            $click->location,
            $click->latitude,
            $click->longitude,
            $click->referer,
            $click->browser,
            $click->os_platform,
            $click->device,
            $click->created_at->format('M d Y'),
            $click->updated_at->format('M d Y'),
        ];
    }
}
