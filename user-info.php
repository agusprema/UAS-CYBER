<?php
include "config.php";

// DEBUG MODE - Seharusnya dimatikan di production!
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$currentUser = $_SESSION['user'];
$userId = $currentUser['id'];

// Cek apakah ada parameter id di URL
// ❌ Information Disclosure (IDOR) - Tidak ada validasi kepemilikan!
if (isset($_GET['id'])) {
    $userId = $_GET['id']; // Langsung pakai tanpa validasi
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Information</title>
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

    .info-container {
        max-width: 800px;
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

    .info-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
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
    }

    .back-link:hover {
        gap: 0.75rem;
        color: #764ba2;
    }

    .info-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .info-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .info-title {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .info-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .debug-badge {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #fff;
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        margin-left: 0.5rem;
        box-shadow: 0 3px 10px rgba(255, 193, 7, 0.3);
    }

    .data-section {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .data-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .data-label i {
        color: #667eea;
    }

    .data-value {
        font-size: 1.1rem;
        color: #212529;
        font-weight: 600;
        padding: 0.5rem 0;
    }

    .terminal-box {
        background: #1e1e1e;
        border: 2px solid #333;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        color: #0f0;
        max-height: 300px;
        overflow-y: auto;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    .terminal-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #ffc107;
        font-weight: 700;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #333;
    }

    .terminal-content {
        white-space: pre-wrap;
        word-break: break-all;
        line-height: 1.6;
    }

    .terminal-box {
        background: #1e1e1e;
        border: 2px solid #333;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        color: #0f0;
        max-height: 300px;
        overflow-y: auto;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    .terminal-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #ffc107;
        font-weight: 700;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #333;
    }

    .terminal-content {
        white-space: pre-wrap;
        word-break: break-all;
        line-height: 1.6;
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
        font-size: 0.85rem;
        line-height: 1.5;
        margin: 0;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .info-card {
            padding: 2rem 1.5rem;
        }

        .info-title {
            font-size: 1.6rem;
        }
    }
</style>
</head>
<body>

<div class="info-container">
    <div class="info-card">
        
        <a href="dashboard.php" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>

        <div class="info-header">
            <div class="info-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <h1 class="info-title">
                Account Information
                <span class="debug-badge">
                    <i class="fas fa-code"></i>
                    DEBUG
                </span>
            </h1>
            <p class="info-subtitle">Detail informasi akun Anda</p>
        </div>

        <?php
        // ❌ IDOR + SQL Injection - Query tanpa sanitasi
        $query = "SELECT * FROM users WHERE id=$userId";
        $result = mysqli_query($conn, $query);
        
        // Native PHP error akan muncul jika query error (karena error_reporting aktif)
        
        if ($result) {
            $userData = mysqli_fetch_assoc($result);
            
            if ($userData) {
                echo '<div class="grid-2">';
                
                echo '<div class="data-section">';
                echo '<div class="data-label"><i class="fas fa-hashtag"></i> User ID</div>';
                echo '<div class="data-value">' . htmlspecialchars($userData['id']) . '</div>';
                echo '</div>';
                
                echo '<div class="data-section">';
                echo '<div class="data-label"><i class="fas fa-user"></i> Username</div>';
                echo '<div class="data-value">' . htmlspecialchars($userData['username']) . '</div>';
                echo '</div>';
                
                echo '<div class="data-section">';
                echo '<div class="data-label"><i class="fas fa-user-tag"></i> Role</div>';
                echo '<div class="data-value">' . htmlspecialchars($userData['role']) . '</div>';
                echo '</div>';
                
                echo '<div class="data-section">';
                echo '<div class="data-label"><i class="fas fa-wallet"></i> Balance</div>';
                echo '<div class="data-value">Rp ' . number_format($userData['balance'], 0, ',', '.') . '</div>';
                echo '</div>';
                
                echo '</div>';
            } else {
                echo '<div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 12px; border-left: 4px solid #dc3545;">';
                echo '<i class="fas fa-exclamation-circle"></i> User tidak ditemukan untuk ID: ' . htmlspecialchars($userId);
                echo '</div>';
            }
        }
        ?>

        <div class="hint-box">
            <i class="fas fa-bug"></i>
            <div>
                <p class="hint-text">
                    <strong>Vulnerability - IDOR (Insecure Direct Object Reference):</strong><br>
                    Halaman ini tidak memvalidasi apakah user berhak mengakses data yang diminta. Parameter <code>id</code> di URL langsung digunakan tanpa pengecekan kepemilikan!
                    <br><br>
                    <strong>Cara Exploit:</strong><br>
                    • <code>account_info.php?id=1</code> - Lihat data user ID 1<br>
                    • <code>account_info.php?id=2</code> - Lihat data user ID 2<br>
                    • <code>account_info.php?id=999</code> - Trigger error untuk info disclosure<br>
                    • <code>account_info.php?id=1' OR '1'='1</code> - SQL Injection
                    <br><br>
                    Debug mode yang aktif akan menampilkan PHP/MySQL error lengkap dengan query yang expose struktur database.
                </p>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>