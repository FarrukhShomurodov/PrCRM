<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <form action="/" method="POST">
                @csrf
                <input class="btn btn-outline-primary" type="submit" value="Выход">
            </form>
        </li>
    </ul>
</nav>
