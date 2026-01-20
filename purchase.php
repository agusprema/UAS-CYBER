<?php
include "config.php";
session_write_close();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$message = '';
$exploitLog = '';

// Proses pembelian
if (isset($_POST['buy'])) {
    $userId = $_SESSION['user']['id'];
    
    // ❌ Race Condition - CHECK balance terlebih dahulu
    $result = mysqli_query($conn, "SELECT balance FROM users WHERE id='$userId'");
    $user = mysqli_fetch_assoc($result);
    
    $balanceBeforeCheck = $user['balance'];
    
    if ($user['balance'] >= 50000) {
        // Delay untuk memperjelas race condition (DIPERBESAR!)
        usleep(1000000); // 0.5 detik - window lebih besar untuk race condition
        
        // ❌ Race Condition - UPDATE tanpa lock
        // Gap antara CHECK dan UPDATE memungkinkan multiple request
        mysqli_query($conn, "UPDATE users SET balance = balance - 50000 WHERE id='$userId'");
        
        // Log untuk melihat race condition
        $logFile = 'purchase_log.txt';
        $logEntry = date('Y-m-d H:i:s.u') . " - Balance saat check: Rp " . number_format($balanceBeforeCheck) . " → Update berhasil\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND);
        
        $message = 'success';
    } else {
        $message = 'insufficient';
    }
}

// Ambil balance terkini untuk ditampilkan
$userId = $_SESSION['user']['id'];
$result = mysqli_query($conn, "SELECT balance FROM users WHERE id='$userId'");
$currentUser = mysqli_fetch_assoc($result);
$currentBalance = $currentUser['balance'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Purchase Item</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 2rem 1rem;
    }

    .purchase-container {
        max-width: 520px;
        width: 100%;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .purchase-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        text-align: center;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        float: left;
    }

    .back-link:hover {
        gap: 0.75rem;
        color: #764ba2;
    }

    .item-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 3rem;
        color: white;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }

    .item-title {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
    }

    .item-description {
        color: #6c757d;
        font-size: 1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .price-box {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 2px solid #dee2e6;
    }

    .price-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .price-amount {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .balance-info {
        background: #e7f3ff;
        border-left: 4px solid #007bff;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        text-align: left;
    }

    .balance-label {
        color: #004085;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .balance-value {
        color: #004085;
        font-size: 1.3rem;
        font-weight: 700;
    }

    .btn-purchase {
        width: 100%;
        padding: 1.25rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .btn-purchase:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
    }

    .btn-purchase:active {
        transform: translateY(0);
    }

    .btn-purchase i {
        font-size: 1.2rem;
    }

    .alert-custom {
        padding: 1.25rem;
        border-radius: 12px;
        border: none;
        margin-bottom: 1.5rem;
        animation: slideDown 0.5s ease-out;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-align: left;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success-custom {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-danger-custom {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    .alert-success-custom i,
    .alert-danger-custom i {
        font-size: 1.5rem;
    }

    .hint-box {
        background: linear-gradient(135deg, #fff3cd 0%, #ffe8a1 100%);
        border-left: 4px solid #ffc107;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-top: 1.5rem;
        display: flex;
        align-items: start;
        gap: 0.75rem;
    }

    .hint-box i {
        color: #856404;
        font-size: 1.2rem;
        margin-top: 0.2rem;
    }

    .hint-text {
        color: #856404;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
        text-align: left;
    }

    .badge-premium {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #856404;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
    }

    @media (max-width: 576px) {
        .purchase-card {
            padding: 2rem 1.5rem;
        }

        .item-title {
            font-size: 1.6rem;
        }

        .price-amount {
            font-size: 2rem;
        }
    }
</style>
</head>
<body>

<div class="purchase-container">
    <div class="purchase-card">
        
        <a href="dashboard.php" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
        
        <div style="clear: both;"></div>

        <?php if ($message == 'success'): ?>
        <div class="alert-custom alert-success-custom">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Pembelian Berhasil!</strong><br>
                Item premium telah ditambahkan ke akun Anda.
            </div>
        </div>
        <?php elseif ($message == 'insufficient'): ?>
        <div class="alert-custom alert-danger-custom">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                <strong>Saldo Tidak Cukup!</strong><br>
                Anda memerlukan minimal Rp 50.000
            </div>
        </div>
        <?php endif; ?>

        <div class="item-icon">
            <i class="fas fa-crown"></i>
        </div>

        <span class="badge-premium">
            <i class="fas fa-star"></i> PREMIUM ITEM
        </span>

        <h1 class="item-title">Premium Package</h1>
        
        <p class="item-description">
            Dapatkan akses eksklusif ke fitur premium dan tingkatkan pengalaman Anda!
        </p>

        <div class="balance-info">
            <div class="balance-label">Saldo Anda Saat Ini:</div>
            <div class="balance-value">Rp <?= number_format($currentBalance, 0, ',', '.'); ?></div>
        </div>

        <div class="price-box">
            <div class="price-label">Harga Item</div>
            <div class="price-amount">Rp 50.000</div>
        </div>

        <form method="POST">
            <button type="submit" name="buy" value="1" class="btn-purchase">
                <i class="fas fa-shopping-cart"></i>
                Beli Sekarang
            </button>
        </form>

        <div class="hint-box">
            <i class="fas fa-flask"></i>
            <p class="hint-text">
                <strong>Hint untuk Testing:</strong><br>
                Coba kirim multiple request secara bersamaan untuk mengeksploitasi Race Condition vulnerability.
            </p>
        </div>

        <?php
        // Tampilkan exploit log jika ada
        if (file_exists('purchase_log.txt')) {
            $logs = file_get_contents('purchase_log.txt');
            $logLines = explode("\n", trim($logs));
            $recentLogs = array_slice(array_reverse($logLines), 0, 5);
            
            if (!empty($recentLogs[0])) {
                echo '<div style="background: #212529; color: #0f0; padding: 1rem; border-radius: 12px; margin-top: 1.5rem; font-family: monospace; font-size: 0.8rem; text-align: left;">
                        <strong style="color: #ffc107;">📊 Recent Purchase Log (5 terakhir):</strong><br><br>';
                foreach ($recentLogs as $log) {
                    if (!empty($log)) {
                        echo htmlspecialchars($log) . '<br>';
                    }
                }
                echo '</div>';
            }
        }
        ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>