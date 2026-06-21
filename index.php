<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Hand Connect — AI Experience</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jim+Nightshade&family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Space+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

  <style>
    /* Premium High-Tech Design System */
    :root {
      --bg-base: #020205;
      --surface: rgba(10, 10, 20, 0.4);
      --surface-hover: rgba(255, 255, 255, 0.03);
      --border: rgba(255, 255, 255, 0.06);
      --border-highlight: rgba(0, 242, 254, 0.25);
      
      --text-primary: #ffffff;
      --text-secondary: #94a3b8;
      
      --accent-cyan: #00f2fe;
      --accent-purple: #9d4edd;
      --accent-pink: #ff007f;
      
      --font-display: 'Jim Nightshade', 'Space Grotesk', sans-serif;
      --font-body: 'Playfair Display', Georgia, serif;
    }
      --bg-base: #020205;
      --surface: rgba(10, 10, 20, 0.4);
      --surface-hover: rgba(255, 255, 255, 0.03);
      --border: rgba(255, 255, 255, 0.06);
      --border-highlight: rgba(0, 242, 254, 0.25);
      
      --text-primary: #ffffff;
      --text-secondary: #94a3b8;
      
      --accent-cyan: #00f2fe;
      --accent-purple: #9d4edd;
      --accent-pink: #ff007f;
      
      --font-display: 'Jim Nightshade', 'Space Grotesk', sans-serif;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      -webkit-tap-highlight-color: transparent;
    }

    body {
      font-family: var(--font-body);
      background-color: var(--bg-base);
      color: var(--text-primary);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow-x: hidden;
      position: relative;
      line-height: 1.6;
      padding: 2rem 1rem;
    }

    p,
    .card p,
    ol.timeline li {
      font-family: var(--font-body);
    }

    /* Cinematic Depth Layering (Ambient Orbs) */
    .ambient-bg {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      overflow: hidden;
      z-index: -1;
      pointer-events: none;
    }

    .orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(130px);
      opacity: 0.25;
      animation: floatOrbit 24s infinite ease-in-out alternate;
    }

    .orb-1 {
      width: 550px; height: 550px;
      background: var(--accent-cyan);
      top: -15%; left: -10%;
    }

    .orb-2 {
      width: 650px; height: 650px;
      background: var(--accent-purple);
      bottom: -20%; right: -10%;
      animation-delay: -6s;
    }

    .orb-3 {
      width: 400px; height: 400px;
      background: var(--accent-pink);
      top: 30%; left: 40%;
      animation-delay: -12s;
      opacity: 0.12;
    }

    @keyframes floatOrbit {
      0% { transform: translate(0, 0) scale(1) rotate(0deg); }
      50% { transform: translate(60px, 40px) scale(1.15) rotate(90deg); }
      100% { transform: translate(-40px, 80px) scale(0.9) rotate(180deg); }
    }

    /* Adaptive Architecture Shell */
    .app-shell {
      width: 100%;
      max-width: 1060px;
      margin: auto;
      perspective: 1200px;
    }

    /* Glassmorphic Spatial Panel Container */
    .details-panel {
      background: var(--surface);
      backdrop-filter: blur(35px);
      -webkit-backdrop-filter: blur(35px);
      border: 1px solid var(--border);
      border-radius: 40px;
      padding: 4.5rem;
      box-shadow: 
        0 40px 100px rgba(0, 0, 0, 0.8),
        inset 0 1px 1px rgba(255, 255, 255, 0.08);
      display: flex;
      flex-direction: column;
      gap: 4.5rem;
      position: relative;
      overflow: hidden;
      animation: initialIntro 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes initialIntro {
      0% { opacity: 0; transform: translateY(50px) rotateX(8deg); }
      100% { opacity: 1; transform: translateY(0) rotateX(0deg); }
    }

    /* Refined Structural Headers */
    h1, h2, h3 {
      font-family: var(--font-display);
      letter-spacing: -0.02em;
    }

    .hero-section {
      text-align: center;
      max-width: 760px;
      margin: 0 auto;
    }

    /* Hand Connect Title Styles Unified */
    .hero-section h1 {
      font-size: 5.5rem;
      font-weight: 700;
      line-height: 1.05;
      margin-bottom: 1.5rem;
      text-transform: tracking;
      background: linear-gradient(135deg, #ffffff 30%, #a1a1aa 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-section p {
      font-size: 1.25rem;
      color: var(--text-secondary);
      font-weight: 300;
      line-height: 1.6;
    }

    /* Sections Hierarchy */
    h2 {
      font-size: 1.6rem;
      font-weight: 600;
      margin-bottom: 2.5rem;
      display: flex;
      align-items: center;
      gap: 0.8rem;
    }

    h2::before {
      content: '';
      display: block;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--accent-cyan);
      box-shadow: 0 0 12px var(--accent-cyan);
    }

    /* Immersive Sequential Timeline */
    ol.timeline {
      list-style: none;
      position: relative;
      padding-left: 2.5rem;
      display: flex;
      flex-direction: column;
      gap: 2.5rem;
    }

    ol.timeline::before {
      content: '';
      position: absolute;
      top: 8px; bottom: 8px; left: 8px;
      width: 1px;
      background: linear-gradient(to bottom, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.02));
    }

    ol.timeline li {
      position: relative;
      font-size: 1.05rem;
      color: var(--text-secondary);
    }

    ol.timeline li strong {
      font-family: var(--font-display);
      color: var(--text-primary);
      font-size: 1.15rem;
      font-weight: 600;
      display: block;
      margin-bottom: 0.4rem;
    }

    ol.timeline li::before {
      content: '';
      position: absolute;
      left: -2.4rem;
      top: 0.45rem;
      width: 100%;
      max-width: 18px;
      height: 18px;
      border-radius: 6px;
      background: #06060c;
      border: 1px solid var(--border-highlight);
      box-shadow: 0 0 10px rgba(0, 242, 254, 0.15);
      z-index: 2;
      transition: all 0.3s ease;
    }

    ol.timeline li:hover::before {
      background: var(--accent-cyan);
      box-shadow: 0 0 14px var(--accent-cyan);
      transform: scale(1.1);
    }

    /* Kinetic Primary Interaction Control Button */
    .cta-container {
      margin-top: 3.5rem;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      gap: 0.8rem;
      background: linear-gradient(135deg, #ffffff, #e2e8f0);
      color: #020205;
      text-decoration: none;
      font-family: var(--font-display);
      font-weight: 600;
      font-size: 1.05rem;
      padding: 1.2rem 3rem;
      border-radius: 16px;
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
      box-shadow: 0 4px 20px rgba(255, 255, 255, 0.05);
      min-width: 0;
      width: auto;
      max-width: 100%;
      box-sizing: border-box;
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(255, 255, 255, 0.18);
      background: #ffffff;
    }

    .btn-primary svg {
      width: 18px; height: 18px;
      transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-primary:hover svg {
      transform: translateX(6px);
    }

    /* Spatial Dynamic Grid Array */
    .feature-cards {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
    }

    .card {
      background: rgba(255, 255, 255, 0.01);
      border: 1px solid var(--border);
      padding: 3rem;
      border-radius: 28px;
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    .card:hover {
      background: var(--surface-hover);
      border-color: rgba(255, 255, 255, 0.15);
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .card-icon {
      width: 52px;
      height: 52px;
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.06);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent-cyan);
      margin-bottom: 0.25rem;
      transition: all 0.3s ease;
    }

    .card:hover .card-icon {
      color: #ffffff;
      background: var(--accent-purple);
      border-color: rgba(157, 78, 221, 0.4);
      box-shadow: 0 0 20px rgba(157, 78, 221, 0.4);
    }

    .card h3 {
      font-size: 1.35rem;
      font-weight: 500;
      color: var(--text-primary);
    }

    .card p {
      color: var(--text-secondary);
      font-size: 1rem;
      line-height: 1.6;
      font-weight: 300;
    }

    /* Fully Scalable Mobile Optimization Layout Architectures */
    @media (max-width: 900px) {
      .details-panel {
        padding: 3.5rem 2.5rem;
        gap: 3.5rem;
      }
      .hero-section h1 { font-size: 3.6rem; }
      .feature-cards { grid-template-columns: 1fr; gap: 1.5rem; }
      .cta-container {
        width: 100%;
      }
      .btn-primary {
        width: 100%;
        font-size: 1rem;
        padding: 1.1rem 1.5rem;
      }
    }

    @media (max-width: 600px) {
      body {
        padding: 1rem 0.5rem;
      }
      .details-panel {
        padding: 3rem 1.25rem 2.5rem;
        border-radius: 30px;
        gap: 3rem;
      }
      .hero-section h1 { 
        font-size: 2.8rem; 
        letter-spacing: -0.03em;
      }
      .hero-section p { font-size: 1.1rem; }
      ol.timeline { padding-left: 1.75rem; }
      ol.timeline li::before { left: -1.75rem; top: 0.4rem; }
      .btn-primary { width: 100%; justify-content: center; padding: 1rem 1.25rem; border-radius: 14px; }
      .card { padding: 2rem 1.5rem; border-radius: 20px; }
    }
  </style>
</head>
<body>
  
  <div class="ambient-bg">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
  </div>

  <div class="app-shell">
    <main class="details-panel">
      
      <section class="hero-section">
        <h1>Hand Connect</h1>
        <p>An AI-powered spatial experience. Transform your movements into dynamic visual art and generative audio using MediaPipe edge tracking.</p>
      </section>

      <section class="content-section">
        <h2>Initialization Sequence</h2>
        <ol class="timeline">
          <li>
            <strong>Enable Sensors</strong>
            Open the Live interface and grant camera permissions to activate edge tracking.
          </li>
          <li>
            <strong>Calibrate Tracking</strong>
            Present one or two hands to the optical sensor. The system maps up to 42 joints in real-time.
          </li>
          <li>
            <strong>Generate Output</strong>
            Perform gestures (pinches, open hands, motions) to drive the fluid particle systems and audio engine.
          </li>
        </ol>
        <div class="cta-container">
          <a class="btn-primary" href="live.php">
            Launch Experience
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>
      </section>

      <section class="feature-cards">
        <article class="card">
          <div class="card-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
            </svg>
          </div>
          <h3>Spatial Tracking</h3>
          <p>Dual-hand mapping processed entirely on-device, offering zero-latency responsiveness and total privacy.</p>
        </article>

        <article class="card">
          <div class="card-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
            </svg>
          </div>
          <h3>Generative Feedback</h3>
          <p>Kinetic motions dynamically alter synthesizer frequencies, low-pass filters, and particle simulations in real time.</p>
        </article>
      </section>

    </main>
  </div>
</body>
</html>