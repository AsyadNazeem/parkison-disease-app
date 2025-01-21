<h1>Test</h1>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
