<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FASHION.ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/landingpage.css') }}">
</head>

<body>
    <div class="common-style">
        <section id="navigasi-web" class="navigasi-web">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="#">FASHION<span
                            style="color: rgba(102, 200, 255, 0.80);">.ID</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggler"
                        aria-controls="toggler" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="toggler">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#navigasi-web">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#service-web">SERVICE</a>
                            </li>
                        </ul>
                        <div class="button-container">
                            <a href="login" class="btn btn-outline-light custom-button">LOGIN</a>
                            <a href="register" class="btn btn-primary custom-button">REGISTER</a>
                        </div>
                    </div>
                </div>
            </nav>
        </section>

        <section id="home-web" class="home-web">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="typography-tittle">
                            Unleash Your Style, Rent Your Fashion.
                        </h2>
                        <p class="typography-text">Welcome to our Fashion Rental platform, where style knows no
                            boundaries. Discover a world of endless possibilities as you explore.
                        </p>
                        <div class="button-container-icon">
                            <button class="btn btn-primary custom-button-home" type="submit">Get Started</button>
                        </div>
                    </div>
                    <div class="col">
                        <img src="images/home.jpg" class="img-fluid custom-image-home" alt="home">
                    </div>
                </div>
            </div>
        </section>

        <section id="service-web" class="service-web bg-light">
            <div class="container">
                <div>
                    <h2 class="typography-tittle-service">
                        Our Product
                    </h2>
                    <p class="typography-text-service">
                        Welcome to our Fashion Rental platform, where style knows no boundaries
                    </p>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-style">
                                <img src="images/service1.jpg" class="card-img-top custom-card-img" alt="service1">
                                <div class="card-body">
                                    <h5 class="card-title costume-card-tittle">Wedding</h5>
                                    <p class="card-text costume-card-text">Platform penyewaan busana terdepan dengan
                                        koleksi mode eksklusif untuk gaya pribadi Anda.
                                    </p>
                                    <p class="costume-card-footer">Start From $123</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-style">
                                <img src="images/service2.jpg" class="card-img-top custom-card-img" alt="service2">
                                <div class="card-body">
                                    <h5 class="card-title costume-card-tittle">Formal</h5>
                                    <p class="card-text costume-card-text">Temukan gaya Anda dengan penyewaan pakaian
                                        desainer dari koleksi terkini, dan berbagi inspirasi dengan
                                        komunitas fashion kami.
                                    </p>
                                    <p class="costume-card-footer">Start From $123</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-style">
                                <img src="images/service3.jpg" class="card-img-top custom-card-img" alt="service3">
                                <div class="card-body">
                                    <h5 class="card-title costume-card-tittle">Traditional</h5>
                                    <p class="card-text costume-card-text">Nikmati pengalaman berbelanja yang
                                        berkelanjutan dengan menyewa pakaian trendi secara berkala dan hemat,
                                        tanpa mengorbankan gaya.
                                    </p>
                                    <p class="costume-card-footer">Start From $123</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section id="footer-web" class="footer-web">
        <footer class="text-center text-lg-start costume-footer bg-dark text-white">
            <div class="container">
                <div class="text-center">
                    <h1 class="custome-big-footer">FASHION ID</h1>
                </div>
            </div>
        </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>