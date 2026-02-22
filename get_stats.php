<?php
require_once 'db.php';
$sql = "SELECT * FROM player_stats ORDER BY kills DESC LIMIT 10";
$result = mysqli_query($conn, $sql);
$place = 1;
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $kd = ($row['deaths'] > 0) ? round($row['kills'] / $row['deaths'], 2) : $row['kills'];
        $wins = isset($row['wins']) ? $row['wins'] : 0; 
        $placeColor = "text-white";
        if($place == 1) $placeColor = "text-warning";
        if($place == 2) $placeColor = "text-secondary";
        if($place == 3) $placeColor = "text-danger";
        ?>
        <tr>
            <td class="fw-bold h4 <?php echo $placeColor; ?>"><?php echo $place; ?></td>
            <td class="text-start fw-bold">
                <img src="https://minotar.net/helm/<?php echo $row['nick']; ?>/32.png" class="player-head"> 
                <?php echo $row['nick']; ?>
            </td>
            <td class="text-success fw-bold"><?php echo $row['kills']; ?></td>
            <td class="text-danger"><?php echo $row['deaths']; ?></td>
            <td class="fw-bold"><?php echo $kd; ?></td>
            <td class="fw-bold text-info"><?php echo $wins; ?></td>
        </tr>
        <?php
        $place++;
    }
} else {
    echo '<tr><td colspan="6" class="text-center text-muted py-4">Brak danych w rankingu.</td></tr>';
}
?>