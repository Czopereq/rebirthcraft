<?php 
require_once 'scriptshop.php'; 
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep - RebirthCraft</title>
    <link rel="icon" type="image/x-icon" href="./resources/img/logo.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    
    <style>
        .preview-container {
            background-color: #333;
            background-image: url('./resources/img/background.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>

    <header class="position-relative shop-header d-flex align-items-center justify-content-center">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3" style="background: linear-gradient(to bottom, rgba(0,0,0,0.9), transparent);">
            <div class="container position-relative">
                <a class="navbar-brand d-lg-none" href="index.html"><img src="./resources/img/logo.png" height="40"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navContent">
                    <ul class="navbar-nav me-auto"><li class="nav-item"><a class="nav-link fs-5 fw-bold text-uppercase px-4" href="index.html#o-nas">O nas</a></li><li class="nav-item"><a class="nav-link fs-5 fw-bold text-uppercase px-4" href="stats.php">Statystyki</a></li></ul>
                    <a class="d-none d-lg-block position-absolute start-50 translate-middle-x top-0 mt-2" href="index.html"><img src="./resources/img/logo.png" class="pixel-logo"></a>
                    <ul class="navbar-nav ms-auto"><li class="nav-item"><a class="nav-link fs-5 fw-bold text-uppercase px-4 active text-warning" href="shop.php">Sklep</a></li><li class="nav-item"><a class="nav-link fs-5 fw-bold text-uppercase px-4" href="contact.php">Kontakt</a></li></ul>
                </div>
            </div>
        </nav>
        <video autoplay muted loop playsinline class="video-bg" poster="./resources/img/background.jpg"><source src="./resources/video/bg-video.mp4" type="video/mp4"></video>
        <div class="video-overlay"></div>
        <div class="container position-relative text-center text-white" style="z-index: 2; margin-top: 60px;">
            <h1 class="display-3 fw-bold text-uppercase">Sklep Serwera</h1>
            <?php if (isset($_SESSION['user_nick'])): ?>
                <p class="lead">Kupujesz jako: <span class="text-warning fw-bold text-uppercase mx-2"><img src="https://minotar.net/avatar/<?php echo $_SESSION['user_nick']; ?>/30" class="rounded me-2"><?php echo $_SESSION['user_nick']; ?></span><a href="shop.php?action=logout" class="btn btn-sm btn-outline-light ms-2">Zmień</a></p>
            <?php else: ?>
                <p class="lead">Zaloguj się nickiem, aby przeglądać ofertę</p>
            <?php endif; ?>
        </div>
    </header>

    <?php if (!isset($_SESSION['user_nick'])): ?>
        <section class="py-5 bg-dark position-relative" style="min-height: 50vh;">
            <div class="container h-100 d-flex justify-content-center align-items-center">
                <div class="card bg-black border-warning p-5 text-center shadow-lg" style="max-width: 600px; width: 100%;">
                    <h2 class="text-warning text-uppercase mb-4 fw-bold">Podaj swój nick</h2>
                    <form method="POST" action="shop.php">
                        <div class="mb-4"><input type="text" name="minecraft_nick" class="form-control nick-input" placeholder="Wpisz nick..." required autofocus></div>
                        <button type="submit" name="set_nick" class="btn btn-warning btn-lg w-100 fw-bold text-dark text-uppercase shadow">PRZEJDŹ DO SKLEPU ►</button>
                    </form>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <?php
                    if (isset($conn)) {
                        $sql = "SELECT * FROM products";
                        $result = mysqli_query($conn, $sql);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 text-white text-center p-3">
                                        <img src="./resources/img/<?php echo $row['image']; ?>" class="card-img-top mx-auto" alt="<?php echo $row['name']; ?>">
                                        <div class="card-body d-flex flex-column">
                                            <h3 class="card-title fw-bold text-warning text-uppercase"><?php echo $row['name']; ?></h3>
                                            <p class="card-text text-light opacity-75"><?php echo $row['description']; ?></p>
                                            <div class="mt-auto pt-3">
                                                <h2 class="display-6 fw-bold mb-3"><?php echo $row['price']; ?> PLN</h2>
                                                <button type="button" class="btn btn-warning btn-lg w-100 fw-bold text-dark text-uppercase shadow"
                                                        data-bs-toggle="modal" data-bs-target="#itemModal"
                                                        data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>">
                                                    KUP TERAZ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <div class="modal fade" id="itemModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-black text-white border-warning">
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title text-uppercase fw-bold text-warning" id="modalItemName">...</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <form method="POST" action="shop.php">
                        <div class="modal-body">
                            <input type="hidden" name="product_id" id="modalItemId">
                            <input type="hidden" name="custom_data" id="customDataInput">

                            <div class="preview-container">
                                <div class="preview-overlay"></div>
                                    <div id="nametagPreview" class="nametag-box" style="color: white;">
                                        <?php 
                                        echo isset($_SESSION['user_nick']) ? htmlspecialchars($_SESSION['user_nick']) : 'Gracz'; 
                                        ?>
                                    </div>
                                <img src="https://minotar.net/body/<?php echo isset($_SESSION['user_nick']) ? $_SESSION['user_nick'] : 'Steve'; ?>/100.png" class="minecraft-model">
                            </div>

                            <div id="colorOptions" class="mb-3 d-none">
                                <label class="form-label text-muted small fw-bold">WYBIERZ KOLOR NICKU:</label>
                                <div class="d-flex flex-wrap justify-content-center gap-1">
                                    <div class="color-btn" style="background:#AA0000" data-code="&4"></div>
                                    <div class="color-btn" style="background:#FF5555" data-code="&c"></div>
                                    <div class="color-btn" style="background:#FFAA00" data-code="&6"></div>
                                    <div class="color-btn" style="background:#FFFF55" data-code="&e"></div>
                                    <div class="color-btn" style="background:#00AA00" data-code="&2"></div>
                                    <div class="color-btn" style="background:#55FF55" data-code="&a"></div>
                                    <div class="color-btn" style="background:#55FFFF" data-code="&b"></div>
                                    <div class="color-btn" style="background:#00AAAA" data-code="&3"></div>
                                    <div class="color-btn" style="background:#0000AA" data-code="&1"></div>
                                    <div class="color-btn" style="background:#5555FF" data-code="&9"></div>
                                    <div class="color-btn" style="background:#FF55FF" data-code="&d"></div>
                                    <div class="color-btn" style="background:#AA00AA" data-code="&5"></div>
                                    <div class="color-btn" style="background:#FFFFFF" data-code="&f"></div>
                                    <div class="color-btn" style="background:#AAAAAA" data-code="&7"></div>
                                </div>
                            </div>

                            <div id="prefixOptions" class="mb-3 d-none">
                                <label class="form-label text-muted small fw-bold">1. WYBIERZ KOLOR PREFIXU:</label>
                                <div class="d-flex flex-wrap justify-content-center gap-1 mb-2">
                                    <div class="prefix-color-btn" style="background:#AA0000" data-code="&4"></div>
                                    <div class="prefix-color-btn" style="background:#FF5555" data-code="&c"></div>
                                    <div class="prefix-color-btn" style="background:#FFAA00" data-code="&6"></div>
                                    <div class="prefix-color-btn" style="background:#FFFF55" data-code="&e"></div>
                                    <div class="prefix-color-btn" style="background:#00AA00" data-code="&2"></div>
                                    <div class="prefix-color-btn" style="background:#55FF55" data-code="&a"></div>
                                    <div class="prefix-color-btn" style="background:#55FFFF" data-code="&b"></div>
                                    <div class="prefix-color-btn" style="background:#00AAAA" data-code="&3"></div>
                                    <div class="prefix-color-btn" style="background:#0000AA" data-code="&1"></div>
                                    <div class="prefix-color-btn" style="background:#5555FF" data-code="&9"></div>
                                    <div class="prefix-color-btn" style="background:#FF55FF" data-code="&d"></div>
                                    <div class="prefix-color-btn" style="background:#AA00AA" data-code="&5"></div>
                                    <div class="prefix-color-btn" style="background:#FFFFFF" data-code="&f"></div>
                                    <div class="prefix-color-btn" style="background:#AAAAAA" data-code="&7"></div>
                                </div>
                                <label class="form-label text-muted small fw-bold">2. WPISZ TREŚĆ:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-white border-secondary">[</span>
                                    <input type="text" id="prefixInput" class="form-control bg-dark text-white border-secondary text-center fw-bold" maxlength="10" placeholder="TAG">
                                    <span class="input-group-text bg-dark text-white border-secondary">]</span>
                                </div>
                                <div class="form-text text-white-50 small">Max 10 znaków.</div>
                            </div>

                            <div class="mb-3 border-top border-secondary pt-3">
                                <label class="form-label text-warning fw-bold">KOD VOUCHERA</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary text-center fs-5" name="voucher_code" placeholder="XXXX-XXXX" required>
                            </div>
                        </div>
                        <div class="modal-footer border-secondary justify-content-center">
                            <button type="submit" name="use_voucher" class="btn btn-success w-100 fw-bold text-uppercase py-2">Zrealizuj Kod</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <footer class="py-4 bg-dark text-white-50 text-center border-top border-secondary">
        <div class="container"><small>&copy; 2026 RebirthCraft. Wszelkie prawa zastrzeżone.</small></div>
    </footer>

    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
        <?php if (isset($message) && !empty($message)) echo $message; ?>
    </div>

    <script>
        const serverUserNick = "<?php echo isset($_SESSION['user_nick']) ? htmlspecialchars($_SESSION['user_nick']) : 'Gracz'; ?>";
    </script>

    <script src="./js/shop.js"></script>

</body>
</html>