const express = require('express');
const path = require('path');
const mysql = require('mysql2');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

// Configuración de la Base de Datos (variables de entorno en Render)
const db = mysql.createConnection({
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'encuesta',
  port: process.env.DB_PORT || 3306
});

db.connect((err) => {
  if (err) {
    console.error('Error al conectar a la base de datos:', err);
  } else {
    console.log('Conectado a la base de datos MySQL (encuesta)');
  }
});

// Ruta para guardar la encuesta
app.post('/api/encuesta', (req, res) => {
  const { carrera, p2_instalaciones, p3_profesores, p4_laboratorios, p5_comentarios } = req.body;

  const sql = `INSERT INTO respuestas (carrera, p2_instalaciones, p3_profesores, p4_laboratorios, p5_comentarios) 
               VALUES (?, ?, ?, ?, ?)`;

  db.query(sql, [carrera, p2_instalaciones, p3_profesores, p4_laboratorios, p5_comentarios], (err, result) => {
    if (err) {
      console.error('Error al insertar datos:', err);
      return res.status(500).send('Error en el servidor al guardar la encuesta.');
    }
    // Redirige a la página de regalo tras guardar las respuestas
    res.redirect('/regalo.html');
  });
});

app.listen(PORT, () => {
  console.log(`Servidor ejecutándose en el puerto ${PORT}`);
});
