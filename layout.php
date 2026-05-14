<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $museum_name; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js"></script>

    <style>
        :root {
            --bg-color: #F2F5F8;
            --white: #FFFFFF;
            --text-dark: #1A1D23;
            --accent-blue: #2D5BFF;
            --fab-primary: #111827; 
            --glass: rgba(255, 255, 255, 0.4);
            --glass-border: rgba(255, 255, 255, 0.5);
            --blur: blur(15px);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0; background-color: var(--bg-color); color: var(--text-dark);
            min-height: 100vh; overflow-x: hidden;
        }

        /* --- SIDEBAR MENU --- */
        .sidebar {
            position: fixed; top: 0; left: -280px; width: 280px; height: 100vh;
            background: var(--white); z-index: 150; transition: 0.5s cubic-bezier(0.77,0.2,0.05,1.0);
            padding: 100px 30px; box-sizing: border-box; box-shadow: 20px 0 50px rgba(0,0,0,0.05);
        }
        .sidebar.active { left: 0; }
        .nav-item { 
            display: flex; align-items: center; gap: 15px; font-size: 18px; 
            font-weight: 600; margin-bottom: 30px; cursor: pointer; color: #888; transition: 0.3s;
        }
        .nav-item:hover { color: var(--text-dark); transform: translateX(10px); }

        /* --- TOGGLE MENU --- */
        .menu-toggle {
            position: fixed; top: 30px; left: 30px; z-index: 200;
            cursor: pointer; background: var(--white); width: 50px; height: 50px;
            border-radius: 15px; display: flex; flex-direction: column;
            justify-content: center; align-items: center; gap: 5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s;
        }
        .line { width: 22px; height: 2.5px; background: var(--text-dark); border-radius: 5px; transition: 0.3s; }
        .menu-toggle.active .line:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
        .menu-toggle.active .line:nth-child(2) { opacity: 0; }
        .menu-toggle.active .line:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

        /* --- MAIN CONTENT (DASHBOARD) --- */
        .main-content { padding: 40px; transition: 0.5s; width: 100%; box-sizing: border-box; }
        .header-center { text-align: center; margin: 40px 0 50px; }
        .header-center h1 { font-size: 38px; font-weight: 800; margin: 0; }
        .header-center p { color: #888; margin-top: 10px; font-weight: 500; }

        .search-container { max-width: 600px; margin: 0 auto 60px; }
        .search-glossy {
            background: var(--glass); backdrop-filter: var(--blur); -webkit-backdrop-filter: var(--blur);
            border: 1px solid var(--glass-border); border-radius: 20px;
            padding: 18px 30px; display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.07);
        }
        .search-glossy input { background: transparent; border: none; outline: none; width: 90%; font-size: 16px; font-family: inherit; }

        .section-title { font-size: 24px; font-weight: 800; margin-bottom: 25px; padding-left: 20px; }
        
        .cards-wrapper { 
            display: flex; gap: 30px; overflow-x: auto; padding: 0 20px 40px; scrollbar-width: none; 
        }
        .cards-wrapper::-webkit-scrollbar { display: none; }

        .card-large {
            min-width: 320px; height: 420px; position: relative; border-radius: 30px; 
            overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.08); transition: 0.3s;
        }
        .card-large img { width: 100%; height: 100%; object-fit: cover; }
        .card-desc-glossy {
            position: absolute; bottom: 20px; left: 20px; right: 20px;
            background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4); padding: 20px; border-radius: 20px;
        }
        .card-desc-glossy h4 { margin: 0; font-size: 18px; font-weight: 800; }

        /* --- NOTIFIKASI GLOSSY --- */
        .glossy-notification {
            position: fixed; bottom: -120px; left: 50%; transform: translateX(-50%);
            width: 90%; max-width: 500px; background: var(--glass); backdrop-filter: var(--blur);
            border: 1px solid rgba(255,255,255,0.5); border-radius: 25px; padding: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1); z-index: 600; 
            transition: 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .glossy-notification.active { bottom: 30px; }
        .notif-content { display: flex; align-items: center; gap: 15px; position: relative; }
        .notif-text p { margin: 0; font-size: 14px; line-height: 1.4; color: var(--text-dark); }
        .btn-notif-action { 
            background: var(--accent-blue); color: white; border: none; padding: 10px 20px; 
            border-radius: 12px; font-weight: 700; margin-top: 10px; cursor: pointer; transition: 0.3s;
        }
        .btn-notif-action:hover { opacity: 0.9; transform: scale(1.02); }
        .notif-close { position: absolute; top: -10px; right: -10px; cursor: pointer; font-size: 18px; opacity: 0.5; }

        /* --- LAYER ARTIFACT DETAIL --- */
        #artifact-view {
            position: fixed; inset: 0; background: #fff; display: none;
            flex-direction: column; align-items: center; z-index: 500;
            background: linear-gradient(to bottom, #F8F9FB, #E2E8F0);
        }
        .nav-header-detail { width: 100%; padding: 30px; box-sizing: border-box; }
        .btn-back-detail {
            width: 45px; height: 45px; background: #fff; border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); cursor: pointer;
        }
        .artifact-display-container {
            flex: 1; display: flex; align-items: center; justify-content: center;
            width: 100%; position: relative;
        }
        
        model-viewer { width: 90%; height: 60vh; outline: none; --poster-color: transparent; }

        /* CSS untuk Foto Detail jika artefak berupa Gambar */
        .fallback-img-detail {
            max-height: 55vh; max-width: 85%; object-fit: contain;
            filter: drop-shadow(0 20px 40px rgba(0,0,0,0.1));
        }

        /* --- BOTTOM SHEET --- */
        .detail-bottom-sheet {
            background: var(--glass); backdrop-filter: var(--blur);
            border-top: 1px solid rgba(255,255,255,0.5);
            border-radius: 40px 40px 0 0; padding: 30px; width: 100%;
            box-shadow: 0 -15px 35px rgba(0,0,0,0.03); box-sizing: border-box;
            position: relative;
        }
        .swipe-up-indicator {
            text-align: center; color: var(--accent-blue); font-weight: 800; font-size: 12px;
            margin-top: -10px; margin-bottom: 15px; cursor: pointer;
            display: flex; flex-direction: column; align-items: center;
            animation: bounceIndicator 2s infinite;
        }
        @keyframes bounceIndicator { 0%, 20%, 50%, 80%, 100% {transform: translateY(0);} 40% {transform: translateY(-5px);} }
        
        .sheet-handle { width: 40px; height: 5px; background: #CBD5E1; border-radius: 10px; margin: 0 auto 20px; }
        .detail-title { font-size: 26px; font-weight: 800; margin: 0; }
        .detail-desc { color: #475569; font-size: 15px; line-height: 1.6; margin: 15px 0 25px; }

        /* FAB System */
        .fab-container { position: fixed; bottom: 40px; right: 40px; display: flex; flex-direction: column-reverse; align-items: center; gap: 15px; z-index: 1000; transition: transform 0.4s; }
        .fab-container.hidden { transform: translateY(150px); }
        .fab-main { width: 75px; height: 75px; background: var(--fab-primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 15px 35px rgba(0,0,0,0.2); cursor: pointer; transition: 0.3s; font-size: 30px; }
        .fab-main.active { transform: rotate(45deg); background: #E74C3C; }
        .fab-sub { width: 60px; height: 60px; background: var(--white); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(0,0,0,0.1); cursor: pointer; opacity: 0; transform: translateY(20px); transition: 0.3s; pointer-events: none; font-size: 22px; }
        .fab-container.open .fab-sub { opacity: 1; transform: translateY(0); pointer-events: auto; }
        .fab-label { position: absolute; right: 85px; background: var(--text-dark); color: white; padding: 8px 18px; border-radius: 12px; font-size: 14px; font-weight: 600; white-space: nowrap; }
    </style>
</head>
<body>

    <div class="menu-toggle" onclick="toggleMenu()">
        <div class="line"></div><div class="line"></div><div class="line"></div>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="nav-item">🏠 Dashboard</div>
        <div class="nav-item">📜 Collection History</div>
    </div>

    <div class="main-content">
        <div class="header-center">
            <h1>Welcome To Smart Museum</h1>
            <p id="system-status">Interactive AI-powered history companion</p>
        </div>

        <div class="search-container">
            <div class="search-glossy">
                <input type="text" placeholder="Search sculpture, history, or artifacts...">
                <span>🔍</span>
            </div>
        </div>

        <div class="section-title">Semua Artefak</div>
        <div class="cards-wrapper">
            <div class="card-large">
                <img src="foto/Arca-Garuda.jpg" alt="Arca Garuda">
                <div class="card-desc-glossy"><h4>Arca Garuda</h4><p>Era Majapahit</p></div>
            </div>
            <div class="card-large">
                <img src="foto/Figurin.jpg" alt="Figurin">
                <div class="card-desc-glossy"><h4>Figurin</h4><p>Perunggu Kuno</p></div>
            </div>
            <div class="card-large">
                <img src="foto/goat.jpg" alt="Tengkorak Kambing">
                <div class="card-desc-glossy"><h4>Tengkorak Kambing</h4><p>Relik Fauna Sejarah</p></div>
            </div>
            <div class="card-large">
                <img src="foto/Patung-Budha.jpg" alt="Patung Budha">
                <div class="card-desc-glossy"><h4>Patung Budha</h4><p>Relik Sejarah</p></div>
            </div>
        </div>
    </div>

    <div id="notif-toast" class="glossy-notification">
        <div class="notif-content">
            <div class="notif-close" onclick="closeNotif()">✕</div>
            <div style="font-size: 30px;">🏛️</div>
            <div class="notif-text">
                <p id="notif-text-content">Mendeteksi objek baru...</p>
                <button class="btn-notif-action" id="btn-lanjutkan">Pelajari Lebih Lanjut →</button>
            </div>
        </div>
    </div>

    <div id="artifact-view">
        <div class="nav-header-detail">
            <div class="btn-back-detail" onclick="tutupDetail()">←</div>
        </div>
        <div class="artifact-display-container" id="display-container">
            <model-viewer 
    id="detail-3d-viewer" 
    src="" 
    auto-rotate 
    camera-controls 
    shadow-intensity="1" 
    touch-action="pan-y"
    ar
    ar-modes="webxr scene-viewer quick-look"
    loading="eager"
    reveal="auto">
</model-viewer>
        </div>
        <div class="detail-bottom-sheet">
            <div class="swipe-up-indicator" id="swipe-area" onclick="openAIChat()">
                <span>▲</span>
                <span>Tanya AI Guide</span>
            </div>
            <div class="sheet-handle"></div>
            <h2 id="detail-nama" class="detail-title">Nama Artefak</h2>
            <p id="detail-desc" class="detail-desc">Memuat informasi...</p>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="background: #fff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.05); cursor: pointer;" onclick="ulangSuara()">🎧</div>
                <div style="color: var(--accent-blue); font-weight: 800; cursor: pointer;" onclick="openAIChat()">Tanya AI Guide →</div>
            </div>
        </div>
    </div>

    <div id="ai-chat-overlay" onclick="closeAIChat()" style="position: fixed; inset: 0; background: rgba(0,0,0,0); z-index: 1999; display: none;"></div>

    <div id="ai-chat-panel" style="position: fixed; bottom: -100%; left: 0; width: 100%; height: 75vh; background: var(--white); z-index: 2000; border-radius: 40px 40px 0 0; box-shadow: 0 -10px 40px rgba(0,0,0,0.15); transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column;">
        <div style="padding: 15px; text-align: center; border-bottom: 1px solid #f1f5f9;">
            <div style="width: 40px; height: 5px; background: #e2e8f0; border-radius: 10px; margin: 0 auto 15px;" onclick="closeAIChat()"></div>
            <h3 id="chat-title" style="margin: 0; font-weight: 800;">AI Guide Chat</h3>
        </div>
        <div id="chat-messages" style="flex: 1; padding: 25px; overflow-y: auto; background: #fcfdfe; display: flex; flex-direction: column; gap: 15px;">
            <div style="background: var(--accent-blue); color: white; padding: 14px 20px; border-radius: 20px 20px 20px 4px; max-width: 80%; font-size: 14px; align-self: flex-start;">
                Halo Edward! Ada yang ingin kamu tanyakan lebih dalam tentang artefak ini?
            </div>
        </div>
        <div style="padding: 20px; border-top: 1px solid #f1f5f9; display: flex; gap: 12px; background: var(--white);">
            <input type="text" id="user-chat-input" placeholder="Ketik pesan..." style="flex: 1; padding: 15px 25px; border-radius: 30px; border: 1px solid #e2e8f0; outline: none; font-family: inherit;">
            <button onclick="sendChatMessage()" style="background: var(--accent-blue); color: white; border: none; width: 50px; height: 50px; border-radius: 50%; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center;">🕊️</button>
        </div>
    </div>

    <?php include 'fab-menu.php'; ?>

<script>
    const SERVICE_UUID = "<?php echo $service_uuid; ?>";
    const CHARACTERISTIC_UUID = "<?php echo $characteristic_uuid; ?>";
    let bleChar;
    let currentArtifactData = null;
    let touchstartY = 0;

    function toggleMenu() {
        document.getElementById('sidebar').classList.toggle('active');
        document.querySelector('.menu-toggle').classList.toggle('active');
    }

    function toggleFab() {
        document.getElementById('fabContainer').classList.toggle('open');
    }

    async function mulaiPairing() {
        if(document.getElementById('fabContainer').classList.contains('open')) toggleFab();
        try {
            const device = await navigator.bluetooth.requestDevice({
                filters: [{ name: 'SmartCard-Edward' }],
                optionalServices: [SERVICE_UUID]
            });
            const server = await device.gatt.connect();
            const service = await server.getPrimaryService(SERVICE_UUID);
            bleChar = await service.getCharacteristic(CHARACTERISTIC_UUID);
            await bleChar.startNotifications();
            bleChar.addEventListener('characteristicvaluechanged', (e) => {
                let id = new TextDecoder().decode(e.target.value).trim();
                handleIDReceived(id);
            });
            document.getElementById('system-status').innerText = "📡 Connected - Scanning...";
            alert("Bluetooth Connected!");
        } catch (err) { alert("Bluetooth Error!"); }
    }

    function handleIDReceived(id) {
        fetch('api.php', { method: 'POST', body: JSON.stringify({ id: id }) })
        .then(res => res.json())
        .then(res => {
            if(res.status === 'success') {
                currentArtifactData = res.data;
                document.getElementById('notif-text-content').innerHTML = `Didepanmu adalah <b>${res.data.nama}</b>.`;
                document.getElementById('notif-toast').classList.add('active');
                window.speechSynthesis.cancel();
                let intro = new SpeechSynthesisUtterance(`Halo Edward! Saya mendeteksi ${res.data.nama}.`);
                intro.lang = 'id-ID';
                window.speechSynthesis.speak(intro);
                document.getElementById('btn-lanjutkan').onclick = function() { tampilkanDetailPenuh(); };
            }
        });
    }
function tampilkanDetailPenuh() {
    closeNotif();
    document.querySelector('.main-content').style.display = 'none';
    document.getElementById('artifact-view').style.display = 'flex';
    
    const container = document.getElementById('display-container');
    const viewer = document.getElementById('detail-3d-viewer');
    
    let oldImg = document.getElementById('fallback-img');
    if(oldImg) oldImg.remove();

    let fileName = currentArtifactData.image; 
    let finalPath = fileName; // Karena api.php mu sudah pakai "foto/goat.glb"

    if (fileName.toLowerCase().endsWith('.glb')) {
        viewer.style.display = 'block';
        
        // PENTING: Force update src
        viewer.src = finalPath; 
        
        // Logika tambahan jika file gagal dimuat (cek di console F12)
        viewer.addEventListener('error', (error) => {
            console.error("Gagal muat model 3D:", error);
        });
    } else {
        viewer.style.display = 'none';
        let img = document.createElement('img');
        img.id = 'fallback-img';
        img.src = finalPath;
        img.className = 'fallback-img-detail';
        container.appendChild(img);
    }
    
    document.getElementById('detail-nama').innerText = currentArtifactData.nama;
    document.getElementById('detail-desc').innerText = currentArtifactData.ai_response;
    ulangSuara();
}

    function closeNotif() { document.getElementById('notif-toast').classList.remove('active'); }

    function tutupDetail() {
        document.getElementById('artifact-view').style.display = 'none';
        document.querySelector('.main-content').style.display = 'block';
        window.speechSynthesis.cancel();
    }

    function ulangSuara() {
        if(!currentArtifactData) return;
        window.speechSynthesis.cancel();
        let msg = new SpeechSynthesisUtterance(currentArtifactData.ai_response);
        msg.lang = 'id-ID';
        window.speechSynthesis.speak(msg);
    }

    function openAIChat() {
        document.getElementById('chat-title').innerText = "Tanya AI: " + (currentArtifactData ? currentArtifactData.nama : "Guide");
        document.getElementById('ai-chat-panel').style.bottom = "0";
        document.getElementById('ai-chat-overlay').style.display = "block";
        document.getElementById('fabContainer').classList.add('hidden');
    }

    function closeAIChat() {
        document.getElementById('ai-chat-panel').style.bottom = "-100%";
        document.getElementById('ai-chat-overlay').style.display = "none";
        document.getElementById('fabContainer').classList.remove('hidden');
    }

    function sendChatMessage() {
        const input = document.getElementById('user-chat-input');
        const chatContainer = document.getElementById('chat-messages');
        if (input.value.trim() !== "") {
            const userMsg = document.createElement('div');
            userMsg.style = "background: #f1f5f9; color: #1e293b; padding: 14px 20px; border-radius: 20px 20px 4px 20px; max-width: 80%; font-size: 14px; align-self: flex-end;";
            userMsg.innerText = input.value;
            chatContainer.appendChild(userMsg);
            input.value = "";
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    }

    document.getElementById('user-chat-input').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') sendChatMessage();
    });

    const swipeArea = document.getElementById('swipe-area');
    swipeArea.addEventListener('touchstart', e => { touchstartY = e.changedTouches[0].screenY; });
    swipeArea.addEventListener('touchend', e => {
        if (touchstartY - e.changedTouches[0].screenY > 50) openAIChat();
    });
</script>
</body>
</html>