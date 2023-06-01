const express = require('express');
const db = require('../database/connection'); // Mengimpor konfigurasi database

const router = express.Router();

// Implementasi rute untuk service "user"
router.get('/', (req, res) => {
  const sql = 'SELECT * FROM user';
  db.query(sql, (err, result) => {
    if (err) {
      res.status(500).send({ error: 'Terjadi kesalahan server' });
    } else {
      res.send(result);
    }
  });
});

router.post('/', (req, res) => {
    const { username, fullname, password } = req.body;
    const sql = 'INSERT INTO user (username, fullname, password) VALUES (?, ?, ?)';
    db.query(sql, [username, fullname, password], (err, result) => {
      if (err) {
        res.status(500).send({ error: 'Terjadi kesalahan server' });
      } else {
        res.send({ message: 'Berhasil menambah user' });
      }
    });
});

router.put('/:id', (req, res) => {
    const id = req.params.id;
    const { username, fullname, password } = req.body;
    const sql = 'UPDATE user SET username = ?, fullname = ?, password = ? WHERE id = ?';
    db.query(sql, [username, fullname, password, id], (err, result) => {
      if (err) {
        res.status(500).send({ error: 'Terjadi kesalahan server' });
      } else {
        res.send({ message: 'Data user berhasil diupdate' });
      }
    });
});
  
router.delete('/:id', (req, res) => {
    const id = req.params.id;
    const sql = 'DELETE FROM user WHERE id = ?';
    db.query(sql, [id], (err, result) => {
      if (err) {
        res.status(500).send({ error: 'Terjadi kesalahan server' });
      } else {
        res.send({ message: 'Data user berhasil dihapus' });
      }
    });
});
  

// ... tambahkan rute-rute lainnya untuk service "user"

module.exports = router;
