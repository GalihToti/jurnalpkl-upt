<?php
// test-dasar.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "🐘 PHP Version: " . phpversion() . "\n";
echo "==================================\n\n";

// Cek 1: Apakah extension PostgreSQL aktif?
echo "1️⃣ CEK EXTENSION:\n";
$extensions = get_loaded_extensions();
$pgsqlLoaded = in_array('pgsql', $extensions);
$pdo_pgsqlLoaded = in_array('pdo_pgsql', $extensions);

echo "   - Extension pgsql: " . ($pgsqlLoaded ? '✅ ADA' : '❌ TIDAK ADA') . "\n";
echo "   - Extension pdo_pgsql: " . ($pdo_pgsqlLoaded ? '✅ ADA' : '❌ TIDAK ADA') . "\n\n";

if (!$pgsqlLoaded || !$pdo_pgsqlLoaded) {
    echo "❌ ERROR: Extension PostgreSQL tidak aktif!\n";
    echo "   Solusi: Aktifkan di php.ini: extension=pgsql dan extension=pdo_pgsql\n";
    exit;
}

// Cek 2: Data koneksi dari .env
echo "2️⃣ DATA KONEKSI:\n";
$host = 'aws-1-ap-southeast-1.pooler.supabase.com';
$port = '6543';
$dbname = 'postgres';
$user = 'postgres.ladaszeoqciwaoecczgy';
$pass = 'jurnalpklupt';

echo "   - Host: $host\n";
echo "   - Port: $port\n";
echo "   - Database: $dbname\n";
echo "   - User: $user\n";
echo "   - Password: [HIDDEN]\n\n";

// Cek 3: Resolve DNS
echo "3️⃣ CEK DNS:\n";
$ip = gethostbyname($host);
if ($ip === $host) {
    echo "   ❌ Gagal resolve DNS - host tidak dikenal!\n";
    echo "   Solusi: Cek nama host, mungkin salah.\n";
} else {
    echo "   ✅ DNS berhasil: $host → $ip\n";
}
echo "\n";

// Cek 4: Test koneksi port (tanpa SSL)
echo "4️⃣ CEK PORTH (tanpa SSL):\n";
$connection = @fsockopen($host, $port, $errno, $errstr, 10);
if (is_resource($connection)) {
    echo "   ✅ Port $port terbuka!\n";
    fclose($connection);
} else {
    echo "   ❌ Port $port tertutup: $errstr\n";
    echo "   Solusi: Cek firewall atau Supabase mungkin blokir IP Anda.\n";
}
echo "\n";

// Cek 5: Test koneksi database dengan berbagai metode
echo "5️⃣ CEK KONEKSI DATABASE:\n";

// Metode 1: Tanpa SSL
try {
    echo "   Metode 1 (tanpa SSL): ";
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ BERHASIL!\n";
} catch (PDOException $e) {
    echo "❌ GAGAL: " . $e->getMessage() . "\n";
    
    // Metode 2: Dengan SSL require
    try {
        echo "   Metode 2 (dengan SSL): ";
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "✅ BERHASIL!\n";
    } catch (PDOException $e2) {
        echo "❌ GAGAL: " . $e2->getMessage() . "\n";
    }
}