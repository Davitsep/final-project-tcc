const mysql = require("mysql");

const db = mysql.createConnection({
  host: "10.78.144.4",
  user: "user1",
  password: "123456",
  database: "inventaris",
});

// Membuat koneksi ke database
db.connect((err) => {
  if (err) {
    throw err;
  }
  console.log("Terhubung ke database MySQL");
});

module.exports = db;
