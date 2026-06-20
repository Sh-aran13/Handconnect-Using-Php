<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hand Connect — Live</title>
  
  <!-- Modern Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

  <style>
    /* CSS Variables for Easy Theming */
    :root {
      --bg-color: #050505;
      --panel-bg: rgba(255, 255, 255, 0.03);
      --panel-border: rgba(255, 255, 255, 0.08);
      --text-main: #f3f4f6;
      --text-muted: #9ca3af;
      --primary-glow: #00f2fe;
      --secondary-glow: #4facfe;
      --hud-bg: rgba(0, 0, 0, 0.5);
    }

    /* Base Reset & Typography */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Outfit', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-main);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-image: 
        radial-gradient(circle at 15% 50%, rgba(0, 242, 254, 0.05), transparent 30%),
        radial-gradient(circle at 85% 30%, rgba(79, 172, 254, 0.05), transparent 30%);
      overflow-x: hidden;
    }

    .app-shell {
      width: 100%;
      max-width: 1100px;
      padding: 1.5rem;
      animation: fadeIn 1s ease-out;
    }

    /* Main Video Container */
    .video-card {
      position: relative;
      background: var(--panel-bg);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--panel-border);
      border-radius: 24px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
      overflow: hidden;
      aspect-ratio: 16 / 9;
      display: flex;
      flex-direction: column;
    }

    /* Video and Canvas Layers */
    .video-layer,
    .visual-canvas {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 24px;
      transform: scaleX(-1);
    }

    .video-layer {
      z-index: 1;
      background: #000;
    }

    .visual-canvas {
      z-index: 2;
      pointer-events: none; /* Let clicks pass through to video if needed */
    }

    /* Top Left Label */
    .video-label {
      position: absolute;
      top: 1.5rem;
      left: 1.5rem;
      z-index: 10;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(8px);
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-size: 0.9rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .video-label::before {
      content: '';
      display: block;
      width: 8px;
      height: 8px;
      background-color: #ff3b30;
      border-radius: 50%;
      box-shadow: 0 0 8px #ff3b30;
      animation: pulse 1.5s infinite;
    }

    /* Controls Container (Top Right) */
    .controls-overlay {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      z-index: 12;
      display: flex;
      gap: 0.8rem;
      align-items: center;
    }

    /* Modern Select Dropdown */
    .theme-select {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(8px);
      color: var(--text-main);
      border: 1px solid rgba(0, 242, 254, 0.3);
      padding: 0.6rem 1.2rem;
      border-radius: 50px;
      font-family: 'Outfit', sans-serif;
      font-size: 0.95rem;
      font-weight: 600;
      outline: none;
      cursor: pointer;
      appearance: none;
      -webkit-appearance: none;
      padding-right: 2.5rem;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2300f2fe' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.8rem center;
      background-size: 1rem;
      transition: all 0.3s ease;
    }

    .theme-select:hover, .theme-select:focus {
      border-color: var(--primary-glow);
      box-shadow: 0 0 15px rgba(0, 242, 254, 0.2);
    }

    .theme-select option {
      background: var(--bg-color);
      color: #fff;
    }

    /* Primary Action Button */
    .btn-primary {
      background: linear-gradient(135deg, var(--primary-glow), var(--secondary-glow));
      color: #000;
      font-family: 'Outfit', sans-serif;
      font-size: 1rem;
      font-weight: 800;
      padding: 0.6rem 1.5rem;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 242, 254, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 242, 254, 0.5);
    }

    /* Bottom Stats Bar (HUD) */
    .stats-bar {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      z-index: 10;
      background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
      padding: 2rem 1.5rem 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
    }

    #statusText {
      font-size: 1.1rem;
      font-weight: 400;
      color: var(--text-main);
      text-shadow: 0 2px 4px rgba(0,0,0,0.8);
    }

    .mini-stats {
      display: flex;
      gap: 1rem;
    }

    .mini-stats span {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(4px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      padding: 0.4rem 0.8rem;
      border-radius: 8px;
      font-family: 'JetBrains Mono', monospace; /* Monospace for changing numbers */
      font-size: 0.85rem;
      color: var(--primary-glow);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.98); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(255, 59, 48, 0.7); }
      70% { box-shadow: 0 0 0 6px rgba(255, 59, 48, 0); }
      100% { box-shadow: 0 0 0 0 rgba(255, 59, 48, 0); }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .video-card {
        aspect-ratio: 4 / 3;
      }
      .stats-bar {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }
      .controls-overlay {
        flex-direction: column;
        align-items: flex-end;
      }
    }
  </style>
</head>
<body>
  <div class="app-shell">
    <div class="video-card">
      
      <!-- Top Left Label -->
      <div class="video-label">Live Camera</div>
      
      <!-- Video and Canvas Feeds -->
      <video id="inputVideo" playsinline class="video-layer"></video>
      <canvas id="outputCanvas" class="visual-canvas"></canvas>
      
      <!-- Top Right Controls -->
      <div class="controls-overlay">
        <button id="startButton" class="btn-primary">Dive In</button>
        <select id="themeSelect" class="theme-select" aria-label="Select visual theme" style="display:none;">
          <option value="neon">Neon Flow</option>
          <option value="sunset">Sunset Pulse</option>
          <option value="matrix">Matrix Wave</option>
        </select>
      </div>

      <!-- Bottom HUD / Stats -->
      <div class="stats-bar">
        <div id="statusText">Tap Dive In to grant camera access</div>
        <div class="mini-stats">
          <span id="fpsValue">FPS: --</span>
            <span id="gestureValue">Gesture: --</span>
            <span id="handInfo">Hands: --</span>
        </div>
      </div>

    </div>
  </div>

  <!-- MediaPipe & External Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
  <script src="script.js"></script>
</body>
</html>