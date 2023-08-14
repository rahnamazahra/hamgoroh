<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Morilog\Jalali\Jalalian;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportUsers implements FromCollection, WithHeadings
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users;
    }

    public function headings(): array
    {
        return [
            'نام',
            'نام خانوادگی',
            'وضعیت فعال',
            'تلفن',
            'شهر',
            'کدملی',
            'جنسیت',
            'تاریخ تولد',

        ];

    }

    public function map(mixed $user): array
    {
        return [
            $user->first_name,
            $user->last_name,
            $user->is_active ? 'فعال' : 'غیرفعال',
            $user->phone,
            $user->city->province->title,
            $user->national_code,
            $user->gender ? 'مرد' : 'زن',
            Jalalian::fromCarbon(Carbon::parse($user->birthday_date))->format('Y/m/d'),
        ];
    }
}
