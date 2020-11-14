<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    use Exportable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $arr = [];

        foreach ($row as $c => $v) {
            $arr[$c] = $v;
        }

       dd($arr);
    }
}
