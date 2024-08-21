// script.js

document.addEventListener('DOMContentLoaded', function() {
    fetch('php/obtener_pacientes.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaPacientes tbody');
            data.forEach(paciente => {
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${paciente.id}</td>
                    <td>${paciente.nombre}</td>
                    <td>${paciente.edad}</td>
                    <td>${paciente.genero}</td>
                    <td>${paciente.departamento}</td>
                    <td>${paciente.municipio}</td>
                `;
                tbody.appendChild(fila);
            });
        })
        .catch(error => console.error('Error:', error));
});

document.getElementById('formularioPaciente').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('php/agregar_paciente.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Agregar el nuevo paciente a la tabla
            const nuevoPaciente = {
                id: data.id, // Aquí se utiliza el ID devuelto por el servidor
                nombre: formData.get('nombre'),
                edad: formData.get('edad'),
                genero: formData.get('genero'),
                departamento: formData.get('departamento'),
                municipio: formData.get('municipio')
            };

            const tbody = document.querySelector('#tablaPacientes tbody');
            const fila = document.createElement('tr');

            fila.innerHTML = `
                <td>${nuevoPaciente.id}</td>
                <td>${nuevoPaciente.nombre}</td>
                <td>${nuevoPaciente.edad}</td>
                <td>${nuevoPaciente.genero}</td>
                <td>${nuevoPaciente.departamento}</td>
                <td>${nuevoPaciente.municipio}</td>
            `;

            tbody.appendChild(fila);
        }
    })
    .catch(error => console.error('Error:', error));
});
