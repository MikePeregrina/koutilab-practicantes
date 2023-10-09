<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gráfica de Alumnos, Docentes, Visitas y Cursos</title>
    <!-- Incluye la biblioteca Chart.js desde una CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="width: 80%; margin: 0 auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // Obtén los datos del servidor utilizando AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'getData.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                renderizarGrafica(data);
            }
        };
        xhr.send();

        function renderizarGrafica(data) {
            // Obtén los labels de los meses en función de los datos
            const meses = obtenerMesesUnicos(data);

            // Configura los datos de la gráfica
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: meses, // Utiliza los meses obtenidos dinámicamente
                    datasets: [{
                            label: 'Alumnos',
                            data: obtenerDatosPorLabel(data, 'Alumnos'),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: false,
                        },
                        {
                            label: 'Docentes',
                            data: obtenerDatosPorLabel(data, 'Docentes'),
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            fill: false,
                        },
                        {
                            label: 'Visitas',
                            data: obtenerDatosPorLabel(data, 'Visitas'),
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 2,
                            fill: false,
                        },
                        {
                            label: 'Cursos',
                            data: obtenerDatosPorLabel(data, 'Cursos'),
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            fill: false,
                        },
                    ],
                },
                options: {
                    scales: {
                        x: {
                            type: 'category',
                            labels: meses, // Utiliza los meses obtenidos dinámicamente
                        },
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        }

        // Función para obtener meses únicos de los datos
        function obtenerMesesUnicos(data) {
            const meses = [];
            data.forEach(item => {
                if (!meses.includes(item.mes)) {
                    meses.push(item.mes);
                }
            });
            return meses;
        }

        // Función para obtener datos por label
        function obtenerDatosPorLabel(data, label) {
            return data.filter(item => item.label === label).map(item => item.cantidad);
        }
    </script>
</body>

</html>