@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Change Password</h1>
    </div>

    <div class="card" style="max-width: 500px;">
        <form action="#" method="GET">
            <div class="form-group">
                <label class="form-label">ID / Username</label>
                <input type="text" class="form-control" value="admin123" readonly>
            </div>
            
            <div class="form-group">
                <label class="form-label">Old Password</label>
                <input type="password" class="form-control" placeholder="Enter old password">
            </div>

            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" placeholder="Enter new password">
            </div>
            
            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" placeholder="Confirm new password">
            </div>
            
            <button type="button" class="btn-primary" onclick="alert('Password changed successfully!')">Update Password</button>
        </form>
    </div>
@endsection
