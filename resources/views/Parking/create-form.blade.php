@extends('Parking/layout')

@section('title', 'Create new client')

@section('content')
    <a type="button" class="btn btn-primary" href="{{ route('index') }}">Back to users</a>
    @if(Session::has('created'))
        <div class="alert alert-success" role="alert">
            {{Session::get('created')}}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('add')}}">
        @csrf
        <h3>Input Client data:</h3>
        <div class="row mt-3">
            <div class="col">
                <label for="fullname">Full name</label>
                <input name="fullname" value="" type="text" class="form-control" placeholder="Name" aria-label="fullname">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="gender">Gender</label>
                <input name="gender" value="" type="text" class="form-control" placeholder="Gender" aria-label="gender">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="phone_number">Phone number</label>
                <input name="phone_number" value="" type="text" class="form-control" placeholder="Phone number" aria-label="phone_number">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="address">Address</label>
                <input name="address" value="" type="text" class="form-control" placeholder="Address" aria-label="address">
            </div>
        </div>
        <br>
        <h3>Input Clients car data:</h3>
        <div class="row mt-3">
            <div class="col">
                <label for="car_brand">Car brand</label>
                <input name="car_brand" value="" type="text" class="form-control" placeholder="Car brand" aria-label="car_brand">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="model">Model</label>
                <input name="model" value="" type="text" class="form-control" placeholder="Model" aria-label="model">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="color">Color</label>
                <input name="color" value="" type="text" class="form-control" placeholder="Color" aria-label="color">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="state_number">State number</label>
                <input name="state_number" value="" type="text" class="form-control" placeholder="State number" aria-label="state_number">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="is_set">Is set</label>
                <input name="is_set" value="" type="text" class="form-control" placeholder="Is set" aria-label="is_set">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-primary">Create client and car</button>
            </div>
        </div>
        <div class="row mt-3"></div>
    </form>

@endsection
