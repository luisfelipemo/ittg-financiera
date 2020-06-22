<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;


class ClientsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([
            'id' =>     $row[0],
            'name' =>   $row[1],
            'phone' =>  "9612345678",
            'address' => "P. Sherman, Calle Wallaby 42, Sydney",
        ]);
    }
}
