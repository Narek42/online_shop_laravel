<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" href="/seller">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="/seller/myProducts">My Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="/seller/addProduct">Add product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="/logout">Logout</a>
        </li>
    </ul>
</nav>

<div class="container">
    @yield('p1')
    @yield('p2')
    @yield('p3')
</div>
