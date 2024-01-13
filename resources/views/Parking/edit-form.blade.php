@extends('Parking/layout')

@section('title', 'Update client and his cars')

@section('content')
    <a type="button" class="btn btn-primary" href="{{ route('index') }}">Back to users</a>
    @if(Session::has('updated'))
        <div class="alert alert-success" role="alert">
            {{Session::get('updated')}}
        </div>
    @endif
    @if(Session::has('Car added'))
        <div class="alert alert-success" role="alert">
            {{Session::get('Car added')}}
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
    <form method="POST" action="{{route('update')}}">
        @csrf
        <h3>Update Client data:</h3>
        <input type="hidden" name="client_id" value="{{isset($client[0]->id)?$client[0]->id:null}}">
        <div class="row mt-3">
            <div class="col">
                <label for="fullname">Full name</label>
                <input name="fullname" value="{{isset($client[0]->fullname)?$client[0]->fullname:null}}"
                       type="text" class="form-control" placeholder="Name" aria-label="fullname">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="gender">Gender</label>
                <input name="gender" value="{{isset($client[0]->gender)?$client[0]->gender:null}}"
                       type="text" class="form-control" placeholder="Gender" aria-label="gender">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="phone_number">Phone number</label>
                <input name="phone_number" value="{{isset($client[0]->phone_number)?$client[0]->phone_number:null}}"
                       type="text" class="form-control" placeholder="Phone number" aria-label="phone_number">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="address">Address</label>
                <input name="address" value="{{isset($client[0]->address)?$client[0]->address:null}}"
                       type="text" class="form-control" placeholder="Address" aria-label="address">
            </div>
        </div>
        @if(isset($cars))
            @foreach($cars as $car)
                <form method="POST" action="{{route('update')}}">
                    @csrf
                    <h3>Car</h3>
                    <input type="hidden" name="car_id" value="{{isset($car->id)?$car->id:null}}">
                    <div class="row mt-3">
                        <div class="col">
                            <label for="car_brand">Car brand</label>
                            <input name="car_brand" value="{{isset($car->car_brand)?$car->car_brand:null}}"
                                   type="text" class="form-control" placeholder="Car brand" aria-label="car_brand">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="model">Model</label>
                            <input name="model" value="{{isset($car->model)?$car->model:null}}"
                                   type="text" class="form-control" placeholder="Model" aria-label="model">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="color">Color</label>
                            <input name="color" value="{{isset($car->color)?$car->color:null}}"
                                   type="text" class="form-control" placeholder="Color" aria-label="color">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="state_number">State number</label>
                            <input name="state_number" value="{{isset($car->state_number)?$car->state_number:null}}"
                                   type="text" class="form-control" placeholder="State number"
                                   aria-label="state_number">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="is_set">Is set</label>
                            <input name="is_set" value="{{isset($car->is_set)?$car->is_set:null}}"
                                   type="text" class="form-control" placeholder="Is set" aria-label="is_set">
                        </div>
                    </div>
                    <div class="row mt-3"></div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            @endforeach
            <div class="mt-3 row">
                <div class="row">
                    {{ $cars->links() }}
                </div>
            </div>
        @endif
    </form>

    <h3>Add car</h3>
    <form method="POST" action="{{route('addcar')}}">
        @csrf
        <input type="hidden" name="client_id" value="{{isset($client[0]->id)?$client[0]->id:null}}">
        <div class="row mt-3">
            <div class="col">
                <label for="car_brand">Car brand</label>
                <input name="car_brand" value="" type="text" class="form-control" placeholder="Car brand"
                       aria-label="car_brand">
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
                <input name="state_number" value="" type="text" class="form-control" placeholder="State number"
                       aria-label="state_number">
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
                <button type="submit" class="btn btn-primary">Create car</button>
            </div>
        </div>
    </form>
@endsection
