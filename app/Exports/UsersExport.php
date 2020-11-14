<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView,ShouldAutoSize
{
    use Exportable;

    /**
     * @return View
     */
    public function view(): View
    {
        return view(
            'usersExport',
            [
                'users' => User::with(['shopOrder'])->get()
            ]
        );
    }
}
