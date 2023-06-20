@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Add Doctors</h1>
        <div class="lead">
            Add Doctors and assign role.
        </div>

        <div class="container mt-4">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input value="{{ old('firstname') }}" 
                        type="text" 
                        class="form-control" 
                        name="firstname" 
                        placeholder="first Name" required>

                    @if ($errors->has('firstname'))
                        <span class="text-danger text-left">{{ $errors->first('firstname') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input value="{{ old('lastname') }}" 
                        type="text" 
                        class="form-control" 
                        name="lastname" 
                        placeholder="last Name" required>
                    @if ($errors->has('lastname'))
                        <span class="text-danger text-left">{{ $errors->first('lastname') }}</span>
                    @endif
                </div>

                <!-- <div class="mb-3">
                    <label for="name" class="form-label">Password</label>
                    <input value="{{ old('password') }}" 
                        type="text" 
                        class="form-control" 
                        name="password" 
                        placeholder="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div> -->

               
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ old('email') }}"
                        type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" name="role" required>
                        <option value="select_role">Select Role</option>
                        <option value="doctor">Doctor</option>
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>

                

               

                <button type="submit" class="btn btn-primary">Save user</button>
            </form>
        </div>

    </div>
@endsection