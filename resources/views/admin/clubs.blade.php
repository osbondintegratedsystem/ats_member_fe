@extends('layouts.app')

@section('title', 'Master Club')

@push('styles')
<style>
    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.8);
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
        max-width: 500px;
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
        padding: 40px;
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1 class="page-title">Master Club</h1>
        <a href="javascript:void(0)" class="btn-primary" onclick="openAddClubModal()">+ ADD CLUB</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Club ID</th>
                        <th>Club Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clubs as $club)
                        <tr>
                            <td><strong>{{ $club->id }}</strong></td>
                            <td>{{ $club->name }}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="openEditClubModal('{{ $club->id }}', '{{ $club->name }}')" style="color: var(--white); margin-right: 10px;">Edit</a>
                                <a href="javascript:void(0)" onclick="openDeleteClubModal('{{ $club->id }}')" style="color: var(--red);">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center;">No clubs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Club Modal -->
    <div id="clubModal" class="modal-overlay" onclick="closeClubModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="modal-close" onclick="closeClubModalDirect()">&times;</span>
            <div class="modal-body">
                <h2 id="modalTitle" style="font-family: 'Barlow Condensed', sans-serif; font-size: 28px; margin-bottom: 25px; text-transform: uppercase;">Add New Club</h2>
                
                <form onsubmit="event.preventDefault(); alert('Club saved!'); closeClubModalDirect();">
                    <div class="form-group">
                        <label class="form-label">Club ID</label>
                        <input type="text" id="c-id" class="form-control" placeholder="CLB-XXX" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Club Name</label>
                        <input type="text" id="c-name" class="form-control" placeholder="Enter club name" required>
                    </div>
                    
                    <div style="margin-top: 30px;">
                        <button type="submit" class="btn-primary" style="width: 100%;">Save Club</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirm Modal -->
    <div id="deleteClubModal" class="modal-overlay" onclick="closeDeleteModal(event)">
        <div class="modal-content" style="max-width: 400px;" onclick="event.stopPropagation()">
            <div class="modal-body" style="text-align: center;">
                <div style="font-size: 48px; color: var(--red); margin-bottom: 15px;">&times;</div>
                <h2 style="font-family: 'Barlow Condensed', sans-serif; font-size: 24px; margin-bottom: 10px; text-transform: uppercase;">Are you sure?</h2>
                <p style="color: var(--gray); margin-bottom: 30px;">Do you really want to delete club <strong id="delete-clubname" style="color: var(--white);">---</strong>? This action cannot be undone.</p>
                
                <div style="display: flex; gap: 15px;">
                    <button class="btn-primary" style="flex: 1; background: #333;" onclick="closeDeleteModalDirect()">Cancel</button>
                    <button class="btn-primary" style="flex: 1;" onclick="submitDeleteClub()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAddClubModal() {
            document.getElementById('modalTitle').textContent = 'Add New Club';
            document.getElementById('c-id').value = '';
            document.getElementById('c-name').value = '';
            document.getElementById('c-id').readOnly = false;
            document.getElementById('clubModal').style.display = 'flex';
        }

        function openEditClubModal(id, name) {
            document.getElementById('modalTitle').textContent = 'Edit Club';
            document.getElementById('c-id').value = id;
            document.getElementById('c-name').value = name;
            document.getElementById('c-id').readOnly = true;
            document.getElementById('clubModal').style.display = 'flex';
        }

        function closeClubModal(event) {
            if (event.target.id === 'clubModal') closeClubModalDirect();
        }

        function closeClubModalDirect() {
            document.getElementById('clubModal').style.display = 'none';
        }

        function openDeleteClubModal(clubname) {
            document.getElementById('delete-clubname').textContent = clubname;
            document.getElementById('deleteClubModal').style.display = 'flex';
        }

        function closeDeleteModal(event) {
            if (event.target.id === 'deleteClubModal') closeDeleteModalDirect();
        }

        function closeDeleteModalDirect() {
            document.getElementById('deleteClubModal').style.display = 'none';
        }

        async function submitClubForm(event) {
            event.preventDefault();
            const id = document.getElementById('c-id').value;
            const name = document.getElementById('c-name').value;
            const isEdit = document.getElementById('c-id').readOnly;

            const payload = { id, name };
            const url = isEdit ? `/admin/clubs/${id}` : `/admin/clubs`;
            const method = isEdit ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method: method,
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify(payload)
                });
                
                if (res.ok) window.location.reload();
                else alert('Failed to save club');
            } catch(e) { alert('Error communicating'); }
        }
        document.querySelector('#clubModal form').onsubmit = submitClubForm;

        async function submitDeleteClub() {
            const id = document.getElementById('delete-clubname').textContent;
            try {
                const res = await fetch(`/admin/clubs/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                if (res.ok) window.location.reload();
                else alert('Failed to delete');
            } catch(e) { alert('Error communicating'); }
        }
    </script>
@endsection
