<!DOCTYPE html>
<html>

<head>
    <title>Reloj Digital</title>
    <!-- estilos del reloj -->
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #c3c3c3;
        }

        .reloj {
            font-size: 60px;
            font-weight: bold;
            color: #333;
            background-color: #f0f0f0;
            padding: 20px;
            border: 2px solid #333;
            border-radius: 10px;
            display: inline-block;
        }

        .resultado {
            font-size: 20px;
            margin-top: 10px;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-size: 18px;
            margin-right: 10px;
        }

        input[type="number"] {
            width: 100px;
            padding: 5px;
            font-size: 16px;
        }

        button {
            padding: 5px 10px;
            font-size: 16px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Reloj Digital</h1>

    <div class="reloj">
        <!-- Funcionalidad del reloj digital -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $segundos = intval($_POST["segundos"]);
            $horas = floor($segundos / 3600);
            $segundos %= 3600;
            $minutos = floor($segundos / 60);
            $segundos %= 60;
            echo "$horas:$minutos:$segundos";
        }
        ?>
    </div>

    <?php
    //Calculo de los segmentos
    function calcularSegmentosEncendidos($segundos)
    {
        $segmentosPorNumero = array(
            0 => 6,
            1 => 2,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 3,
            8 => 7,
            9 => 6
        );

        $totalSegmentos = 0;

        $horas = floor($segundos / 3600);
        $minutos = floor(($segundos % 3600) / 60);
        $segundosRestantes = $segundos % 60;

        $totalSegmentos += $segmentosPorNumero[intval($horas / 10)];
        $totalSegmentos += $segmentosPorNumero[$horas % 10];
        $totalSegmentos += $segmentosPorNumero[intval($minutos / 10)];
        $totalSegmentos += $segmentosPorNumero[$minutos % 10];
        $totalSegmentos += $segmentosPorNumero[intval($segundosRestantes / 10)];
        $totalSegmentos += $segmentosPorNumero[$segundosRestantes % 10];

        return $totalSegmentos;
    }
    $totalSegmentos = 0;
    for ($i = 0; $i <= $segundos; $i++) {
        $totalSegmentos += calcularSegmentosEncendidos($i);
    }

    echo "<div class='resultado'>Se han encendido $totalSegmentos segmentos de LED de 7 segmentos.</div>";
    ?>

    <form method="post">
        <label for="segundos">Ingrese la cantidad de segundos:</label>
        <input type="number" name="segundos" id="segundos" required>
        <button type="submit">Mostrar</button>
    </form>

</body>

</html>
