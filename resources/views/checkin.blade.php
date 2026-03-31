@extends('layouts.app')

@section('title', 'Checkin & Checkout')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Checkin & Checkout</h1>
    </div>

    <div class="card" style="max-width: 500px;">
        <form onsubmit="event.preventDefault(); loadMember()">
            <div class="form-group">
                <label class="form-label" for="member_id">ID Member</label>
                <input type="text" id="member_id" name="id" class="form-control" placeholder="Scan or Enter ID Member" required autofocus autocomplete="off">
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="button" class="btn-primary" style="flex: 1;" onclick="submitAction('checkin')">CHECKIN</button>
                <button type="button" class="btn-primary" style="flex: 1; background: #333;" onclick="submitAction('checkout')">CHECKOUT</button>
            </div>
        </form>
    </div>

    <!-- View of member info after input -->
    <div id="member_preview" class="card" style="max-width: 500px; display: none; gap: 20px; align-items: center; margin-top: 20px;">
        <div style="width: 100px; height: 100px; background: var(--dark-3); border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid var(--red);">
            <img id="preview_photo" src="" alt="Member Photo">
        </div>
        <div>
            <h2 id="preview_name" style="font-family: 'Barlow Condensed', sans-serif; font-size: 24px; margin-bottom: 4px;">...</h2>
            <p id="preview_id" style="color: var(--gray); font-size: 14px; margin-bottom: 8px;">ID: ...</p>
            <span id="preview_status" class="badge badge-green">...</span>
        </div>
    </div>

@push('scripts')
<script>
    let currentMember = null;
    let timer = null;

    document.getElementById('member_id').addEventListener('input', function(e) {
        clearTimeout(timer);
        timer = setTimeout(() => {
            if(this.value.length > 3) loadMember();
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
        } catch(e) { console.error('Error fetching member details'); }
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
