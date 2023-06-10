<?php

namespace App\Exports;

use App\Models\Account;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserAccountExport implements
    FromCollection,
    ShouldAutoSize,
    WithHeadings,
    WithMapping,
    WithStyles
{
    use Exportable;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function collection()
    {
        return Account::with('user')
            ->where('user_id', $this->user->id)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Platform',
            'Email',
            'Username',
            'Mobile Numbers',
            'Password',
            'Pin',
            'Note'
        ];
    }

    public function map($account): array
    {
        return [
            $account->user->first_name . ' ' . $account->user->last_name,
            $account->platform,
            $account->email,
            $account->username,
            $account->mobileNumbers->pluck('number')->implode(', '),
            $account->password,
            $account->pin,
            $account->note,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4A7DB1']],
            ],
        ];
    }
}
