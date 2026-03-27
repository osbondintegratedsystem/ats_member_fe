@extends('layouts.app')

@section('title', 'Recap Daily Checkin')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Recap Daily Checkin</h1>
    </div>

    <div class="card" style="margin-bottom: 20px;">
        <form action="#" method="GET" style="display: flex; gap: 10px; max-width: 500px; align-items: flex-end;">
            <div class="form-group" style="margin-bottom: 0; flex: 1;">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date">
            </div>
            <div class="form-group" style="margin-bottom: 0; flex: 1;">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date">
            </div>
            <button class="btn-primary" type="button" style="height: 46px;">FILTER</button>
        </form>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Date Time</th>
                        <th>Member ID</th>
                        <th>Member Name</th>
                        <th>Club</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2026-02-28 08:15:22</td>
                        <td><strong>ATS-1001</strong></td>
                        <td>John Doe</td>
                        <td>Osbond Main Club</td>
                        <td><span class="badge badge-green">CHECK IN</span></td>
                    </tr>
                    <tr>
                        <td>2026-02-28 09:30:10</td>
                        <td><strong>ATS-1003</strong></td>
                        <td>Michael Johnson</td>
                        <td>Osbond Main Club</td>
                        <td><span class="badge badge-green">CHECK IN</span></td>
                    </tr>
                    <tr>
                        <td>2026-02-28 10:45:00</td>
                        <td><strong>ATS-1001</strong></td>
                        <td>John Doe</td>
                        <td>Osbond Main Club</td>
                        <td><span class="badge" style="background: rgba(255,255,255,0.1); color: var(--gray); border: 1px solid rgba(255,255,255,0.2);">CHECK OUT</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
