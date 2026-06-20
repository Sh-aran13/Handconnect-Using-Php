<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hand Connect — AI Experience</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Space+Grotesk:wght@500;700&family=Jim+Nightshade&display=swap" rel="stylesheet">

  <style>
    /* Premium Tech Theme Variables */
    :root {
      --bg-base: #030305;
      --surface: rgba(255, 255, 255, 0.02);
      --surface-hover: rgba(255, 255, 255, 0.04);
      --border: rgba(255, 255, 255, 0.08);
      --border-highlight: rgba(255, 255, 255, 0.2);
      
      --text-primary: #ffffff;
      --text-secondary: #a1a1aa;
      
      --accent-1: #6366f1; /* Indigo */
      --accent-2: #a855f7; /* Purple */
      --accent-3: #ec4899; /* Pink */
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-base);
      color: var(--text-primary);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow-x: hidden;
      position: relative;
      line-height: 1.6;
    }

    /* Ambient Animated Background Orbs */
    .ambient-bg {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      overflow: hidden;
      z-index: -1;
      background: var(--bg-base);
    }

    .orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.4;
      animation: float 20s infinite ease-in-out alternate;
    }

    .orb-1 {
      width: 400px; height: 400px;
      background: var(--accent-1);
      top: -10%; left: -10%;
    }

    .orb-2 {
      width: 500px; height: 500px;
      background: var(--accent-2);
      bottom: -20%; right: -10%;
      animation-delay: -5s;
    }

    .orb-3 {
      width: 300px; height: 300px;
      background: var(--accent-3);
      top: 40%; left: 50%;
      animation-delay: -10s;
      opacity: 0.2;
    }

    @keyframes float {
      0% { transform: translate(0, 0) scale(1); }
      100% { transform: translate(50px, 50px) scale(1.1); }
    }

    /* Layout Shell */
    .app-shell {
      width: 100%;
      max-width: 1000px;
      padding: 2rem;
      position: relative;
      z-index: 1;
    }

    /* Main Container */
    .details-panel {
      background: var(--surface);
      backdrop-filter: blur(40px);
      -webkit-backdrop-filter: blur(40px);
      border: 1px solid var(--border);
      border-radius: 32px;
      padding: 4rem;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255,255,255,0.1);
      display: flex;
      flex-direction: column;
      gap: 3.5rem;
    }

    /* Headings */
    h1, h2, h3 {
      font-family: 'Space Grotesk', sans-serif;
    }

    .hero-section {
      text-align: center;
      max-width: 700px;
      margin: 0 auto;
      animation: slideUp 0.8s ease-out forwards;
    }

    .hero-section h1 {
      font-family: 'Jim Nightshade', cursive;
      font-size: 5rem;
      font-weight: 400;
      letter-spacing: -0.03em;
      margin-bottom: 1rem;
      background: linear-gradient(to right, #ffffff, #d1d5db);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-section p {
      font-size: 1.25rem;
      color: var(--text-secondary);
      font-weight: 300;
    }

    /* Section Styling */
    .content-section {
      opacity: 0;
      animation: slideUp 0.8s ease-out 0.2s forwards;
    }

    h2 {
      font-size: 1.5rem;
      font-weight: 500;
      margin-bottom: 2rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    h2::before {
      content: '';
      display: block;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent-1), var(--accent-3));
    }

    /* Sleek Timeline List */
    ol.timeline {
      list-style: none;
      position: relative;
      padding-left: 2rem;
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    ol.timeline::before {
      content: '';
      position: absolute;
      top: 10px; bottom: 10px; left: 7px;
      width: 2px;
      background: linear-gradient(to bottom, var(--border-highlight), transparent);
    }

    ol.timeline li {
      position: relative;
      font-size: 1.1rem;
      color: var(--text-secondary);
    }

    ol.timeline li strong {
      color: var(--text-primary);
      font-weight: 500;
      display: block;
      margin-bottom: 0.25rem;
    }

    ol.timeline li::before {
      content: '';
      position: absolute;
      left: -2.35rem;
      top: 0.35rem;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background: var(--bg-base);
      border: 2px solid var(--accent-2);
      box-shadow: 0 0 10px rgba(168, 85, 247, 0.4);
      z-index: 2;
    }

    /* Premium Button */
    .cta-container {
      margin-top: 3rem;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      background: var(--text-primary);
      color: var(--bg-base);
      text-decoration: none;
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
      font-size: 1.1rem;
      padding: 1.2rem 2.5rem;
      border-radius: 100px;
      transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
      position: relative;
      overflow: hidden;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(255, 255, 255, 0.15);
      background: #e4e4e7;
    }

    .btn-primary svg {
      width: 20px; height: 20px;
      transition: transform 0.3s ease;
    }

    .btn-primary:hover svg {
      transform: translateX(4px);
    }

    /* Grid Feature Cards */
    .feature-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
      opacity: 0;
      animation: slideUp 0.8s ease-out 0.4s forwards;
    }

    .card {
      background: rgba(0, 0, 0, 0.2);
      border: 1px solid var(--border);
      padding: 2.5rem;
      border-radius: 24px;
      transition: all 0.4s ease;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .card:hover {
      background: var(--surface-hover);
      border-color: var(--border-highlight);
      transform: translateY(-4px);
    }

    .card-icon {
      width: 48px;
      height: 48px;
      background: rgba(255,255,255,0.05);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent-1);
      margin-bottom: 0.5rem;
    }

    .card h3 {
      font-size: 1.25rem;
      color: var(--text-primary);
    }

    .card p {
      color: var(--text-secondary);
      font-size: 1rem;
      line-height: 1.5;
    }

    /* Animations */
    @keyframes slideUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .details-panel {
        padding: 2.5rem 1.5rem;
        border-radius: 24px;
      }
      .hero-section h1 { font-size: 3.2rem; }
      .hero-section p { font-size: 1.1rem; }
      .btn-primary { width: 100%; justify-content: center; }
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
          <a class="btn btn-primary" href="live.php">
            Launch Experience
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>
      </section>

      <section class="feature-cards">
        <article class="card">
          <div class="card-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
            </svg>
          </div>
          <h3>Spatial Tracking</h3>
          <p>Dual-hand mapping processed entirely on-device, offering zero-latency responsiveness and total privacy.</p>
        </article>

        <article class="card">
          <div class="card-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
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