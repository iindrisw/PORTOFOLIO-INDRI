<?php
// files.php — File List & Management
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth.php';

startSecureSession();
requireLogin();
$user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>File Saya — SecureVault</title>
  <link rel="stylesheet" href="/securevault/assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<nav class="sv-navbar">
  <a href="/securevault/dashboard.php" class="sv-brand"><div class="lock-icon">🔐</div> SecureVault</a>
  <div class="sv-nav-links">
    <a href="/securevault/dashboard.php"><i class="bi bi-grid"></i> Dashboard</a>
    <a href="/securevault/files.php" class="active"><i class="bi bi-folder"></i> File Saya</a>
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
  <div class="page-header fade-in-up" style="display:flex;align-items:center;justify-content:space-between">
    <div>
      <h1><i class="bi bi-folder2-open"></i> File Saya</h1>
      <p>Semua file dienkripsi. Kunci hanya ada di tangan Anda.</p>
    </div>
    <a href="/securevault/upload.php" class="btn-sv btn-primary-sv"><i class="bi bi-plus-lg"></i> Upload File</a>
  </div>

  <div id="alert-container"></div>

  <!-- TABS -->
  <div style="display:flex;gap:0.5rem;margin-bottom:1.5rem;border-bottom:1px solid var(--border);padding-bottom:0">
    <button onclick="showTab('owned')" id="tab-owned" class="tab-btn active">
      <i class="bi bi-lock"></i> Milik Saya
      <span class="sv-badge badge-private" id="cnt-owned">0</span>
    </button>
    <button onclick="showTab('shared')" id="tab-shared" class="tab-btn">
      <i class="bi bi-people"></i> Dibagikan ke Saya
      <span class="sv-badge badge-received" id="cnt-shared">0</span>
    </button>
  </div>

  <div id="tab-owned-content">
    <div id="owned-files">
      <div style="text-align:center;padding:3rem;color:var(--text-muted)">
        <div class="spinning" style="font-size:2rem;margin-bottom:0.5rem">⚙️</div>
        Memuat file...
      </div>
    </div>
  </div>

  <div id="tab-shared-content" style="display:none">
    <div id="shared-files">
      <div style="text-align:center;padding:3rem;color:var(--text-muted)">
        <div class="spinning" style="font-size:2rem;margin-bottom:0.5rem">⚙️</div>
        Memuat file...
      </div>
    </div>
  </div>
</main>

<!-- MODAL: File Detail & Share -->
<div class="sv-modal-overlay" id="modal-detail">
  <div class="sv-modal" style="max-width:560px">
    <div class="sv-modal-title">Detail File</div>
    <div id="modal-detail-content"></div>
    <div style="margin-top:1.25rem;display:flex;gap:0.5rem;justify-content:flex-end">
      <button onclick="hideModal('modal-detail')" class="btn-sv btn-ghost">Tutup</button>
    </div>
  </div>
</div>

<!-- MODAL: Share -->
<div class="sv-modal-overlay" id="modal-share">
  <div class="sv-modal" style="max-width:480px">
    <div class="sv-modal-title"><i class="bi bi-share"></i> Bagikan File</div>
    <div id="alert-share"></div>
    <div class="form-group">
      <label class="sv-label">Pilih Pengguna</label>
      <select id="share-recipient" class="sv-input">
        <option value="">-- Pilih Pengguna --</option>
      </select>
    </div>
    <div class="sv-card" style="background:rgba(0,212,170,0.04);font-size:0.8rem;color:var(--text-muted);margin-bottom:1rem">
      <i class="bi bi-info-circle" style="color:var(--accent)"></i>
      Key wrapping: session key file akan dienkripsi ulang dengan kunci publik penerima.
      Penerima dapat mendekripsi dengan kunci privatnya.
    </div>
    <div style="display:flex;gap:0.5rem;justify-content:flex-end">
      <button onclick="hideModal('modal-share')" class="btn-sv btn-ghost">Batal</button>
      <button onclick="doShare()" id="btn-do-share" class="btn-sv btn-primary-sv">
        <i class="bi bi-send"></i> Bagikan
      </button>
    </div>
  </div>
</div>

<!-- MODAL: Preview -->
<div class="sv-modal-overlay" id="modal-preview">
  <div class="sv-modal" style="max-width:800px;width:95vw">
    <div class="sv-modal-title" id="preview-title">Preview File</div>
    <div id="preview-container" style="max-height:70vh;overflow:auto;border-radius:8px;border:1px solid var(--border)">
    </div>
    <div style="margin-top:1rem;display:flex;gap:0.5rem;justify-content:flex-end">
      <button onclick="hideModal('modal-preview')" class="btn-sv btn-ghost">Tutup</button>
    </div>
  </div>
</div>

<style>
.tab-btn {
  background: none; border: none; color: var(--text-muted);
  padding: 0.5rem 1rem; cursor: pointer; font-family: var(--sans);
  font-weight: 600; font-size: 0.85rem; border-bottom: 2px solid transparent;
  margin-bottom: -1px; display: flex; align-items: center; gap: 0.4rem;
  transition: all 0.2s;
}
.tab-btn.active { color: var(--accent); border-bottom-color: var(--accent); }
.tab-btn:hover { color: var(--text-primary); }
</style>

<script src="/securevault/assets/js/crypto.js"></script>
<script>
let allFiles = { owned: [], shared: [] };
let shareFileId = null;
let userPrivateKey = null;

// ── INIT ─────────────────────────────────────────
async function init() {
  // Unlock private key in memory
  await unlockPrivateKey();
  await loadFiles();
  await loadUsers();
}

async function unlockPrivateKey() {
  try {
    const res  = await fetch('/securevault/api/auth.php?action=get_key_data');
    const data = await res.json();
    if (!data.success) throw new Error('Gagal memuat kunci');

    // Ask password to decrypt private key in browser
    const password = prompt('Masukkan password Anda untuk membuka kunci enkripsi:');
    if (!password) throw new Error('Password diperlukan');

    const privKeyPem = await SV.decryptPrivateKeyWithPassword(
      data.private_key_enc, data.private_key_iv, data.private_key_salt, password
    );
    userPrivateKey = await SV.importPrivateKey(privKeyPem);
    SV.setPrivateKey(userPrivateKey);
  } catch (e) {
    showAlert('Gagal membuka kunci privat: ' + e.message, 'error');
  }
}

async function loadFiles() {
  const res  = await fetch('/securevault/api/files.php?action=list');
  const data = await res.json();
  if (!data.success) { showAlert(data.message, 'error'); return; }

  allFiles = data.data;
  document.getElementById('cnt-owned').textContent  = allFiles.owned.length;
  document.getElementById('cnt-shared').textContent = allFiles.shared.length;

  renderFiles('owned');
  renderFiles('shared');
}

function renderFiles(type) {
  const files = allFiles[type];
  const container = document.getElementById(type + '-files');

  if (files.length === 0) {
    container.innerHTML = `<div style="text-align:center;padding:3rem;color:var(--text-muted)">
      <div style="font-size:2.5rem;margin-bottom:0.75rem">📂</div>
      <div style="font-weight:600">${type === 'owned' ? 'Belum ada file' : 'Tidak ada file yang dibagikan ke Anda'}</div>
      ${type === 'owned' ? '<a href="/securevault/upload.php" class="btn-sv btn-primary-sv" style="display:inline-flex;margin-top:1rem"><i class="bi bi-cloud-upload"></i> Upload Sekarang</a>' : ''}
    </div>`;
    return;
  }

  container.innerHTML = files.map(f => {
    const icon = getFileIcon(f.mime_type);
    const isOwned = type === 'owned';
    let statusBadge = '';
    if (isOwned) {
      if (f.shared_with) {
        statusBadge = `<span class="sv-badge badge-shared"><i class="bi bi-share"></i> Dibagikan ke: ${escHtml(f.shared_with)}</span>`;
      } else {
        statusBadge = `<span class="sv-badge badge-private"><i class="bi bi-lock"></i> Private</span>`;
      }
    } else {
      statusBadge = `<span class="sv-badge badge-received"><i class="bi bi-people"></i> Dari: ${escHtml(f.owner_name)}</span>`;
    }

    return `<div class="file-item fade-in-up" id="file-row-${f.id}">
      <div class="file-icon ${icon.cls}">${icon.ico}</div>
      <div class="file-info">
        <div class="file-name">${escHtml(f.filename_original)}</div>
        <div class="file-meta">
          <span>${formatBytes(f.file_size)}</span>
          <span>${formatDate(f.created_at)}</span>
          ${statusBadge}
        </div>
      </div>
      <div class="file-actions">
        <button onclick="previewFile(${f.id},'${escHtml(f.mime_type)}')" class="btn-sv btn-ghost" style="padding:0.3rem 0.5rem" data-tooltip="Preview">
          <i class="bi bi-eye"></i>
        </button>
        <button onclick="downloadFile(${f.id})" class="btn-sv btn-ghost" style="padding:0.3rem 0.5rem" data-tooltip="Download">
          <i class="bi bi-download"></i>
        </button>
        ${isOwned ? `
        <button onclick="openShareModal(${f.id})" class="btn-sv btn-ghost" style="padding:0.3rem 0.5rem" data-tooltip="Bagikan">
          <i class="bi bi-share"></i>
        </button>
        <button onclick="showFileDetail(${f.id})" class="btn-sv btn-ghost" style="padding:0.3rem 0.5rem" data-tooltip="Detail">
          <i class="bi bi-info-circle"></i>
        </button>
        <button onclick="deleteFile(${f.id})" class="btn-sv btn-danger-sv" style="padding:0.3rem 0.5rem" data-tooltip="Hapus">
          <i class="bi bi-trash"></i>
        </button>` : ''}
      </div>
    </div>`;
  }).join('');
}

function showTab(tab) {
  document.getElementById('tab-owned-content').style.display  = tab === 'owned'  ? '' : 'none';
  document.getElementById('tab-shared-content').style.display = tab === 'shared' ? '' : 'none';
  document.getElementById('tab-owned').classList.toggle('active', tab === 'owned');
  document.getElementById('tab-shared').classList.toggle('active', tab === 'shared');
}

// ── DOWNLOAD ──────────────────────────────────────
async function downloadFile(fileId) {
  if (!userPrivateKey) { showAlert('Kunci privat belum dimuat. Muat ulang halaman.', 'error'); return; }

  showAlert('Mengunduh dan mendekripsi file...', 'info');
  try {
    const res  = await fetch(`/securevault/api/files.php?action=download&file_id=${fileId}`);
    const data = await res.json();
    if (!data.success) throw new Error(data.message);

    // Decrypt
    const encBuf = SV.b64toBuf(data.encrypted_data);
    const decBuf = await SV.decryptFile(encBuf, data.aes_tag, data.session_key_enc, data.session_key_iv, userPrivateKey);

    // Verify integrity
    const decHash = await SV.hashArrayBuffer(decBuf);
    if (decHash !== data.original_hash) {
      showAlert('⚠️ PERINGATAN: Hash tidak cocok! File mungkin dimodifikasi.', 'warning');
      return;
    }

    // Trigger download
    const blob = new Blob([decBuf], { type: data.mime_type || 'application/octet-stream' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href = url; a.download = data.filename;
    a.click();
    URL.revokeObjectURL(url);

    showAlert('✓ File berhasil diunduh dan integritas terverifikasi!', 'success');
  } catch (e) {
    showAlert('Gagal download: ' + e.message, 'error');
  }
}

// ── PREVIEW ───────────────────────────────────────
async function previewFile(fileId, mimeType) {
  if (!userPrivateKey) { showAlert('Kunci privat belum dimuat.', 'error'); return; }

  const previewable = mimeType && (mimeType.startsWith('image/') || mimeType.startsWith('text/'));
  if (!previewable) { showAlert('Preview hanya tersedia untuk file gambar dan teks.', 'info'); return; }

  document.getElementById('preview-container').innerHTML =
    '<div style="padding:2rem;text-align:center;color:var(--text-muted)"><div class="spinning" style="font-size:1.5rem">⚙️</div><div>Mendekripsi untuk preview...</div></div>';
  showModal('modal-preview');

  try {
    const res  = await fetch(`/securevault/api/files.php?action=download&file_id=${fileId}`);
    const data = await res.json();
    if (!data.success) throw new Error(data.message);

    const encBuf = SV.b64toBuf(data.encrypted_data);
    const decBuf = await SV.decryptFile(encBuf, data.aes_tag, data.session_key_enc, data.session_key_iv, userPrivateKey);

    document.getElementById('preview-title').textContent = '👁️ Preview: ' + data.filename;
    const container = document.getElementById('preview-container');

    if (mimeType.startsWith('image/')) {
      const blob = new Blob([decBuf], { type: mimeType });
      const url  = URL.createObjectURL(blob);
      container.innerHTML = `<img src="${url}" style="max-width:100%;display:block;border-radius:8px">`;
    } else if (mimeType.startsWith('text/')) {
      const text = new TextDecoder().decode(decBuf);
      container.innerHTML = `<pre style="padding:1rem;font-family:var(--mono);font-size:0.8rem;white-space:pre-wrap;color:var(--text-primary);margin:0">${escHtml(text)}</pre>`;
    }
  } catch (e) {
    document.getElementById('preview-container').innerHTML =
      `<div class="sv-alert sv-alert-error" style="margin:1rem">Preview gagal: ${e.message}</div>`;
  }
}

// ── SHARE ─────────────────────────────────────────
function openShareModal(fileId) {
  shareFileId = fileId;
  document.getElementById('alert-share').innerHTML = '';
  document.getElementById('share-recipient').value = '';
  showModal('modal-share');
}

async function loadUsers() {
  const res  = await fetch('/securevault/api/files.php?action=get_users');
  const data = await res.json();
  if (!data.success) return;

  const sel = document.getElementById('share-recipient');
  data.users.forEach(u => {
    const opt = document.createElement('option');
    opt.value = u.id;
    opt.textContent = `${u.username} (${u.email})`;
    sel.appendChild(opt);
  });
}

async function doShare() {
  const recipientId = document.getElementById('share-recipient').value;
  if (!recipientId) { document.getElementById('alert-share').innerHTML = '<div class="sv-alert sv-alert-error">Pilih penerima.</div>'; return; }
  if (!userPrivateKey) { document.getElementById('alert-share').innerHTML = '<div class="sv-alert sv-alert-error">Kunci privat belum dimuat.</div>'; return; }

  const btn = document.getElementById('btn-do-share');
  btn.disabled = true; btn.textContent = 'Memproses...';

  try {
    // Get file session key (download metadata)
    const fileRes  = await fetch(`/securevault/api/files.php?action=download&file_id=${shareFileId}`);
    const fileData = await fileRes.json();
    if (!fileData.success) throw new Error(fileData.message);

    // Get recipient public key
    const pubRes  = await fetch(`/securevault/api/files.php?action=get_recipient_pubkey&recipient_id=${recipientId}`);
    const pubData = await pubRes.json();
    if (!pubData.success) throw new Error(pubData.message);

    const recipientPubKey = await SV.importPublicKey(pubData.public_key);

    // Re-wrap session key for recipient (key wrapping)
    const rewrappedKey = await SV.rewrapSessionKey(fileData.session_key_enc, userPrivateKey, recipientPubKey);

    // Send share request
    const fd = new FormData();
    fd.append('action', 'share');
    fd.append('file_id', shareFileId);
    fd.append('recipient_id', recipientId);
    fd.append('session_key_enc', rewrappedKey);

    const res  = await fetch('/securevault/api/files.php', { method: 'POST', body: fd });
    const data = await res.json();

    if (data.success) {
      hideModal('modal-share');
      showAlert(`✓ File berhasil dibagikan ke ${pubData.username}!`, 'success');
      await loadFiles();
    } else {
      throw new Error(data.message);
    }
  } catch (e) {
    document.getElementById('alert-share').innerHTML = `<div class="sv-alert sv-alert-error">${e.message}</div>`;
  } finally {
    btn.disabled = false; btn.innerHTML = '<i class="bi bi-send"></i> Bagikan';
  }
}

// ── DELETE ────────────────────────────────────────
async function deleteFile(fileId) {
  if (!confirm('Hapus file ini secara permanen? Kunci enkripsi juga akan dihapus dan file tidak dapat dipulihkan.')) return;

  const fd = new FormData();
  fd.append('action', 'delete');
  fd.append('file_id', fileId);

  const res  = await fetch('/securevault/api/files.php', { method: 'POST', body: fd });
  const data = await res.json();

  if (data.success) {
    showAlert('✓ File berhasil dihapus secara aman.', 'success');
    const row = document.getElementById('file-row-' + fileId);
    if (row) { row.style.opacity = '0'; row.style.transition = 'opacity 0.3s'; setTimeout(() => row.remove(), 300); }
    await loadFiles();
  } else {
    showAlert(data.message, 'error');
  }
}

// ── FILE DETAIL ───────────────────────────────────
async function showFileDetail(fileId) {
  showModal('modal-detail');
  document.getElementById('modal-detail-content').innerHTML =
    '<div style="text-align:center;padding:1rem"><div class="spinning">⚙️</div></div>';

  const res  = await fetch(`/securevault/api/files.php?action=get_file_info&file_id=${fileId}`);
  const data = await res.json();
  if (!data.success) { document.getElementById('modal-detail-content').innerHTML = `<div class="sv-alert sv-alert-error">${data.message}</div>`; return; }

  const f = data.file;
  const sharesHtml = data.shares.length > 0
    ? data.shares.map(s => `
      <div style="display:flex;align-items:center;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid var(--border)">
        <div>
          <strong>${escHtml(s.username)}</strong>
          <div style="font-size:0.75rem;color:var(--text-muted)">${escHtml(s.email)} · ${formatDate(s.shared_at)}</div>
        </div>
        <button onclick="revokeShare(${fileId}, ${s.recipient_id})" class="btn-sv btn-danger-sv" style="padding:0.25rem 0.6rem;font-size:0.75rem">
          <i class="bi bi-x-circle"></i> Cabut
        </button>
      </div>`).join('')
    : '<div style="color:var(--text-muted);font-size:0.85rem">Tidak ada yang punya akses</div>';

  document.getElementById('modal-detail-content').innerHTML = `
    <div style="font-size:0.85rem;display:flex;flex-direction:column;gap:0.5rem">
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Nama</span><strong>${escHtml(f.filename_original)}</strong></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Ukuran</span><strong>${formatBytes(f.file_size)}</strong></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Tipe</span><strong>${escHtml(f.mime_type || '-')}</strong></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Diupload</span><strong>${formatDate(f.created_at)}</strong></div>
    </div>
    <div style="margin:0.75rem 0;padding-top:0.75rem;border-top:1px solid var(--border)">
      <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:var(--text-muted);margin-bottom:0.4rem">Hash SHA-256 File Asli</div>
      <div class="key-info-box">${f.original_hash}</div>
    </div>
    <div style="margin-bottom:0.75rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border)">
      <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:var(--text-muted);margin-bottom:0.4rem">Hash File Terenkripsi (Integritas)</div>
      <div class="key-info-box">${f.file_hash}</div>
    </div>
    <div>
      <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:var(--text-muted);margin-bottom:0.75rem">Akses Dibagikan (${data.shares.length})</div>
      ${sharesHtml}
    </div>`;
}

async function revokeShare(fileId, recipientId) {
  if (!confirm('Cabut akses pengguna ini?')) return;

  const fd = new FormData();
  fd.append('action', 'revoke_share');
  fd.append('file_id', fileId);
  fd.append('recipient_id', recipientId);

  const res  = await fetch('/securevault/api/files.php', { method: 'POST', body: fd });
  const data = await res.json();

  if (data.success) {
    hideModal('modal-detail');
    showAlert('✓ Akses berhasil dicabut.', 'success');
    await loadFiles();
  } else {
    showAlert(data.message, 'error');
  }
}

function escHtml(s) {
  if (!s) return '';
  const d = document.createElement('div'); d.textContent = s; return d.innerHTML;
}

init();
</script>
</body>
</html>