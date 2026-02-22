<?php
// scriptshop.php
session_start();
require_once 'db.php';
require_once 'Rcon.php';

if (isset($_POST['set_nick'])) {
    $nick = htmlspecialchars(trim($_POST['minecraft_nick']));
    if (!empty($nick)) {
        $_SESSION['user_nick'] = $nick;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['user_nick']);
    header("Location: shop.php");
    exit();
}

$message = "";

if (isset($_POST['use_voucher'])) {
    $nick = $_SESSION['user_nick'];
    $code = htmlspecialchars(trim($_POST['voucher_code']));
    $productId = (int)$_POST['product_id'];

    $rawCustomData = isset($_POST['custom_data']) ? $_POST['custom_data'] : '';
    $customData = preg_replace('/[^a-zA-Z0-9& ]/', '', $rawCustomData);

    $sql = "SELECT v.id, p.name 
            FROM vouchers v 
            JOIN products p ON v.product_id = p.id 
            WHERE v.code = ? AND v.product_id = ? AND v.is_used = 0";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $code, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $voucherId = $row['id'];
        $rewardName = $row['name'];

        $updateSql = "UPDATE vouchers SET is_used = 1, used_by = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $nick, $voucherId);
        
        if ($updateStmt->execute()) {
            try {
                $rcon = new Rcon($rconHost, $rconPort, $rconPass);
                
                if ($productId == 1) {
                    $command = "nick $nick $customData$nick";
                    $rcon->sendCommand($command);
                    $rcon->sendCommand("lp user $nick meta setsuffix \"$customData\"");
                    $rcon->sendCommand("msg $nick &aSklep: Twój kolor nicku został zmieniony!");
                }
                elseif ($productId == 2) {
                    if (strlen($customData) <= 2) {
                            $command = "lp user $nick meta removeprefix 1";
                            $rcon->sendCommand($command);
                            $rcon->sendCommand("msg $nick &aSklep: Twój prefix został usunięty (brak tekstu).");
                        } else {
                            $formattedPrefix = "&8[" . $customData . "&8] &r";
                            $command = "lp user $nick meta setprefix \"$formattedPrefix\"";
                            $rcon->sendCommand($command);
                            $rcon->sendCommand("msg $nick &aSklep: Ustawiono prefix: $formattedPrefix");
                        }
                }
                elseif ($productId == 3) {
                    $rcon->sendCommand("pardon $nick");
                    $rcon->sendCommand("unban $nick");
                }

                $rcon->disconnect();
                
                $message = '
                <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body fs-6">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Aktywowano: <strong>' . $rewardName . '</strong>!
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>';
                
            } catch (Exception $e) {
                $message = '
                <div class="toast align-items-center text-bg-warning border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Kod przyjęty, ale wystąpił błąd połączenia z RCON.
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>';
            }
        }
    } else {
        $message = '
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fs-6">
                    <i class="bi bi-x-circle-fill me-2"></i>
                    Kod nieprawidłowy lub nie pasuje do produktu.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    }
}
?>