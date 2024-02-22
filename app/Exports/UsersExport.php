<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;
class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $record = User::all();
        $all_records = [];
        foreach ($record as $key => $value) {
            $all_records[] = [
                'id' => $value->id,
                'name' => $value->name,
                'email' => $value->email,
                'mobile' => $value->mobile,
                'avatar' => $value->avatar,
                'user_type' => $value->user_type,
                'user_status' => $value->user_status,
                'first_name' => $value->first_name,
                'last_name' => $value->last_name,
                'online_status' => $value->online_status,
                'emp_code' => $value->emp_code,
                'birth_date' => $value->birth_date,
                'company_rule' => $value->company_rule,
                'cost_centre' => $value->cost_centre,
                'department' => $value->department,
                'team' => $value->team,
                'edit_form_access' => $value->edit_form_access,
                'regions' => $value->regions
            ];
           
    }
    return collect($all_records);
    }
    public function headings(): array
    {
        return [
          'id',
          'name',
          'email',
          'mobile',
          'avatar',
          'user_type',
          'user_status',
          'first_name',
          'last_name',
          'online_status',
          'emp_code',
          'birth_date',
          'company_rule',
          'cost_centre',
          'department',
          'team',
          'edit_form_access',
          'regions'
        ];
    }
}
