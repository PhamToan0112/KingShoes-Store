<?php

namespace App\Exports;

use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function headings(): array
    {
        return [
            'ID',
            'Image Name',
            'Username',
            'Email',
            'Password Hash',
            'Full Name',
            'Location',
            'Phone Number',
            'Role',
            'Created At',
            'Updated At',
        ];
    }
    public function collection()
    {
        return Users::all(['id', 'image', 'username', 'email', 'password', 'fullname', 'address', 'phone', 'role', 'created_at', 'updated_at']);
    }
}
