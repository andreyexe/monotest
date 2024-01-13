@extends('Parking/layout')

@section('title', 'Change car location form')

@section('content')
    <a type="button" class="btn btn-primary" href="{{ route('index') }}">Back to users</a>

    @if(Session::has('updated'))
        <div class="alert alert-success" role="alert">
            {{Session::get('updated')}}
        </div>
    @endif
    <div class="row mt-3">
        <div class="dropdown col">
            <button class="btn btn-primary dropdown-toggle" type="button"
                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Clients:
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @foreach($clients as $client)
                    <li><a class="dropdown-item" href="{{ route('location', $client->id) }}">{{ $client->fullname }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        @if(isset($cars))
            {{--@dd($cars)--}}
            <div class="dropdown col">
                <button class="btn btn-primary dropdown-toggle" type="button"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Cars:
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach($cars as $car)
                        <li><a class="dropdown-item"
                               href="{{ route('location',[$car->client_id,$car->id]) }}">
                                {{ $car->state_number }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
    </div>
    @endif
    @if(isset($oneCar))
        <div class="row mt-3">
            <form action="{{ route('changeLocation',['carId'=>$oneCar[0]->id,'is_set'=>$oneCar[0]->is_set])  }}" method="get">
                @csrf
                <table class="table caption-top">
                    <caption>Список пользователей</caption>
                    <thead>
                    <tr>
                        <th scope="col">Specifications</th>
                        <th scope="col">Car</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">car_brand</th>
                        <td>{{$oneCar[0]->car_brand}}</td>
                    </tr>
                    <tr>
                        <th scope="row">model</th>
                        <td>{{$oneCar[0]->model}}</td>
                    </tr>
                    <tr>
                        <th scope="row">state_number</th>
                        <td>{{$oneCar[0]->state_number}}</td>
                    </tr>
                    <tr>
                        <th scope="row">color</th>
                        <td>{{$oneCar[0]->color}}</td>
                    </tr>
                    <tr>
                        <th scope="row">is_set</th>
                        <td>{{$oneCar[0]->is_set}}</td>
                        <td>
                            <button class="btn btn-primary" type="submit" id="btn">
                                Change location
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    @endif
@endsection
