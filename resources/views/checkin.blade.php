@extends('layouts.app')

@section('title', 'Checkin & Checkout')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Checkin & Checkout</h1>
    </div>

    <div class="card" style="max-width: 500px;">
        <form action="#" method="GET">
            <div class="form-group">
                <label class="form-label" for="member_id">ID Member</label>
                <input type="text" id="member_id" name="id" class="form-control" placeholder="Scan or Enter ID Member" required autofocus>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="button" class="btn-primary" style="flex: 1;" onclick="alert('Checkin Successful!')">CHECKIN</button>
                <button type="button" class="btn-primary" style="flex: 1; background: #333;" onclick="alert('Checkout Successful!')">CHECKOUT</button>
            </div>
        </form>
    </div>

    <!-- Dummy view of member info after input -->
    <div class="card" style="max-width: 500px; display: flex; gap: 20px; align-items: center; margin-top: 20px;">
        <div style="width: 100px; height: 100px; background: var(--dark-3); border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid var(--red);">
            <img src="https://ui-avatars.com/api/?name=John+Doe&background=D42B2B&color=fff&size=100" alt="Member Photo">
        </div>
        <div>
            <h2 style="font-family: 'Barlow Condensed', sans-serif; font-size: 24px; margin-bottom: 4px;">JOHN DOE</h2>
            <p style="color: var(--gray); font-size: 14px; margin-bottom: 8px;">ID: ATS-102938</p>
            <span class="badge badge-green">ACTIVE MEMBER</span>
        </div>
    </div>
@endsection
