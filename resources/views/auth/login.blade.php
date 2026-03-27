@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <form action="{{ url('/checkin') }}" method="GET">
        <div class="form-group">
            <label class="form-label" for="id">ID</label>
            <input type="text" id="id" name="id" class="form-control" placeholder="Enter your ID" required autofocus>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>
        
        <button type="submit" class="btn-primary" style="margin-top: 20px;">LOGIN</button>
    </form>
@endsection
