<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Car;
use App\Models\Year;

class CarController extends Controller
{
    public function store(Request $request){
        $data = $request->except('_token');
        $car  = Car::create($data);
        return response([
            'message' => 'Car Create Successfull',
            'id'      => $car->id,
        ], Response::HTTP_CREATED);
    }

    public function car_get($id){
        $car = Car::FindOrFail($id);
        $data = [
            'id' => $car->id,
            'info' => $car->make .' '. $car->model,
        ];
        return response([
            'response' => $data,
        ], Response::HTTP_OK);

    }

    public function post_years(Request $request,$id){
        $years       = $request->years;
        $miliseconds = date("Y-m-d", strtotime($request->expiry));
        $expiry      = strtotime($miliseconds);
        foreach ($years as $key => $year) {
            $data['car_id']   = $id;
            $data['year']   = $year;
            $data['expiry'] = $expiry;
            Year::create($data);
        }
        return response([
            'success' => true,
            'message' => 'set year successfully',
        ], Response::HTTP_CREATED);
    }

    public function car_get_year($years){
        $years = explode(",",$years);
        $cars = Year::select('car_id')->whereIn('year',$years)->groupBy('car_id')->pluck('car_id');
        $car = Car::with('years')->whereIn('id',$cars)->get();
        // dd($cars);
        return response([
            'response' => $car,
        ], Response::HTTP_CREATED);
    }
}
