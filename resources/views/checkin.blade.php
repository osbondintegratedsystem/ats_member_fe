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
                        <input type="text" class="form-control" name="start_date" placeholder="dd/mm/yy">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">END</label>
                        <input type="text" class="form-control" name="end_date" placeholder="dd/mm/yy">
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
                    <tr>
                        <td><strong>xxx</strong></td>
                        <td style="text-transform: uppercase;">ALBERT EISTEN</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="text-align: center;">
                                    <span class="badge"
                                        style="background: transparent; color: var(--text-color); border: 1px solid var(--gray); margin-bottom: 5px; display: inline-block; border-radius: 4px; padding: 4px 10px;">CHECK
                                        IN</span><br>
                                    <small style="color: var(--gray);">dd-mm-yy HH:mm</small>
                                </div>
                                <span style="color: var(--gray); font-weight: bold; font-size: 20px;">-</span>
                                <div style="text-align: center;">
                                    <span class="badge"
                                        style="background: transparent; color: var(--text-color); border: 1px solid var(--gray); margin-bottom: 5px; display: inline-block; border-radius: 4px; padding: 4px 10px;">CHECK
                                        OUT</span><br>
                                    <small style="color: var(--gray);">dd-mm-yy HH:mm</small>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>xxx</strong></td>
                        <td style="text-transform: uppercase;">JOHN DOE</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="text-align: center;">
                                    <span class="badge"
                                        style="background: transparent; color: var(--text-color); border: 1px solid var(--gray); margin-bottom: 5px; display: inline-block; border-radius: 4px; padding: 4px 10px;">CHECK
                                        IN</span><br>
                                    <small style="color: var(--gray);">dd-mm-yy HH:mm</small>
                                </div>
                                <span style="color: var(--gray); font-weight: bold; font-size: 20px;">-</span>
                                <div style="text-align: center;">
                                    <span class="badge"
                                        style="background: transparent; color: var(--text-color); border: 1px solid var(--gray); margin-bottom: 5px; display: inline-block; border-radius: 4px; padding: 4px 10px;">CHECK
                                        OUT</span><br>
                                    <small style="color: var(--gray);">dd-mm-yy HH:mm</small>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>xxx</strong></td>
                        <td style="text-transform: uppercase;">THOMAS ALFA</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="text-align: center;">
                                    <span class="badge"
                                        style="background: transparent; color: var(--text-color); border: 1px solid var(--gray); margin-bottom: 5px; display: inline-block; border-radius: 4px; padding: 4px 10px;">CHECK
                                        IN</span><br>
                                    <small style="color: var(--gray);">dd-mm-yy HH:mm</small>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                        alert(`${actionType.toUpperCase()} Successful!`);
                        document.getElementById('member_id').value = '';
                        document.getElementById('member_preview').style.display = 'none';
                        document.getElementById('member_id').focus();
                    } else {
                        alert(`Error: ${data.message || 'Failed'}`);
                    }
                } catch (e) {
                    alert('Communication Error');
                }
            }
        </script>
    @endpush
@endsection