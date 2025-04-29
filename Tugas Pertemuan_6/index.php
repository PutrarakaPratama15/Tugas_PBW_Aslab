<?php
// Format ke Rupiah
function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Pajak bandara asal
$pajak_asal = [
    "Soekarno Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000
];

// Pajak bandara tujuan
$pajak_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000
];

// Proses form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maskapai = $_POST['maskapai'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];

    // Bersihkan input harga dari format Rp
    $harga_tiket = (int) str_replace(['Rp', '.', ' '], '', $_POST['harga']);

    $pajak_total = $pajak_asal[$asal] + $pajak_tujuan[$tujuan];
    $total_harga = $harga_tiket + $pajak_total;

    $nomor = rand(1000, 9999);
    $tanggal = date("Y-m-d");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Rute Penerbangan</title>
    <script>
        // Format input harga ke Rupiah
        function formatRupiahInput(el) {
            let value = el.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            el.value = 'Rp ' + rupiah;
        }

        // Bersihkan input sebelum submit
        function cleanRupiahBeforeSubmit() {
            let harga = document.getElementById('harga');
            harga.value = harga.value.replace(/[^0-9]/g, '');
        }
    </script>
</head>
<body>
    <h2>Form Pendaftaran Penerbangan</h2>
    <form method="post" onsubmit="cleanRupiahBeforeSubmit()">
        Nama Maskapai: <input type="text" name="maskapai" required><br><br>

        Bandara Asal:
        <select name="asal" required>
            <?php foreach($pajak_asal as $bandara => $pajak): ?>
                <option value="<?= $bandara ?>"><?= $bandara ?></option>
            <?php endforeach; ?>
        </select><br><br>

        Bandara Tujuan:
        <select name="tujuan" required>
            <?php foreach($pajak_tujuan as $bandara => $pajak): ?>
                <option value="<?= $bandara ?>"><?= $bandara ?></option>
            <?php endforeach; ?>
        </select><br><br>

        Harga Tiket:
        <input type="text" name="harga" id="harga" onkeyup="formatRupiahInput(this)" required><br><br>

        <input type="submit" value="Proses">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h3>Output Data:</h3>
        <table border="1" cellpadding="5">
            <tr><th>Nomor</th><td><?= $nomor ?></td></tr>
            <tr><th>Tanggal</th><td><?= $tanggal ?></td></tr>
            <tr><th>Nama Maskapai</th><td><?= $maskapai ?></td></tr>
            <tr><th>Asal Penerbangan</th><td><?= $asal ?></td></tr>
            <tr><th>Tujuan Penerbangan</th><td><?= $tujuan ?></td></tr>
            <tr><th>Harga Tiket</th><td><?= formatRupiah($harga_tiket) ?></td></tr>
            <tr><th>Pajak</th><td><?= formatRupiah($pajak_total) ?></td></tr>
            <tr><th>Total Harga Tiket</th><td><?= formatRupiah($total_harga) ?></td></tr>
        </table>
    <?php endif; ?>
</body>
</html>
