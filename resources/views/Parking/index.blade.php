@extends('Parking/layout')

@section('title', 'Clients List:')

@section('content')
    @csrf
    <a class="btn btn-primary" role="button" href="{{ route('create') }}">Create client</a>
    <a class="btn btn-primary" role="button" href="{{ route('location') }}">Change car location</a>
    @if(Session::has('deleted'))
        <div class="alert alert-success" role="alert">
            {{Session::get('deleted')}}
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Car model</th>
            <th scope="col">State number</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clientWithCars as $clientCar)
            <tr>
                <td>
                    <a href="">{{ $clientCar->fullname }}</a>
                </td>
                <td>
                    <a>{{ $clientCar->car_brand }}</a>
                </td>
                <td>
                    <a href="">{{ $clientCar->state_number }}</a>
                </td>
                <td>
                    <a type="button" class="btn btn-warning"
                       href="{{route('edit', $clientCar->id)}}">
                        Edit</a>
                    <a type="button" class="btn btn-danger"
                       href="{{route('delete', $clientCar->id)}}">
                        Delete</a>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-3 row">
        <div class="row">
            {{ $clientWithCars->links() }}
        </div>
    </div>


@endsection
