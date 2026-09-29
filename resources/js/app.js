document.addEventListener('DOMContentLoaded', () => {

    const buscador = document.getElementById('buscarLibro');

    if (!buscador) {
        return;
    }

    buscador.addEventListener('input', function () {

        const texto = this.value.toLowerCase().trim();

        document.querySelectorAll('.libro-item').forEach(libro => {

            const contenido = libro.dataset.busqueda;

            if (contenido.includes(texto)) {
                libro.style.display = '';
            } else {
                libro.style.display = 'none';
            }

        });

    });

});
