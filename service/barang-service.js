const express = require("express");
const db = require("../database/connection"); // Mengimpor konfigurasi database

const router = express.Router();

// Implementasi rute untuk service "barang"
router.get("/", (req, res) => {
  const sql = "SELECT * FROM barang";
  db.query(sql, (err, result) => {
    if (err) {
      res.status(500).send({ error: "Terjadi kesalahan server" });
    } else {
      res.send(result);
    }
  });
});

router.get("/:id", (req, res) => {
  const id = req.params.id;
  const sql = "SELECT * FROM barang WHERE id = ?";
  db.query(sql, [id], (err, result) => {
    if (err) {
      res.status(500).send({ error: "Terjadi kesalahan server" });
    } else {
      res.send(result);
    }
  });
});

router.post("/", (req, res) => {
  const { kode, nama, jumlah, satuan, kategori, status, harga } = req.body;
  const sql =
    "INSERT INTO barang (kode, nama, jumlah, satuan, kategori, status, harga) VALUES (?, ?, ?, ?, ?, ?, ?)";
  db.query(
    sql,
    [kode, nama, jumlah, satuan, kategori, status, harga],
    (err, result) => {
      if (err) {
        res.status(500).send({ error: "Terjadi kesalahan server" });
      } else {
        res.send({ message: "Berhasil menambah barang" });
      }
    }
  );
});

router.put("/:id", (req, res) => {
  const id = req.params.id;
  const { kode, nama, jumlah, satuan, kategori, status, harga } = req.body;
  const sql =
    "UPDATE barang SET kode = ?, nama = ?, jumlah = ?, satuan = ?, kategori = ?, status = ?, harga = ? WHERE id = ?";
  db.query(
    sql,
    [id, kode, nama, jumlah, satuan, kategori, status, harga],
    (err, result) => {
      if (err) {
        res.status(500).send({ error: "Terjadi kesalahan server" });
      } else {
        res.send({ message: "Data barang berhasil diupdate" });
      }
    }
  );
});

router.delete("/:id", (req, res) => {
  const id = req.params.id;
  const sql = "DELETE FROM barang WHERE id = ?";
  db.query(sql, [id], (err, result) => {
    if (err) {
      res.status(500).send({ error: "Terjadi kesalahan server" });
    } else {
      res.send({ message: "Data barang berhasil dihapus" });
    }
  });
});

// ... tambahkan rute-rute lainnya untuk service "barang"

module.exports = router;
