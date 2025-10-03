<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactes Explode</title>
</head>
<body>
    <h1>PROCESSA CONTACTES</h1>

    <?php
    $inputFile = 'contactes31.txt';
    $outputFile = 'contactes31b.txt';

    if (!file_exists($inputFile)) {
        echo "<p style='color:red;'>Error: no se encuentra el archivo $inputFile.</p>";
        exit;
    }

    $lines = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    echo "<table>";
    echo "<thead><tr><th>Nom</th><th>Cognom1</th><th>Cognom2</th><th>Telèfon</th></tr></thead>";
    echo "<tbody>";

    $outLines = [];
    foreach ($lines as $line) {
        $parts = array_map('trim', explode(',', $line));
        while (count($parts) < 4) $parts[] = '';
        list($nom, $c1, $c2, $tel) = $parts;

        echo "<tr>";
        echo "<td>".htmlspecialchars($nom)."</td>";
        echo "<td>".htmlspecialchars($c1)."</td>";
        echo "<td>".htmlspecialchars($c2)."</td>";
        echo "<td>".htmlspecialchars($tel)."</td>";
        echo "</tr>";

        $outLines[] = implode('#', $parts);
    }

    echo "</tbody></table>";

    if (file_put_contents($outputFile, implode(PHP_EOL, $outLines)) !== false) {
        echo "<p>Se ha creado el archivo <strong>$outputFile</strong> con ".count($outLines)." contactos.</p>";
    } else {
        echo "<p style='color:red;'>No se pudo crear el archivo $outputFile.</p>";
    }
    ?>
</body>
</html>
