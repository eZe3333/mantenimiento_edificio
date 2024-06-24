// Obtener referencia al formulario y agregar un listener para el evento submit
const form = document.getElementById('maintenanceForm');

form.addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío automático del formulario

    // Validar campos antes de enviar
    const nombre = document.getElementById('nombre').value.trim();
    const email = document.getElementById('email').value.trim();
    const telefono = document.getElementById('telefono').value.trim();
    const mensaje = document.getElementById('mensaje').value.trim();

    if (nombre === '' || email === '' || telefono === '' || mensaje === '') {
        alert('Por favor, complete todos los campos.');
        return;
    }

    // Enviar el formulario (puedes hacer una llamada a una API o enviar por correo electrónico)
    // En este caso, el formulario se enviará a submit.php según el atributo 'action' del formulario
    form.submit(); // Esto envía el formulario al servidor
});
