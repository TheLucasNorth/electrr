<?php

namespace App\Exports;

use App\Models\Election;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VotersExport implements FromCollection, WithMapping, WithHeadings
{

    public Election $election;

    public function __construct(Election $election)
    {
        $this->election = $election;
    }

    /**
    * @return Collection
    */
    public function collection()
    {
        return $this->election->voters;
    }

    public function map($voter): array
    {
        return [
            $voter->username,
            $voter->password_plain,
            $voter->email,
            $voter->delivered,
            $voter->opened,
            $voter->unsubscribed,
            $voter->complained,
            $voter->bounced
        ];
    }

    public function headings(): array
    {
        return [
            'Username',
            'Password',
            'Email',
            'Delivered',
            'Opened',
            'Unsubscribed',
            'Complained',
            'Bounced',
        ];
    }
}
