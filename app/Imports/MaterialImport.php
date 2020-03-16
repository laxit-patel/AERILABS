<?php

namespace App\Imports;

use App\Materials;
use Maatwebsite\Excel\Concerns\ToModel;

class MaterialImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Materials([
            
            'Material' => $row['material_name']
            
        ]);
    }
}
