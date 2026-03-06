<h1>Dashboard Wali Kelas</h1>

<p>Selamat datang {{ Auth::user()->name }}</p>

<p>Kelas yang diampu: {{ Auth::user()->id_kelas }}</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>