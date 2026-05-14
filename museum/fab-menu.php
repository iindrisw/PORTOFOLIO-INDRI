<style>
    .fab-container { position: fixed; bottom: 30px; right: 30px; display: flex; flex-direction: column-reverse; align-items: center; z-index: 1500; transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .fab-container.hidden { transform: translateY(150px); pointer-events: none; }
    .fab-main { width: 75px; height: 75px; background: var(--fab-primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 15px 35px rgba(0,0,0,0.2); cursor: pointer; transition: 0.3s; font-size: 30px; z-index: 1501; }
    .fab-main.active { transform: rotate(45deg); background: #E74C3C; }
    .fab-sub { width: 60px; height: 60px; background: var(--white); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(0,0,0,0.1); cursor: pointer; opacity: 0; transform: translateY(20px); transition: 0.3s; pointer-events: none; font-size: 22px; margin-bottom: 15px; position: relative; }
    .fab-container.open .fab-sub { opacity: 1; transform: translateY(0); pointer-events: auto; }
    .fab-label { position: absolute; right: 85px; background: var(--text-dark); color: white; padding: 8px 18px; border-radius: 12px; font-size: 14px; font-weight: 600; white-space: nowrap; }
</style>

<div class="fab-container" id="fabContainer">
    <div class="fab-main" id="mainFabBtn" onclick="toggleFab()">+</div>
    <div class="fab-sub" onclick="openAIChat()">
        <span class="fab-label">Tanya AI</span>💬
    </div>
    <div class="fab-sub" onclick="mulaiPairing()">
        <span class="fab-label">Pairing SmartCard</span>🔗
    </div>
</div>