<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function citywithstatecountry(Request $request)
    {
        $input = $request->all();
       
        $cities = City::with('district.state.country')
            ->where('name', 'Like', '%' . $input['term']['term'] . '%')
            ->get()->toArray();
            return response()->json($cities);
    }

}
