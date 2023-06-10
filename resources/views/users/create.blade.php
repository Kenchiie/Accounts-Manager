@extends('adminlte::page')
@section('title', 'Users | Create')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
    <div class="row py-4">
        <div class="col-md-6 col-12 mx-auto">
            <x-adminlte-card theme="primary" theme-mode="outline" title="Add User">
                <form action='{{ route('users.store') }}' method='POST'>
                    @csrf

                    <div>
                        <label class="required" for="first_name">First Name</label>
                        <x-adminlte-input name="first_name" id="first_name" value="{{ old('first_name') }}" required autofocus />
                    </div>
                    <div>
                        <label class="required" for="last_name">Last Name</label>
                        <x-adminlte-input name="last_name" id="last_name" value="{{ old('last_name') }}" required />
                    </div>
                    <div>
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('users.index') }}" class="btn btn-danger">Discard</a>
                    </div>
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
