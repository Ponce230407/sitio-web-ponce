const express = require('express');
const path = require('path');
const mysql = require('mysql2');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

// Configuración de la Base de Datos Local
const db = mysql.createConnection({
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'encuesta',
  port: process.env.DB_PORT || 3306
});

db.connect((err) => {
  if (err) {
    console.error('Error al conectar a la base de datos local:', err);
  } else {
    console.log('Conectado exitosamente a la base de datos MySQL local');
  }
});

// Ruta para procesar la encuesta
app.post('/api/encuesta', (req, res) => {
  const { p1_profesores, p2_alumnos, p3_instalaciones, p4_examenes, p5_comida } = req.body;

  const sql = `INSERT INTO respuestas (p1_profesores, p2_alumnos, p3_instalaciones, p4_examenes, p5_comida) 
               VALUES (?, ?, ?, ?, ?)`;

  db.query(sql, [p1_profesores, p2_alumnos, p3_instalaciones, p4_examenes, p5_comida], (err, result) => {
    if (err) {
      console.error('Error al guardar respuestas en BD:', err);
      return res.status(500).send('Error en el servidor al guardar la encuesta.');
    }
    // Redirección al regalo tras guardar
    res.redirect('/regalo.html');
  });
});

app.listen(PORT, () => {
  console.log(`Servidor local corriendo en http://localhost:${PORT}`);
});