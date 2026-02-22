<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statystyki - RebirthCraft</title>
    <link rel="icon" type="image/x-icon" href="./resources/img/logo.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <header class="position-relative shop-header d-flex align-items-center justify-content-center">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3" style="background: linear-gradient(to bottom, rgba(0,0,0,0.9), transparent);">
            <div class="container position-relative">
                <a class="navbar-brand d-lg-none" href="index.html"><img src="./resources/img/logo.png" height="40"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navContent">
                    <ul class="navbar-nav me-auto"><li class="nav-item"><a class="nav-link fs-5 fw-bold px-4" href="index.html#o-nas">O nas</a></li><li class="nav-item"><a class="nav-link fs-5 fw-bold px-4 active text-warning" href="stats.php">Statystyki</a></li></ul>
                    <a class="d-none d-lg-block position-absolute start-50 translate-middle-x top-0 mt-2" href="index.html"><img src="./resources/img/logo.png" class="pixel-logo"></a>
                    <ul class="navbar-nav ms-auto"><li class="nav-item"><a class="nav-link fs-5 fw-bold px-4" href="shop.php">Sklep</a></li><li class="nav-item"><a class="nav-link fs-5 fw-bold px-4" href="contact.php">Kontakt</a></li></ul>
                </div>
            </div>
        </nav>
        <video autoplay muted loop playsinline class="video-bg" poster="./resources/img/background.jpg"><source src="./resources/video/bg-video.mp4" type="video/mp4"></video>
        <div class="video-overlay"></div>
        <div class="container position-relative text-center text-white" style="z-index: 2; margin-top: 60px;">
            <h1 class="display-3 fw-bold text-uppercase">Top Gracze</h1>
            <p class="lead">Ranking odświeżany na żywo co 30 sekund</p>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            
            <div class="table-responsive shadow-lg rounded">
                <table class="table table-custom mb-0 text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-start">Gracz</th>
                            <th>Zabójstwa</th>
                            <th>Śmierci</th>
                            <th>K/D Ratio</th>
                            <th>Wygrane mecze</th> 
                        </tr>
                    </thead>
                    
                    <tbody id="stats-body">
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="spinner-border text-warning" role="status"></div>
                                <p class="mt-2 text-muted">Ładowanie statystyk...</p>
                            </td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
            
            <p class="text-end text-muted mt-2 small">Ostatnia aktualizacja: <span id="last-update">...</span></p>

        </div>
    </section>

    <footer class="py-4 bg-dark text-white-50 text-center border-top border-secondary">
        <div class="container"><small>&copy; 2026 RebirthCraft. Wszelkie prawa zastrzeżone.</small></div>
    </footer>

    <script src="./js/ajax.js"></script>

</body>
</html>