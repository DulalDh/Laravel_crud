<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">DH Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                <a class="nav-link" href="{{ route('shop.index') }}">Shop List</a>
                <a class="nav-link" href="{{ route('customer.index') }}">Customer List</a>
                <a class="nav-link" href="{{ route('student.index') }}">Student List</a>
                <a class="nav-link" href="{{ route('course.index') }}">Course List</a>
            </div>
        </div>
    </div>
</nav>
