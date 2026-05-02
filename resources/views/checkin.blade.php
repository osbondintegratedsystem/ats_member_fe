@extends('layouts.app')

@section('title', 'Checkin & Checkout')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Checkin & Checkout</h1>
    </div>

    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 20px;">
        <!-- Left: Check In Form -->
        <div class="card" style="flex: 1; min-width: 300px; margin-bottom: 0;">
            <form onsubmit="event.preventDefault(); loadMember()">
                <div class="form-group">
                    <label class="form-label" for="member_id">ID MEMBER</label>
                    <input type="text" id="member_id" name="id" class="form-control" placeholder="xxx" required autofocus
                        autocomplete="off">
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="button" class="btn-primary"
                        style="flex: 1; padding: 10px; font-weight: bold; border: 1px solid var(--red);"
                        onclick="submitAction('checkin')">CHECK IN</button>
                    <button type="button" class="btn-primary"
                        style="flex: 1; background: transparent; border: 1px solid var(--gray); color: var(--text-color); font-weight: bold; padding: 10px;"
                        onclick="submitAction('checkout')">CHECK OUT</button>
                </div>
            </form>
        </div>

        <!-- Right: Filter Form -->
        <div class="card" style="flex: 1; min-width: 300px; margin-bottom: 0;">
            <form action="" method="GET">

                <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">START</label>
                        <input type="date" class="form-control" name="date_start" value="{{ $startDate ?? now()->format('Y-m-d') }}">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">END</label>
                        <input type="date" class="form-control" name="date_end" value="{{ $endDate ?? now()->format('Y-m-d') }}">
                    </div>
                </div>

                <button class="btn-primary" type="submit"
                    style="width: 100%; background: transparent; border: 1px solid var(--gray); color: var(--text-color); height: 46px; font-weight: bold;">
                    FILTER
                </button>

            </form>
        </div>
    </div>

    <!-- View of member info after input -->
    <div id="member_preview" class="card"
        style="max-width: 500px; display: none; gap: 20px; align-items: center; margin-bottom: 20px;">
        <div
            style="width: 100px; height: 100px; background: var(--dark-3); border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid var(--red);">
            <img id="preview_photo" src="" alt="Member Photo">
        </div>
        <div>
            <h2 id="preview_name" style="font-family: 'Barlow Condensed', sans-serif; font-size: 24px; margin-bottom: 4px;">
                ...</h2>
            <p id="preview_id" style="color: var(--gray); font-size: 14px; margin-bottom: 8px;">ID: ...</p>
            <span id="preview_status" class="badge badge-green">...</span>
        </div>
    </div>

    <!-- Recap Table -->
    <div class="card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="text-transform: uppercase;">MEMBER ID</th>
                        <th style="text-transform: uppercase;">MEMBER NAME</th>
                        <th style="text-transform: uppercase;">TYPE</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recaps ?? [] as $recap)
                    <tr>
                        <td><strong>{{ $recap->memberId }}</strong></td>
                        <td style="text-transform: uppercase;">{{ $recap->memberName }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="text-align: center;">
                                    <span class="badge"
                                        style="background: transparent; color: var(--text-color); border: 1px solid var(--gray); margin-bottom: 5px; display: inline-block; border-radius: 4px; padding: 4px 10px;">{{ strtoupper($recap->type) }}</span><br>
                                    <small style="color: var(--gray);">{{ \Carbon\Carbon::parse($recap->dateTime)->format('d-m-y H:i') }}</small>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">No check-ins found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('styles')
    <style>
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .modal-content {
            background: var(--dark-2);
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }
        .modal-close {
            position: absolute;
            top: 15px; right: 20px;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
            z-index: 10;
        }
        .modal-header-bg {
            height: 100px;
            background: linear-gradient(45deg, var(--red), #ff4d4d);
        }
        .modal-profile-info {
            display: flex;
            padding: 0 20px;
            margin-top: -40px;
            align-items: flex-end;
            gap: 15px;
            margin-bottom: 20px;
        }
        .modal-photo {
            width: 80px; height: 80px;
            border-radius: 50%;
            border: 4px solid var(--dark-2);
            background: var(--dark-3);
            object-fit: cover;
        }
        .modal-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 24px;
            font-weight: 700;
            line-height: 1.2;
        }
        .modal-id {
            color: var(--gray);
            font-size: 14px;
        }
        .detail-grid {
            padding: 0 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .detail-item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 8px;
        }
        .detail-item label {
            color: var(--gray);
            font-size: 14px;
        }
        .detail-item span {
            font-weight: 600;
        }
    </style>
    @endpush

    <!-- Member Detail Modal -->
    <div id="memberModal" class="modal-overlay" style="display: none;" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="modal-close" onclick="closeModalDirect()">&times;</span>
            <div class="modal-body">
                <div class="modal-header-bg"></div>
                <div class="modal-profile-info">
                    <img id="m-photo" src="" alt="Member" class="modal-photo">
                    <div class="modal-details">
                        <div id="m-name" class="modal-name">---</div>
                        <div id="m-id" class="modal-id">---</div>
                    </div>
                </div>
                
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Last Package</label>
                        <span id="m-package">---</span>
                    </div>
                    <div class="detail-item">
                        <label>Expiration Date</label>
                        <span id="m-exp">---</span>
                    </div>
                    <div class="detail-item">
                        <label>HP / Phone</label>
                        <span id="m-hp">---</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let currentMember = null;
            let timer = null;

            document.getElementById('member_id').addEventListener('input', function (e) {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    if (this.value.length > 3) loadMember();
                }, 500);
            });

            async function loadMember() {
                const id = document.getElementById('member_id').value;
                if (!id) return;

                try {
                    const res = await fetch(`/members/${id}`, {
                        headers: { 'Accept': 'application/json' }
                    });
                    if (res.ok) {
                        const data = await res.json();
                        currentMember = data;

                        document.getElementById('preview_name').textContent = data.name.toUpperCase();
                        document.getElementById('preview_id').textContent = `ID: ${data.id}`;
                        document.getElementById('preview_status').textContent = data.status || 'ACTIVE';
                        document.getElementById('preview_photo').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(data.name)}&background=D42B2B&color=fff&size=200`;

                        document.getElementById('member_preview').style.display = 'flex';
                    } else {
                        document.getElementById('member_preview').style.display = 'none';
                        currentMember = null;
                    }
                } catch (e) { console.error('Error fetching member details'); }
            }

            async function submitAction(actionType) {
                const id = document.getElementById('member_id').value;
                if (!id) return alert('Please enter ID Member');

                try {
                    const res = await fetch(`/${actionType}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ member_id: id })
                    });

                    const data = await res.json();
                    if (res.ok) {
                        const memberInfo = data.data && data.data.member ? data.data.member : currentMember;
                        if(memberInfo) {
                            sessionStorage.setItem('showCheckinModal', JSON.stringify(memberInfo));
                        } else {
                            // Fallback if we don't have member details
                            sessionStorage.setItem('showCheckinModal', JSON.stringify({id: id, name: 'Unknown'}));
                        }
                        window.location.href = '{{ route("checkin") }}';
                    } else {
                        alert(`Error: ${data.message || 'Failed'}`);
                    }
                } catch (e) {
                    alert('Communication Error');
                }
            }

            function closeModal(e) {
                if (e.target.id === 'memberModal') {
                    closeModalDirect();
                }
            }

            function closeModalDirect() {
                document.getElementById('memberModal').style.display = 'none';
            }

            window.addEventListener('DOMContentLoaded', () => {
                const modalDataStr = sessionStorage.getItem('showCheckinModal');
                if (modalDataStr) {
                    try {
                        const memberData = JSON.parse(modalDataStr);
                        document.getElementById('m-name').textContent = (memberData.name || '---').toUpperCase();
                        document.getElementById('m-id').textContent = memberData.id || '---';
                        document.getElementById('m-photo').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(memberData.name || 'Unknown')}&background=D42B2B&color=fff&size=200`;
                        document.getElementById('m-package').textContent = memberData.package || '---';
                        document.getElementById('m-exp').textContent = memberData.expired_date || '---';
                        document.getElementById('m-hp').textContent = memberData.phone || '---';
                        
                        document.getElementById('memberModal').style.display = 'flex';
                    } catch (e) {}
                    sessionStorage.removeItem('showCheckinModal');
                }
            });
        </script>
    @endpush
@endsection