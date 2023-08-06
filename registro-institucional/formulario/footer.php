<div class="insert-post-ads1" style="margin-top:20px;">

</div>
</div>
</body>
<script>
    function mostrarEstados() {
        var paisSeleccionado = document.getElementById("pais").value;
        var estadosDiv = document.getElementById("estadosDiv");
        var estadosSelect = document.getElementById("estado");
        estadosSelect.innerHTML = ""; // Limpiar opciones previas

        if (paisSeleccionado === "México") {
            estadosDiv.style.display = "block";
            var estadosMexico = ["Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Ciudad de Mexico",
                "Coahuila", "Colima", "Chiapas", "Chihuahua", "Durango", "Guanajuato", "Guerrero",
                "Hidalgo", "Jalisco", "México", "Michoacán", "Morelos", "Nayarit", "Nuevo León", "Oaxaca",
                "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí", "Sinaloa", "Sonora", "Tabasco",
                "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
            ];
            llenarEstadosSelect(estadosMexico);
        } else if (paisSeleccionado === "Perú") {
            estadosDiv.style.display = "block";
            var estadosPeru = ["Amazonas", "Áncash", "Apurímac", "Arequipa", "Ayacucho", "Cajamarca", "Callao", "Cusco",
                "Huancavelica", "Huánuco", "Ica", "Junín", "La Libertad", "Lambayeque", "Lima", "Loreto",
                "Madre de Dios", "Moquegua", "Pasco", "Piura", "Puno", "San Martín", "Tacna", "Tumbes", "Ucayali"
            ];
            llenarEstadosSelect(estadosPeru);
        } else {
            estadosDiv.style.display = "none"; // Ocultar el select de estados si no hay país seleccionado
        }
    }

    function llenarEstadosSelect(estadosArray) {
        var estadosSelect = document.getElementById("estado");
        estadosSelect.innerHTML = ""; // Limpiar opciones previas

        estadosArray.forEach(function(estado) {
            var option = document.createElement("option");
            option.text = estado;
            estadosSelect.add(option);
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</html>