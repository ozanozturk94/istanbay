<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;

class MapController extends Controller
{
    //
    public function readData()
    {
     //   dd(public_path('agencies.csv'));
        //dosya adresi,dos

        $csvFile = file(public_path('agencies.csv'));
        $data = [];
        foreach ($csvFile as $line) {
            $data = str_getcsv($line);
            if ($data[0]!='id'){
                $row=new Agency();
                $row->name=$data[1];
                $row->lat=floatval($data[2]);
                $row->lng=floatval($data[3]);
                $row->save();
            }
        }
      //  dd(floatval($data[1][2]));
        return redirect('/');
    }


}

