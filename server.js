const express = require('express');
const app = express();
const PORT = process.env.PORT || 3000;

// Middlewares para procesar datos de formularios y servir archivos
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(express.static(__dirname));

// RUTA POST: Procesa la encuesta, muestra el mensaje con emojis y redirige al regalo
app.post('/api/encuesta', (req, res) => {
    const respuestas = req.body;
    console.log("Respuestas recibidas:", respuestas);

    res.send(`
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 80vh; font-family: sans-serif; text-align: center; padding: 20px;">
            <h1 style="color: #4f46e5; font-size: 2.2rem; margin-bottom: 15px;">¡Muchas gracias por responder! 🎉🥳</h1>
            <p style="font-size: 1.2rem; color: #334155; margin-bottom: 10px;">Tus respuestas han sido registradas con éxito.</p>
            <p style="font-size: 1rem; color: #64748b;">Serás redirigido a tu regalo en unos segundos... 🎁</p>
            <script>
                setTimeout(() => {
                    window.location.href = '/regalo.html';
                }, 2500);
            </script>
        </div>
    `);
});

// Iniciar servidor
app.listen(PORT, () => {
    console.log(`Servidor corriendo en el puerto ${PORT}`);
});
