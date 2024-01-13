<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ParkingController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $clientWithCars = DB::table("clients")
            ->select("clients.*", "cars.state_number", "cars.car_brand")
            ->leftJoin('cars', 'clients.id', '=', 'cars.client_id')
            ->orderBy('clients.id')
            ->paginate(3);
        return view('Parking/index', compact('clientWithCars'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('Parking/create-form');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'fullname' => 'string|min:3',
            'gender' => 'required|int',
            'phone_number' => 'required|unique:clients',
            'address' => 'string|max:255',
            'car_brand' => 'required|string|max:255',
            'color' => 'required|string',
            'model' => 'required|string|max:255',
            'state_number' => 'required|string|unique:cars',
            'is_set' => 'required|int',
        ]);

        $clientId = DB::table('clients')->insertGetId([
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
        DB::table('cars')->insert([
            'car_brand' => $request->car_brand,
            'model' => $request->model,
            'state_number' => $request->state_number,
            'color' => $request->color,
            'is_set' => $request->is_set,
            'client_id' => $clientId,
        ]);
        return back()->with('created', 'Successfully created!');
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $client = DB::table('clients')->select("clients.*")->where('id', '=', $id)->get();
        $cars = DB::table('cars')->select("cars.*")->where('client_id', '=', $id)->paginate(1);
        return view('Parking/edit-form', compact('client', 'cars'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $clientId = $request->client_id;
        $carId = $request->car_id;
        $request->validate([
            'fullname' => 'string|min:3',
            'gender' => 'required|int',
            'phone_number' => [
                'required',
                Rule::unique('clients')->ignore($clientId)
            ],
            'address' => 'string|max:255',
            'car_brand' => 'required|string|max:255',
            'color' => 'required|string',
            'model' => 'required|string|max:255',
            'state_number' => [
                'required',
                Rule::unique('cars')->ignore($carId)
            ],
            'is_set' => 'required|int',
        ]);
        $clientData = [
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ];
        $carData = [
            'car_brand' => $request->car_brand,
            'color' => $request->color,
            'model' => $request->model,
            'state_number' => $request->state_number,
            'is_set' => $request->is_set,
        ];

        DB::table('clients')->where('id', $clientId)
            ->update($clientData);
        DB::table('cars')->where('id', $carId)
            ->update($carData);
        return back()->with('updated', 'Successfully updated!');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        DB::table('cars')->where('client_id', '=', $id)->delete();
        DB::table('clients')->delete($id);
        return back()->with('deleted', 'Successfully deleted!');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function addCar(Request $request): RedirectResponse
    {
        $request->validate([
            'car_brand' => 'required|string|max:255',
            'color' => 'required|string',
            'model' => 'required|string|max:255',
            'state_number' => 'required|string|max:255|unique:cars',
            'is_set' => 'required|int',
        ]);
        DB::table('cars')->insert([
            'car_brand' => $request->car_brand,
            'model' => $request->model,
            'state_number' => $request->state_number,
            'color' => $request->color,
            'is_set' => $request->is_set,
            'client_id' => $request->client_id,
        ]);
        return back()->with('Car added', 'Successfully, Car added!');
    }

    /**
     * @param $clientId
     * @param $carId
     * @return \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function location($clientId = null, $carId = null): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $clients = DB::table("clients")->select("clients.id", "clients.fullname")->get();
        if ($clientId != null) {
            $cars = DB::table("cars")
                ->select("cars.id", "cars.client_id", "cars.state_number")
                ->where('client_id', '=', $clientId)
                ->orderBy('id')->get();
            if ($carId != null) {
                $oneCar = DB::table("cars")->select("cars.*")
                    ->where('id', '=', $carId)->get();
                return view('Parking/location-form', compact('cars', 'clients', 'oneCar'));
            }
            return view('Parking/location-form', compact('cars', 'clients'));
        }
        return view('Parking/location-form', compact('clients'));
    }

    /**
     * @param $carId
     * @param $is_set
     * @return RedirectResponse
     */
    public function changeLocation($carId, $is_set): RedirectResponse
    {
        $set = ($is_set == 0) ? 1 : 0;
        DB::table('cars')->where('id', $carId)
            ->update(['is_set' => $set]);
        return back()->with('updated', 'Successfully updated!');
    }
}
