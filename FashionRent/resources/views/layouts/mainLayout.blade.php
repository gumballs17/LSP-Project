<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>FashionID | @yield('title')</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FASHION.ID</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <ul class="navbar-nav">
                        @if (Auth::User())

                        @if (Auth::User()->role_id === 1)
                        <li class="nav-item">
                            <a href="/dashboard"
                                class="nav-link @if (request()->route()->uri == 'dashboard') active @endif">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Fashion
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="/fashions"
                                        class="nav-link @if (in_array(request()->route()->uri, ['fashions', 'fashion-add', 'fashion-deleted', 'fashion-edit/{slug}', 'fashion-delete/{slug}'])) active @endif">Cloths</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/categories"
                                        class="nav-link @if (request()->route()->uri == 'categories' ||
                                                    request()->route()->uri == 'category-add' ||
                                                    request()->route()->uri == 'category-deleted' ||
                                                    request()->route()->uri == 'category-edit/{slug}' ||
                                                    request()->route()->uri == 'category-delete/{slug}') active @endif">Categories</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/users" class="nav-link @if (in_array(request()->route()->uri, [
                                                    'users',
                                                    'registered-users',
                                                    'user-approve/{slug}',
                                                    'user-ban/{slug}',
                                                    'user-deleted',
                                                ])) active @endif">Users</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Rent Fashion
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="/fashion-rent"
                                        class="nav-link @if (request()->route()->uri == 'fashion-rent') active @endif">
                                        Rent</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/fashion-return"
                                        class="nav-link @if (request()->route()->uri == 'fashion-return') active @endif">
                                        Return</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ml-auto">
                            <a href="/logout" class="nav-link">Logout</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="/fashionlist"
                                class="nav-link @if (request()->route()->uri == '/fashionlist') active @endif">Fashion
                                List</a>
                        </li>
                        <li class="nav-item">
                            <a href="/profile"
                                class="nav-link @if (request()->route()->uri == 'profile') active @endif">Rent Logs</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Settings
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item ml-auto">
                                    <a href="/user-detail" class="nav-link">Profile</a>
                                </li>
                                <li class="nav-item ml-auto">
                                    <a href="/logout" class="nav-link">Logout</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Login</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>