<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" />
  <title>Hand Connect — Next Gen Interface</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&family=Space+Grotesk:wght@400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

  <style>
    /* Premium Theme & Cyber Glow Palette */
    :root {
      --bg-color: #020205;
      --card-bg: rgba(6, 6, 14, 0.4);
      --card-border: rgba(0, 242, 254, 0.15);
      --text-main: #f8fafc;
      --text-sub: #94a3b8;
      
      /* Neon Core Ecosystem */
      --cyan-glow: #00f2fe;
      --purple-glow: #9d4edd;
      --neon-pink: #ff007f;
      --danger-pulse: #ff3333;
      
      --hud-panel-bg: rgba(2, 2, 5, 0.75);
      --font-display: 'Space Grotesk', sans-serif;
    }

    /* Core Reset & Webkit Fine-Tuning */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      -webkit-tap-highlight-color: transparent;
    }

    body {
      font-family: 'Outfit', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-main);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1.5rem;
      overflow-x: hidden;
      position: relative;
    }

    /* Animated Ambient Energy Fields */
    body::before, body::after {
      content: '';
      position: absolute;
      width: 45vw;
      height: 45vw;
      border-radius: 50%;
      filter: blur(140px);
      z-index: -1;
      opacity: 0.25;
      animation: drift AmbientMove 25s infinite alternate ease-in-out;
    }
    body::before {
      background: radial-gradient(circle, var(--cyan-glow) 0%, transparent 70%);
      top: -10%;
      left: -5%;
    }
    body::after {
      background: radial-gradient(circle, var(--purple-glow) 0%, transparent 70%);
      bottom: -10%;
      right: -5%;
      animation-delay: -7s;
    }

    @keyframes drift {
      0% { transform: translateY(0) scale(1) rotate(0deg); }
      100% { transform: translateY(50px) scale(1.2) rotate(180deg); }
    }

    /* Cinematic Interface Shell */
    .app-shell {
      width: 100%;
      max-width: 1240px;
      margin: auto;
      perspective: 1000px;
    }

    /* Next-Gen Vision Card Wrapper */
    .video-card {
      position: relative;
      background: var(--card-bg);
      backdrop-filter: blur(30px);
      -webkit-backdrop-filter: blur(30px);
      border: 1px solid var(--card-border);
      border-radius: 32px;
      box-shadow: 
        0 0 40px rgba(0, 242, 254, 0.05),
        0 40px 80px rgba(0, 0, 0, 0.7),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
      overflow: hidden;
      width: 100%;
      aspect-ratio: 16 / 9;
      display: flex;
      flex-direction: column;
      transform: rotateX(2deg);
      animation: introCard 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes introCard {
      0% { opacity: 0; transform: translateY(40px) rotateX(15deg); filter: blur(10px); }
      100% { opacity: 1; transform: translateY(0) rotateX(0deg); filter: blur(0); }
    }

    /* Video Mirror Feeds */
    .video-layer,
    .visual-canvas {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: scaleX(-1);
    }

    .video-layer {
      z-index: 1;
      background: #010103;
    }

    .visual-canvas {
      z-index: 2;
      pointer-events: none;
    }

    /* Premium Dynamic Telemetry Badge */
    .video-label {
      position: absolute;
      top: 1.5rem;
      left: 1.5rem;
      z-index: 10;
      background: rgba(4, 4, 10, 0.65);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      padding: 0.6rem 1.2rem;
      border-radius: 14px;
      font-family: var(--font-display);
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      display: flex;
      align-items: center;
      gap: 0.6rem;
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .video-label::before {
      content: '';
      width: 7px;
      height: 7px;
      background-color: var(--danger-pulse);
      border-radius: 50%;
      box-shadow: 0 0 12px var(--danger-pulse);
      animation: dynamicPulse 1.8s infinite cubic-bezier(0.4, 0, 0.6, 1);
    }

    @keyframes dynamicPulse {
      0%, 100% { transform: scale(1); opacity: 1; box-shadow: 0 0 12px var(--danger-pulse); }
      50% { transform: scale(1.3); opacity: 0.4; box-shadow: 0 0 2px var(--danger-pulse); }
    }

    /* Interactive Control Rig Overlay */
    .controls-overlay {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      z-index: 12;
      display: flex;
      gap: 0.75rem;
      align-items: center;
    }

    /* Theme Option Dropdown Drop */
    .theme-select {
      background: var(--hud-panel-bg);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      color: var(--text-main);
      border: 1px solid rgba(0, 242, 254, 0.25);
      padding: 0.7rem 2.5rem 0.7rem 1.2rem;
      border-radius: 14px;
      font-family: var(--font-display);
      font-size: 0.85rem;
      font-weight: 600;
      outline: none;
      cursor: pointer;
      appearance: none;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2300f2fe' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.9rem center;
      background-size: 0.9rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .theme-select:hover {
      border-color: var(--cyan-glow);
      box-shadow: 0 0 20px rgba(0, 242, 254, 0.2);
    }

    .theme-select option {
      background: #09090e;
      color: #fff;
    }

    /* Action Trigger Components */
    .btn-primary {
      background: linear-gradient(135deg, var(--cyan-glow), var(--purple-glow));
      color: #020205;
      font-family: var(--font-display);
      font-size: 0.9rem;
      font-weight: 700;
      padding: 0.7rem 1.6rem;
      border: none;
      border-radius: 14px;
      cursor: pointer;
      letter-spacing: 0.5px;
      transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
      box-shadow: 0 4px 20px rgba(0, 242, 254, 0.25);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(0, 242, 254, 0.45);
      letter-spacing: 1px;
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.04);
      color: var(--text-main);
      border: 1px solid rgba(255, 255, 255, 0.1);
      font-family: var(--font-display);
      font-size: 0.85rem;
      font-weight: 600;
      padding: 0.7rem 1.3rem;
      border-radius: 14px;
      cursor: pointer;
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      transition: all 0.25s ease;
    }

    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.09);
      border-color: rgba(0, 242, 254, 0.4);
      transform: translateY(-1px);
    }

    /* Integrated HUD Display Base */
    .stats-bar {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      z-index: 10;
      background: linear-gradient(to top, rgba(2, 2, 5, 0.98) 0%, rgba(2, 2, 5, 0.7) 60%, rgba(0, 0, 0, 0) 100%);
      padding: 4rem 2rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      gap: 2rem;
    }

    #statusText {
      font-size: 1.05rem;
      font-weight: 400;
      color: var(--text-sub);
      max-width: 45%;
      letter-spacing: 0.2px;
      line-height: 1.5;
    }

    /* Telemetry Pill Array */
    .mini-stats {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-end;
      gap: 0.6rem;
      max-width: 55%;
    }

    .mini-stats span {
      background: rgba(6, 6, 14, 0.6);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.06);
      padding: 0.5rem 1rem;
      border-radius: 12px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.8rem;
      font-weight: 700;
      color: var(--cyan-glow);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Active Highlight States for Live Analytics updates */
    .mini-stats span:not(:empty) {
      border-color: rgba(0, 242, 254, 0.2);
      background: rgba(0, 242, 254, 0.02);
    }

    /* Precision Breakpoint Adaptation Rules */
    @media (max-width: 960px) {
      .video-card {
        aspect-ratio: 4 / 3;
        border-radius: 24px;
      }
      #statusText { max-width: 100%; }
      .mini-stats { max-width: 100%; justify-content: flex-start; }
    }

    @media (max-width: 680px) {
      body {
        padding: 0.75rem;
        align-items: center;
      }

      .video-card {
        aspect-ratio: 9 / 16; /* Cinematic portrait format for optimized handling on mobiles */
        height: 82vh;
        max-height: 780px;
        border-radius: 28px;
      }

      /* Control Deck Transformation Grid */
      .controls-overlay {
        top: auto;
        bottom: 12.5rem; 
        left: 1.25rem;
        right: 1.25rem;
        justify-content: gap;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
        width: calc(100% - 2.5rem);
      }

      .controls-overlay button, 
      .controls-overlay select {
        width: 100%;
        font-size: 0.8rem;
        padding: 0.75rem 0.5rem;
        text-align: center;
        border-radius: 12px;
      }

      .theme-select {
        background-position: right 0.6rem center;
      }

      /* Footer Micro-Telemetry Assembly */
      .stats-bar {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
        padding: 1.5rem 1.25rem 1.5rem;
        background: linear-gradient(to top, rgba(2, 2, 5, 1) 0%, rgba(2, 2, 5, 0.9) 85%, rgba(0,0,0,0) 100%);
      }

      #statusText {
        font-size: 0.9rem;
        text-align: center;
        margin-bottom: 0.25rem;
      }

      .mini-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.4rem;
        width: 100%;
      }

      .mini-stats span {
        text-align: center;
        padding: 0.5rem 0.25rem;
        font-size: 0.75rem;
        border-radius: 10px;
      }
      
      /* Force single primary focal telemetry pill across top screen space width */
      .mini-stats span:first-child {
        grid-column: span 2;
        color: #fff;
        background: rgba(157, 78, 221, 0.15);
        border-color: rgba(157, 78, 221, 0.3);
      }
    }
  </style>
</head>
<body>

  <div class="app-shell">
    <div class="video-card">
      
      <div class="video-label">System Active</div>
      
      <video id="inputVideo" playsinline muted autoplay class="video-layer"></video>
      <canvas id="outputCanvas" class="visual-canvas"></canvas>
      
      <div class="controls-overlay">
        <button id="startButton" class="btn-primary">Dive In</button>
        <button id="mirrorButton" class="btn-secondary">Unmirror</button>
        <button id="snapshotButton" class="btn-secondary">Snapshot</button>
        <select id="themeSelect" class="theme-select" aria-label="Select visual theme" style="display:none;">
          <option value="neon">Neon Flow</option>
          <option value="sunset">Sunset Pulse</option>
          <option value="matrix">Matrix Wave</option>
        </select>
      </div>

      <div class="stats-bar">
        <div id="statusText">System initialized. Awaiting user input verification to access optical stream.</div>
        <div class="mini-stats">
          <span id="fpsValue">FPS: --</span>
          <span id="gestureValue">Gesture: --</span>
          <span id="handInfo">Hands: --</span>
          <span id="motionValue">Motion: --</span>
          <span id="distanceValue">Gap: --</span>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
  <script src="script.js"></script>
</body>
</html>