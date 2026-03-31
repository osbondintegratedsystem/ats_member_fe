@extends('layouts.app')

@section('title', 'Recap Daily Checkin')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Recap Daily Checkin</h1>
    </div>

    <div class="card" style="margin-bottom: 20px;">
        <form action="{{ route('recap') }}" method="GET" style="display: flex; gap: 10px; max-width: 500px; align-items: flex-end;">
            <div class="form-group" style="margin-bottom: 0; flex: 1;">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" value="{{ $startDate ?? '' }}">
            </div>
            <div class="form-group" style="margin-bottom: 0; flex: 1;">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" value="{{ $endDate ?? '' }}">
            </div>
            <button class="btn-primary" type="submit" style="height: 46px;">FILTER</button>
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
                    @forelse($recaps as $recap)
                        <tr>
                            <td>{{ $recap->dateTime }}</td>
                            <td><strong>{{ $recap->memberId }}</strong></td>
                            <td>{{ $recap->memberName }}</td>
                            <td>{{ $recap->clubName }}</td>
                            <td>
                                @if($recap->type == 'CHECK IN')
                                    <span class="badge badge-green">{{ $recap->type }}</span>
                                @else
                                    <span class="badge" style="background: rgba(255,255,255,0.1); color: var(--gray); border: 1px solid rgba(255,255,255,0.2);">{{ $recap->type }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No recaps found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
