<?php
// dashboard.php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth.php';

startSecureSession();
requireLogin();

$user = getCurrentUser();
$db   = getDB();

// Stats
$stmt = $db->prepare('SELECT COUNT(*) as cnt, COALESCE(SUM(file_size), 0) as total_size FROM files WHERE owner_id = ? AND is_deleted = 0');
$stmt->execute([$user['id']]);
$stats = $stmt->fetch();

$stmt = $db->prepare('SELECT COUNT(*) as cnt FROM file_shares WHERE owner_id = ? AND is_revoked = 0');
$stmt->execute([$user['id']]);
$sharedOut = $stmt->fetch();

$stmt = $db->prepare('SELECT COUNT(*) as cnt FROM file_shares WHERE recipient_id = ? AND is_revoked = 0');
$stmt->execute([$user['id']]);
$sharedIn = $stmt->fetch();

function fmtSize($b) {
    if ($b < 1024) return $b . ' B';
    if ($b < 1048576) return round($b/1024,1) . ' KB';
    return round($b/1048576,2) . ' MB';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard — SecureVault</title>
  <link rel="stylesheet" href="/securevault/assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="sv-navbar">
  <a href="/securevault/dashboard.php" class="sv-brand">
    <div class="lock-icon">🔐</div>
    SecureVault
  </a>
  <div class="sv-nav-links">
    <a href="/securevault/dashboard.php" class="active"><i class="bi bi-grid"></i> Dashboard</a>
    <a href="/securevault/files.php"><i class="bi bi-folder"></i> File Saya</a>
    <a href="/securevault/upload.php"><i class="bi bi-cloud-upload"></i> Upload</a>
    <a href="/securevault/activity.php"><i class="bi bi-clock-history"></i> Riwayat</a>
    <a href="/securevault/info.php"><i class="bi bi-shield-check"></i> Kriptografi</a>
  </div>
  <div class="sv-nav-right">
    <div class="user-badge">
      <div class="avatar"><?= strtoupper(substr($user['username'], 0, 1)) ?></div>
      <span><?= htmlspecialchars($user['username']) ?></span>
    </div>
    <a href="/securevault/logout.php" class="btn-sv btn-ghost" style="padding:0.35rem 0.75rem;font-size:0.8rem">
      <i class="bi bi-box-arrow-right"></i> Keluar
    </a>
  </div>
</nav>

<main class="sv-main">
  <div class="page-header fade-in-up">
    <h1>Selamat datang, <?= htmlspecialchars($user['username']) ?> 👋</h1>
    <p>Semua file Anda terenkripsi end-to-end. Server hanya menyimpan ciphertext.</p>
  </div>

  <!-- STAT CARDS -->
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-bottom:2rem">
    <div class="stat-card fade-in-up">
      <div class="stat-icon" style="background:rgba(0,212,170,0.1);color:var(--accent)">
        <i class="bi bi-file-earmark-lock2"></i>
      </div>
      <div>
        <div class="stat-value"><?= $stats['cnt'] ?></div>
        <div class="stat-label">File Terenkripsi</div>
      </div>
    </div>
    <div class="stat-card fade-in-up" style="animation-delay:0.05s">
      <div class="stat-icon" style="background:rgba(76,201,240,0.1);color:var(--info)">
        <i class="bi bi-hdd"></i>
      </div>
      <div>
        <div class="stat-value"><?= fmtSize($stats['total_size']) ?></div>
        <div class="stat-label">Total Ukuran</div>
      </div>
    </div>
    <div class="stat-card fade-in-up" style="animation-delay:0.1s">
      <div class="stat-icon" style="background:rgba(255,209,102,0.1);color:var(--warning)">
        <i class="bi bi-share"></i>
      </div>
      <div>
        <div class="stat-value"><?= $sharedOut['cnt'] ?></div>
        <div class="stat-label">Dibagikan ke Orang Lain</div>
      </div>
    </div>
    <div class="stat-card fade-in-up" style="animation-delay:0.15s">
      <div class="stat-icon" style="background:rgba(167,139,250,0.1);color:#a78bfa">
        <i class="bi bi-people"></i>
      </div>
      <div>
        <div class="stat-value"><?= $sharedIn['cnt'] ?></div>
        <div class="stat-label">Dibagikan ke Saya</div>
      </div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
    <!-- RECENT FILES -->
    <div class="sv-card fade-in-up">
      <div class="sv-card-header">
        <h5><i class="bi bi-clock"></i> File Terbaru</h5>
        <a href="/securevault/files.php" style="font-size:0.8rem;color:var(--accent);text-decoration:none">Lihat semua →</a>
      </div>
      <div id="recent-files">
        <div style="text-align:center;padding:2rem;color:var(--text-muted)">
          <div class="spinning" style="font-size:1.5rem;margin-bottom:0.5rem">⚙️</div>
          <div>Memuat file...</div>
        </div>
      </div>
    </div>

    <!-- QUICK ACTIONS + KEY INFO -->
    <div style="display:flex;flex-direction:column;gap:1.5rem">
      <div class="sv-card fade-in-up">
        <div class="sv-card-header"><h5><i class="bi bi-lightning"></i> Aksi Cepat</h5></div>
        <div style="display:flex;flex-direction:column;gap:0.5rem">
          <a href="/securevault/upload.php" class="btn-sv btn-primary-sv" style="justify-content:center">
            <i class="bi bi-cloud-upload"></i> Upload File Baru
          </a>
          <a href="/securevault/files.php" class="btn-sv btn-ghost" style="justify-content:center">
            <i class="bi bi-folder2-open"></i> Kelola File
          </a>
          <a href="/securevault/activity.php" class="btn-sv btn-ghost" style="justify-content:center">
            <i class="bi bi-clock-history"></i> Lihat Riwayat
          </a>
          <a href="/securevault/profile.php" class="btn-sv btn-ghost" style="justify-content:center">
            <i class="bi bi-person-gear"></i> Profil & Kunci
          </a>
        </div>
      </div>

      <div class="sv-card fade-in-up">
        <div class="sv-card-header"><h5><i class="bi bi-shield-lock"></i> Status Keamanan</h5></div>
        <div style="display:flex;flex-direction:column;gap:0.5rem;font-size:0.8rem">
          <div style="display:flex;justify-content:space-between;align-items:center">
            <span style="color:var(--text-muted)">Enkripsi File</span>
            <span style="color:var(--accent);font-weight:700">AES-256-GCM</span>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center">
            <span style="color:var(--text-muted)">Key Wrapping</span>
            <span style="color:var(--accent);font-weight:700">RSA-2048-OAEP</span>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center">
            <span style="color:var(--text-muted)">Integritas</span>
            <span style="color:var(--accent);font-weight:700">SHA-256</span>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center">
            <span style="color:var(--text-muted)">Kunci Privat</span>
            <span style="color:var(--accent);font-weight:700">Dienkripsi</span>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center">
            <span style="color:var(--text-muted)">Enkripsi Client-Side</span>
            <span style="color:var(--accent);font-weight:700">✓ Aktif</span>
          </div>
        </div>
        <div style="margin-top:1rem;padding-top:0.75rem;border-top:1px solid var(--border)">
          <div style="font-size:0.7rem;color:var(--text-muted)">Public Key Fingerprint:</div>
          <div id="key-fingerprint" class="key-info-box" style="font-size:0.65rem;max-height:50px;margin-top:0.4rem">
            Memuat...
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="/securevault/assets/js/crypto.js"></script>
<script>
async function loadRecentFiles() {
  try {
    const res  = await fetch('/securevault/api/files.php?action=list');
    const data = await res.json();
    if (!data.success) throw new Error(data.message);

    const all = [...data.data.owned, ...data.data.shared].slice(0, 5);
    const container = document.getElementById('recent-files');

    if (all.length === 0) {
      container.innerHTML = `<div style="text-align:center;padding:2rem;color:var(--text-muted)">
        <div style="font-size:2rem;margin-bottom:0.5rem">📂</div>
        <div>Belum ada file. <a href="/securevault/upload.php" style="color:var(--accent)">Upload sekarang</a></div>
      </div>`;
      return;
    }

    container.innerHTML = all.map(f => {
      const icon = getFileIcon(f.mime_type);
      const isShared = f.access_type === 'shared';
      return `<div class="file-item">
        <div class="file-icon ${icon.cls}">${icon.ico}</div>
        <div class="file-info">
          <div class="file-name">${escHtml(f.filename_original)}</div>
          <div class="file-meta">
            <span>${formatBytes(f.file_size)}</span>
            <span>${formatDate(f.created_at)}</span>
            ${isShared ? `<span style="color:var(--info)">dari ${escHtml(f.owner_name)}</span>` : ''}
          </div>
        </div>
        <div class="file-actions">
          <a href="/securevault/files.php" class="btn-sv btn-ghost" style="padding:0.3rem 0.6rem;font-size:0.75rem">
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>`;
    }).join('');
  } catch (e) {
    document.getElementById('recent-files').innerHTML =
      `<div class="sv-alert sv-alert-error">Gagal memuat: ${e.message}</div>`;
  }
}

async function loadKeyFingerprint() {
  try {
    const res  = await fetch('/securevault/api/auth.php?action=get_key_data');
    const data = await res.json();
    if (data.success) {
      // Show first 60 chars of public key as fingerprint hint
      const fp = data.public_key.replace(/-----[^-]+-----|\n/g, '').substring(0, 60) + '...';
      document.getElementById('key-fingerprint').textContent = fp;
    }
  } catch (e) { /* ignore */ }
}

function escHtml(s) {
  const d = document.createElement('div'); d.textContent = s; return d.innerHTML;
}

loadRecentFiles();
loadKeyFingerprint();
</script>
</body>
</html>