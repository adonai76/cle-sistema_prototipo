document.addEventListener("DOMContentLoaded", () => {
    // Datos globales que vienen de Blade
    const alumnos = window.datosAlumnos || [];
    const alumnos_inscritos = window.datosConsulta || [];

    // ================== GRÁFICO 1 ==================
    let conteoSemestre = {};
    alumnos.forEach(a => {
        conteoSemestre[a.semestre_alumno] = (conteoSemestre[a.semestre_alumno] || 0) + 1;
    });

    new Chart(document.getElementById('alumnos_semestre'), {
        type: 'bar',
        data: {
            labels: Object.keys(conteoSemestre),
            datasets: [{
                label: 'Alumnos por semestre',
                data: Object.values(conteoSemestre),
                backgroundColor: '#1B396A',
                borderColor: 'white',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 }
                }
            }
        }
    });

    // ================== GRÁFICO 2 ==================
    let conteoSexo = {};
    alumnos.forEach(a => {
        conteoSexo[a.sexo_alumno] = (conteoSexo[a.sexo_alumno] || 0) + 1;
    });

    new Chart(document.getElementById('alumnos_sexo'), {
        type: 'bar',
        data: {
            labels: Object.keys(conteoSexo),
            datasets: [{
                label: 'Alumnos por sexo',
                data: Object.values(conteoSexo),
                backgroundColor: ['#FF6384', '#1B396A'],
                borderColor: 'white',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 }
                }
            }
        }
    });

    // ================== GRÁFICO 3 ==================
    let conteoInscritos = {};
    alumnos_inscritos.forEach(a => {
        conteoInscritos[a.sexo_alumno] = (conteoInscritos[a.sexo_alumno] || 0) + 1;
    });

    new Chart(document.getElementById('alumnos_inscritos'), {
        type: 'bar',
        data: {
            labels: Object.keys(conteoInscritos),
            datasets: [{
                label: 'Alumnos inscritos',
                data: Object.values(conteoInscritos),
                backgroundColor: ['#FF6384', '#1B396A'],
                borderColor: 'white',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 }
                }
            }
        }
    });
});
