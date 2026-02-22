<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="icon" type="image/x-icon" href="./resources/img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/script.js"></script>
</head>

<body>
    <header class="position-relative min-vh-100 d-flex align-items-center justify-content-center">

        <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3"
            style="background: linear-gradient(to bottom, rgba(0,0,0,0.9), transparent);">
            <div class="container position-relative">

                <a class="navbar-brand d-lg-none" href="#">
                    <img src="./resources/img/logo.png" height="40">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link fs-5 fw-bold text-uppercase px-4" href="#o-nas">O
                                nas</a></li>
                        <li class="nav-item"><a class="nav-link fs-5 fw-bold text-uppercase px-4"
                                href="./stats.php">Statystyki</a></li>
                    </ul>

                    <a class="d-none d-lg-block position-absolute start-50 translate-middle-x top-0 mt-2"
                        href="./index.html">
                        <img src="./resources/img/logo.png" class="pixel-logo">
                    </a>

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link fs-5 fw-bold text-uppercase px-4"
                                href="#oferta">Sklep</a></li>
                        <li class="nav-item"><a class="nav-link fs-5 fw-bold text-uppercase px-4"
                                href="#kontakt">Kontakt</a></li>
                    </ul>

                </div>
            </div>
        </nav>

        <video autoplay muted loop playsinline class="video-bg" poster="./resources/img/background.jpg">
            <source src="./resources/video/bg-video.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>

        <div class="container position-relative text-center text-white" style="z-index: 2; margin-top: 80px;">
            <h1 class="display-1 fw-bold text-uppercase">RebirthCraft</h1>
            <p class="lead mb-4">Najlepszy Battle Royale w Minecraft!</p>
        </div>

    </header>

    <section id="o-nas" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold">O naszym serwerze</h2>
                    <p class="text-muted">
                        Jesteśmy unikalnym projektem łączącym mechanikę Battle Royale z modem TaCZ. Zostana dodana
                        customowa minimapa z pokazaniem obrębu bezpiecznej strefy. Walcz o przetrwanie i dominuj w
                        tabeli wyników.
                    </p>
                    <ul class="list-unstyled">
                        <li>✅ Unikalne bronie 3D</li>
                        <li>✅ System rankingowy na stronie</li>
                        <li>✅ Customowa minimapa</li>
                        <li>✅ Mozliwosc dodawania dodatków do broni</li>
                        <li>✅ Automatyczne odnawianie skrzynek</li>
                        <li>✅ Autorski system gry</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <img src="./resources/img/logo.png" alt="O nas" class="img-fluid d-block mx-auto"
                        style="max-height: 300px;">
                </div>
            </div>
        </div>
    </section>

    <section id="oferta" class="py-5 bg-dark text-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Statystyki i Oferta</h2>
                <p>Sprawdź, co możesz zyskać grając u nas.</p>
            </div>

            <div class="row text-center">
                <div class="col-md-6 mb-4">
                    <div class="p-4 border border-secondary rounded">
                        <h3>Kolorowy Nick</h3>
                        <p>Zmiana nicku na kolorowy</p>
                        <a href="./shop.php" class="btn btn-outline-light">Kup</a>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="p-4 border border-secondary rounded">
                        <h3>Własny Prefix</h3>
                        <p>Przykład: [WlasnyTag] Nick</p>
                        <a href="./shop.php" class="btn btn-outline-light">Kup</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kontakt" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">Skontaktuj się z nami</h2>
                    <p class="lead">Masz problem z płatnością lub propozycję zmian na serwerze?</p>
                    <a href="./contact.php" class="btn btn-primary btn-lg mt-3">Napisz e-mail</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-3 bg-dark text-white-50 text-center">
        <div class="container">
            <small>&copy; 2026 RebirthCraft. Wszelkie prawa zastrzeżone.</small>
        </div>
    </footer>
</body>