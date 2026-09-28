const express = require('express');
const app = express();
const PORT = process.env.PORT || 3000;

// Configuración para leer los datos del formulario y servir archivos estáticos
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(express.static(__dirname));

// Ruta POST para recibir la encuesta y redirigir
app.post('/api/encuesta', (req, res) => {
    try {
        console.log("Respuestas recibidas correctamente:", req.body);
    } catch (error) {
        console.error("Error al leer respuestas:", error);
    }

    // Redirección directa e inmediata a la página de regalo
    res.redirect('/regalo.html');
});

// Iniciar servidor
app.listen(PORT, () => {
    console.log(`Servidor iniciado en puerto ${PORT}`);
});
