<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function Index () {
        $data = [
            [
                'secondName' => ' Иванов Иван',
                'phone' => '111111',
                'experience' => '10 лет'
            ],
            [
                'secondName' => 'Петров Петр',
                'phone' => '2222222',
                'experience' => '7 лет'
            ],
            [
                'secondName' => 'Калугин Алексей',
                'phone' => '333333',
                'experience' => '9 лет'
            ],
        ];
        return view('page', ['data' => $data]);
    }

    public function Show()
    {
        $data = [
            'secondName' => 'Иванов',
            'specialization' => 'Программист',
            'phone' => '55-55-55',
            'experience' => '4 года',
            'avatar' => 'Images/ava2.png',
        ];
        return view('resume', ['data' => $data]);
    }
}
