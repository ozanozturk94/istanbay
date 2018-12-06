<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        //
    public function home(){

        $agency=Agency::all();
        $agency=$agency->toJson();
        return view('/welcome',compact('agency'));
    }

    public function getPlacesWithLocation($lat, $lng) {
        $lat = doubleval($lat);
        $lng = doubleval($lng);

        // we'll want everything within, say, 10km distance
        $distance = 5;

// earth's radius in km = ~6371
        $radius = 6371;

// latitude boundaries
        $maxlat = $lat + rad2deg($distance / $radius);
        $minlat = $lat - rad2deg($distance / $radius);

// longitude boundaries (longitude gets smaller when latitude increases)
        $maxlng = $lng + rad2deg($distance / $radius / cos(deg2rad($lat)));
        $minlng = $lng - rad2deg($distance / $radius / cos(deg2rad($lat)));

        $agency = Agency::whereBetween('lat', [$minlat,$maxlat])->whereBetween('lng',[$minlng,$maxlng])->get()->toJson();

        return view('/welcome2',compact('agency'));
    }

    public function returnSearch(Request $request)

    {
      $key = "AIzaSyCj3jEE8WsgNy5SCNfMTnTwzSh6P5tN81M";

      $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $request->place . "&key=" . $key;
      $data = json_decode(file_get_contents($url), true);
      $location = $data["results"][0]["geometry"]["location"];
        return redirect()->route('location',['lat' => $location['lat'], 'lng' =>$location['lng']]);
    }
}
