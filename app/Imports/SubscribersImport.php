<?php

namespace App\Imports;

use App\Models\Subscriber;
use Maatwebsite\Excel\Concerns\ToModel;

class SubscribersImport implements ToModel
{
    public function model(array $row)
    {
        return new Subscriber([
            'email' => $row[1]
        ]);
    }
}
