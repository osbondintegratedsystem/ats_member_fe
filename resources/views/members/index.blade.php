@extends('layouts.app')

@section('title', 'List Member')

@push('styles')
<style>
    .member-row {
        cursor: pointer;
        transition: background 0.2s;
    }
    .member-row:hover td {
        background: rgba(212, 43, 43, 0.05) !important;
    }

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        padding: 20px;
    }
    .modal-content {
        background: var(--dark-2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        width: 100%;
        max-width: 600px;
        border-radius: 12px;
        position: relative;
        animation: modalFadeIn 0.3s ease-out;
        overflow: hidden;
    }
    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        color: var(--gray);
        cursor: pointer;
        font-size: 24px;
        z-index: 10;
    }
    .modal-body {
        padding: 0;
    }
    .modal-header-bg {
        background: linear-gradient(to bottom, var(--red-dark), var(--dark-2));
        height: 120px;
    }
    .modal-profile-info {
        display: flex;
        padding: 0 40px 40px;
        margin-top: -60px;
        gap: 30px;
    }
    .modal-photo {
        width: 140px;
        height: 140px;
        background: var(--dark-3);
        border: 4px solid var(--dark-2);
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        object-fit: cover;
    }
    .modal-details {
        flex: 1;
        padding-top: 70px;
    }
    .modal-name {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 32px;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 5px;
    }
    .modal-id {
        color: var(--red);
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 15px;
    }
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 20px;
        padding: 0 40px 40px;
    }
    .detail-item label {
        display: block;
        font-size: 11px;
        text-transform: uppercase;
        color: rgba(255,255,255,0.4);
        margin-bottom: 5px;
        letter-spacing: 1px;
    }
    .detail-item span {
        font-weight: 600;
        color: var(--white);
    }
    .modal-actions {
        display: flex;
        gap: 15px;
        padding: 0 40px 40px;
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1 class="page-title">List Member</h1>
        <a href="javascript:void(0)" class="btn-primary" onclick="openAddMemberModal()">+ ADD MEMBER</a>
    </div>

    <div class="card" style="margin-bottom: 20px;">
        <form action="{{ route('members') }}" method="GET" style="display: flex; gap: 10px; max-width: 400px;">
            <input type="text" class="form-control" placeholder="Search by ID or Name..." name="search" value="{{ $search ?? '' }}">
            <button class="btn-primary" type="submit">SEARCH</button>
        </form>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID Member</th>
                        <th>Name</th>
                        <th>Last Package</th>
                        <th>Exp Date</th>
                        <th>HP</th>
                    </tr>
                </thead>
                    @forelse($members as $member)
                        <tr class="member-row" onclick="showMemberDetail('{{ $member->id }}', '{{ $member->name }}', '{{ $member->package }}', '{{ $member->expirationDate }}', '{{ $member->phone }}')">
                            <td><strong>{{ $member->id }}</strong></td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->package }}</td>
                            <td><span class="badge badge-green">{{ $member->expirationDate }}</span></td>
                            <td>{{ $member->phone }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Member Detail Modal -->
    <div id="memberModal" class="modal-overlay" onclick="closeModal(event)">
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

                <div class="modal-actions">
                    <button class="btn-primary" style="flex: 1;" onclick="alert('Checking in...'); closeModalDirect();">Check In</button>
                    <button class="btn-primary" style="flex: 1; background: #333;" onclick="alert('Checking out...'); closeModalDirect();">Check Out</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    <div id="addMemberModal" class="modal-overlay" onclick="closeAddModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="modal-close" onclick="closeAddModalDirect()">&times;</span>
            <div class="modal-body" style="padding: 40px;">
                <h2 style="font-family: 'Barlow Condensed', sans-serif; font-size: 28px; margin-bottom: 25px; text-transform: uppercase;">Add New Member</h2>
                
                <form id="addMemberForm">
                    <div class="form-group">
                        <label class="form-label">Member ID</label>
                        <input type="text" id="add-id" class="form-control" placeholder="ATS-XXXXX" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" id="add-name" class="form-control" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Package</label>
                        <input type="text" id="add-package" class="form-control" placeholder="e.g. Gold Membership" required>
                    </div>
                    <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label class="form-label">Exp Date</label>
                            <input type="date" id="add-exp" class="form-control" required>
                        </div>
                        <div>
                            <label class="form-label">HP / Phone</label>
                            <input type="text" id="add-phone" class="form-control" placeholder="08xxxxxxxx" required>
                        </div>
                    </div>
                    
                    <div style="margin-top: 30px;">
                        <button type="submit" class="btn-primary" style="width: 100%;">Save Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddMemberModal() {
            document.getElementById('addMemberModal').style.display = 'flex';
        }

        function closeAddModal(e) {
            if (e.target.id === 'addMemberModal') {
                closeAddModalDirect();
            }
        }

        function closeAddModalDirect() {
            document.getElementById('addMemberModal').style.display = 'none';
        }

        function showMemberDetail(id, name, package, exp, hp) {
            document.getElementById('m-id').textContent = id;
            document.getElementById('m-name').textContent = name;
            document.getElementById('m-package').textContent = package;
            document.getElementById('m-exp').textContent = exp;
            document.getElementById('m-hp').textContent = hp;
            
            // Dummy photo using UI Avatars
            document.getElementById('m-photo').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=D42B2B&color=fff&size=200`;
            
            document.getElementById('memberModal').style.display = 'flex';
        }

        function closeModal(e) {
            if (e.target.id === 'memberModal') {
                closeModalDirect();
            }
        }

        document.getElementById('addMemberForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const payload = {
                id: document.getElementById('add-id').value,
                name: document.getElementById('add-name').value,
                package: document.getElementById('add-package').value,
                expiration_date: document.getElementById('add-exp').value,
                phone: document.getElementById('add-phone').value
            };

            try {
                const res = await fetch('/members', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify(payload)
                });
                
                if (res.ok) window.location.reload();
                else alert('Failed to save member');
            } catch(e) { alert('Error communicating'); }
        });
    </script>
@endsection
