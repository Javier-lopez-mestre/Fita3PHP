<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari separat</title>
</head>
<body>
    <h1>FORMULARI AMB SEPARADOR</h1>

    <form method="POST">
        <label for="comentari">Comentari:</label>
        <textarea name="comentari" id="comentari" rows="4"></textarea>

        <label for="separador">Separador:</label>
        <input type="text" name="separador" id="separador">

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $comentari = $_POST['comentari'] ?? '';
        $separador = $_POST['separador'] ?? '';

        if (trim($comentari) === '' || trim($separador) === '') {
            echo "<p style='color:red;'>Has d'introduir un comentari i un separador.</p>";
        } else {
            // Substituïm els espais pel separador
            $textProcessat = str_replace(' ', $separador, $comentari);

            $fitxer = 'comentaris.txt';
            // Afegim al fitxer (si no existeix es crea automàticament)
            if (file_put_contents($fitxer, $textProcessat . PHP_EOL, FILE_APPEND) !== false) {
                echo "<p style='color:green;'>Comentari desat correctament al fitxer $fitxer.</p>";
            } else {
                echo "<p style='color:red;'>No s'ha pogut escriure al fitxer $fitxer.</p>";
            }
        }
    }
    ?>
</body>
</html>
