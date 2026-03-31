@extends('layouts.app')

@section('title', 'Master User')

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
        <h1 class="page-title">Master User</h1>
        <a href="javascript:void(0)" class="btn-primary" onclick="openAddUserModal()">+ ADD USER</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID / Username</th>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td><strong>{{ $user->username }}</strong></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if($user->status === 'ACTIVE')
                                    <span class="badge badge-green">ACTIVE</span>
                                @else
                                    <span class="badge badge-red">{{ $user->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0)" onclick="openEditUserModal('{{ $user->username }}', '{{ $user->name }}', '{{ $user->role }}', '{{ $user->status }}')" style="color: var(--white); margin-right: 10px;">Edit</a>
                                <a href="javascript:void(0)" onclick="openDeleteUserModal('{{ $user->username }}')" style="color: var(--red);">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit User Modal -->
    <div id="userModal" class="modal-overlay" onclick="closeUserModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="modal-close" onclick="closeUserModalDirect()">&times;</span>
            <div class="modal-body">
                <h2 id="modalTitle" style="font-family: 'Barlow Condensed', sans-serif; font-size: 28px; margin-bottom: 25px; text-transform: uppercase;">Add New User</h2>
                
                <form onsubmit="event.preventDefault(); alert('User saved!'); closeUserModalDirect();">
                    <div class="form-group">
                        <label class="form-label">ID / Username</label>
                        <input type="text" id="u-id" class="form-control" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" id="u-name" class="form-control" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select id="u-role" class="form-control">
                            <option value="Administrator">Administrator</option>
                            <option value="Receptionist">Manager</option>
                            <option value="Manager">Customer Service</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select id="u-status" class="form-control">
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="INACTIVE">INACTIVE</option>
                        </select>
                    </div>
                    
                    <div style="margin-top: 30px;">
                        <button type="submit" class="btn-primary" style="width: 100%;">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirm Modal -->
    <div id="deleteUserModal" class="modal-overlay" onclick="closeDeleteModal(event)">
        <div class="modal-content" style="max-width: 400px;" onclick="event.stopPropagation()">
            <div class="modal-body" style="text-align: center;">
                <div style="font-size: 48px; color: var(--red); margin-bottom: 15px;">&times;</div>
                <h2 style="font-family: 'Barlow Condensed', sans-serif; font-size: 24px; margin-bottom: 10px; text-transform: uppercase;">Are you sure?</h2>
                <p style="color: var(--gray); margin-bottom: 30px;">Do you really want to delete user <strong id="delete-username" style="color: var(--white);">---</strong>? This action cannot be undone.</p>
                
                <div style="display: flex; gap: 15px;">
                    <form id="deleteUserForm" onsubmit="submitDelete(event)" style="display:none;"></form>
                    <button class="btn-primary" style="flex: 1; background: #333;" onclick="closeDeleteModalDirect()">Cancel</button>
                    <button class="btn-primary" style="flex: 1;" onclick="document.getElementById('deleteUserForm').dispatchEvent(new Event('submit'))">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAddUserModal() {
            document.getElementById('modalTitle').textContent = 'Add New User';
            document.getElementById('u-id').value = '';
            document.getElementById('u-name').value = '';
            document.getElementById('u-role').value = 'Receptionist';
            document.getElementById('u-status').value = 'ACTIVE';
            document.getElementById('u-id').readOnly = false;
            document.getElementById('userModal').style.display = 'flex';
        }

        function openEditUserModal(id, name, role, status) {
            document.getElementById('modalTitle').textContent = 'Edit User';
            document.getElementById('u-id').value = id;
            document.getElementById('u-name').value = name;
            document.getElementById('u-role').value = role;
            document.getElementById('u-status').value = status;
            document.getElementById('u-id').readOnly = true;
            document.getElementById('userModal').style.display = 'flex';
        }

        function closeUserModal(event) {
            if (event.target.id === 'userModal') closeUserModalDirect();
        }

        function closeUserModalDirect() {
            document.getElementById('userModal').style.display = 'none';
        }

        function openDeleteUserModal(username) {
            document.getElementById('delete-username').textContent = username;
            document.getElementById('deleteUserModal').style.display = 'flex';
        }

        function closeDeleteModal(event) {
            if (event.target.id === 'deleteUserModal') closeDeleteModalDirect();
        }

        function closeDeleteModalDirect() {
            document.getElementById('deleteUserModal').style.display = 'none';
        }

        async function submitUserForm(event) {
            event.preventDefault();
            const id = document.getElementById('u-id').value;
            const isEdit = document.getElementById('u-id').readOnly;
            
            const payload = {
                id: id,
                name: document.getElementById('u-name').value,
                role: document.getElementById('u-role').value,
                status: document.getElementById('u-status').value,
                _token: '{{ csrf_token() }}'
            };

            const url = isEdit ? `/admin/users/${id}` : `/admin/users`;
            const method = isEdit ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                });
                
                if (res.ok) {
                    window.location.reload();
                } else {
                    const data = await res.json();
                    alert(data.message || 'Failed to save');
                }
            } catch (err) {
                alert('Communication error');
            }
        }

        async function submitDelete(event) {
            event.preventDefault();
            const id = document.getElementById('delete-username').textContent;

            try {
                const res = await fetch(`/admin/users/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                if (res.ok) {
                    window.location.reload();
                } else {
                    alert('Failed to delete');
                }
            } catch (err) {
                alert('Communication error');
            }
        }

        document.querySelector('#userModal form').onsubmit = submitUserForm;
    </script>
@endsection
