<h2>Data User</h2>

<a href="{{ route('admin.user.create') }}">Tambah User</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Kelas</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($user as $u)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->role }}</td>
        <td>{{ $u->kelas->nama_kelas ?? '-' }}</td>
        <td>
            @if($u->is_active)
                <span style="color:green;"><b>Aktif</b></span>
            @else
                <span style="color:red;"><b>Nonaktif</b></span>
            @endif
        </td>
        <td>
            <a href="{{ route('admin.user.edit', $u->id) }}">Edit</a>

            <form action="{{ route('admin.user.destroy', $u->id) }}"
                  method="POST"
                  style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="submit"
                        onclick="return confirm('Yakin hapus user?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>