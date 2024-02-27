<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparador de capacidad de estadios</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="./css/styleCompa.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="./js/Comparar.js"></script>
  

</head>
<body>
    <a href="index.html"><img class="logo" src="./fotos/LogoFut.png" title="index"></a>
    <form class="filtro">
        <div class="slider">
        <label for="capacity-range">Rango de capacidad:</label>
        <div id="slider-range"></div>
        <input type="hidden" id="capacity-range" name="capacity-range">
        <div id="selected-range"></div>
        </div>
        <div>
            <?php
            require_once "./modelo/Bd.php";
            $bd = new Bd();
            $sql = "SELECT nombre FROM estadios";
            $result = $bd->consulta($sql);
            $capacityRange = isset($_GET['capacity-range']) ? $_GET['capacity-range'] : '';
            $estadiosFiltrados = array();
            if (!empty($capacityRange)) {
                $capacityValues = explode('-', $capacityRange);
                $minCapacity = intval($capacityValues[0]);
                $maxCapacity = intval($capacityValues[1]);
                while ($row = $result->fetch_assoc()) {
                    $nombreEstadio = $row["nombre"];
                    $sqlCapacity = "SELECT capacidad FROM estadios WHERE nombre = '$nombreEstadio'";
                    $resultCapacity = $bd->consulta($sqlCapacity);
                    $rowCapacity = $resultCapacity->fetch_assoc();
                    $estadioCapacidad = intval($rowCapacity['capacidad']);
                    if ($estadioCapacidad >= $minCapacity && $estadioCapacidad <= $maxCapacity) {
                        $estadiosFiltrados[] = $nombreEstadio;
                    }
                }
            } else {
                while ($row = $result->fetch_assoc()) {
                    $nombreEstadio = $row["nombre"];
                    $estadiosFiltrados[] = $nombreEstadio;
                }
            }
            foreach ($estadiosFiltrados as $estadio) {
                echo '<input type="checkbox" name="estadio[]" value="' . $estadio . '">' . $estadio . '<br>';
            }
            ?>
        </div>
        <button type="submit" id="comparar-btn">Comparar</button>

    </form>
    <div id="resultados"></div>
</body>
</html>