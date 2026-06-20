const videoElement = document.getElementById('inputVideo');
const canvasElement = document.getElementById('outputCanvas');
const canvasCtx = canvasElement.getContext('2d');
const startButton = document.getElementById('startButton');
const fpsValue = document.getElementById('fpsValue');
const statusText = document.getElementById('statusText');
const gestureValue = document.getElementById('gestureValue');
const themeSelect = document.getElementById('themeSelect');

let canvasWidth = 1280;
let canvasHeight = 720;
let lastFrameTime = performance.now();
let frameCount = 0;
let fps = 0;
let currentTheme = 'neon';
let handsDetected = 0;
let lastGesture = 'Waiting';

// Refined Themes
const themes = {
  neon: {
    primary: '#00f2fe',
    secondary: '#4facfe',
    matrixColor: '#00f2fe'
  },
  sunset: {
    primary: '#ff0844',
    secondary: '#ffb199',
    matrixColor: '#ff0844'
  },
  matrix: {
    primary: '#00ff95',
    secondary: '#1affd8',
    matrixColor: '#33ff66'
  }
};

let audioContext, masterGain, oscillator, filter, noiseSource, energyGain;
let isAudioStarted = false;

const particles = [];
const matrixLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789#$%&*+<>?';
const matrixDrops = Array.from({ length: 80 }, () => ({ x: Math.random() * canvasWidth, y: Math.random() * canvasHeight, speed: Math.random() * 3 + 2 }));

// --- Audio Setup ---
function setupAudio() {
  audioContext = new (window.AudioContext || window.webkitAudioContext)();
  masterGain = audioContext.createGain();
  filter = audioContext.createBiquadFilter();
  energyGain = audioContext.createGain();
  
  masterGain.gain.value = 0.02;
  filter.type = 'lowpass';
  filter.frequency.value = 900;
  energyGain.gain.value = 0;
  
  oscillator = audioContext.createOscillator();
  oscillator.type = 'sine';
  oscillator.frequency.value = 140;
  
  oscillator.connect(filter);
  filter.connect(masterGain);
  energyGain.connect(masterGain);
  masterGain.connect(audioContext.destination);
  oscillator.start();

  const bufferSize = 2 * audioContext.sampleRate;
  const noiseBuffer = audioContext.createBuffer(1, bufferSize, audioContext.sampleRate);
  const data = noiseBuffer.getChannelData(0);
  for (let i = 0; i < bufferSize; i++) data[i] = (Math.random() * 2 - 1) * 0.12;
  
  noiseSource = audioContext.createBufferSource();
  noiseSource.buffer = noiseBuffer;
  noiseSource.loop = true;
  noiseSource.connect(energyGain);
  noiseSource.start();
}

function resumeAudio() {
  if (!audioContext) setupAudio();
  if (audioContext.state === 'suspended') audioContext.resume();
  isAudioStarted = true;
}

// --- Visual Effects ---
function createParticle(x, y, hue, size) {
  particles.push({
    x, y,
    vx: (Math.random() - 0.5) * 6,
    vy: (Math.random() - 0.5) * 6,
    alpha: 1,
    size: size || Math.random() * 5 + 2,
    hue,
    life: 40 + Math.random() * 25
  });
}

function updateParticles() {
  for (let i = particles.length - 1; i >= 0; i--) {
    const p = particles[i];
    p.x += p.vx;
    p.y += p.vy;
    p.vy += 0.08; // Gravity effect
    p.alpha -= 0.025;
    p.life -= 1;
    if (p.alpha <= 0 || p.life <= 0) {
      particles.splice(i, 1);
      continue;
    }
    const gradient = canvasCtx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.size * 2);
    gradient.addColorStop(0, `hsla(${p.hue}, 100%, 75%, ${p.alpha})`);
    gradient.addColorStop(1, 'rgba(0,0,0,0)');
    canvasCtx.fillStyle = gradient;
    canvasCtx.beginPath();
    canvasCtx.arc(p.x, p.y, p.size * 2, 0, Math.PI * 2);
    canvasCtx.fill();
  }
}

function drawMatrixBackground(theme) {
  // Only draws the text overlay, keeping the background transparent for the camera
  canvasCtx.font = '16px monospace';
  canvasCtx.fillStyle = theme.matrixColor;
  canvasCtx.globalAlpha = 0.6;
  matrixDrops.forEach((drop) => {
    const char = matrixLetters.charAt(Math.floor(Math.random() * matrixLetters.length));
    canvasCtx.fillText(char, drop.x, drop.y);
    drop.y += drop.speed;
    if (drop.y > canvasHeight) {
      drop.y = -20;
      drop.x = Math.random() * canvasWidth;
      drop.speed = Math.random() * 3 + 2;
    }
  });
  canvasCtx.globalAlpha = 1;
}

// --- Hand Rendering Components ---

function drawCyberBones(landmarks, hue) {
  const fingers = [
    [0, 1, 2, 3, 4],    // Thumb
    [0, 5, 6, 7, 8],    // Index
    [9, 10, 11, 12],    // Middle
    [13, 14, 15, 16],   // Ring
    [17, 18, 19, 20],   // Pinky
    [0, 5, 9, 13, 17, 0] // Palm base
  ];

  canvasCtx.lineCap = 'round';
  canvasCtx.lineJoin = 'round';

  fingers.forEach((boneChain) => {
    // Outer Glow
    canvasCtx.beginPath();
    boneChain.forEach((index, i) => {
      const { x, y } = landmarks[index];
      if (i === 0) canvasCtx.moveTo(x, y);
      else canvasCtx.lineTo(x, y);
    });
    canvasCtx.strokeStyle = `hsla(${hue}, 100%, 60%, 0.3)`;
    canvasCtx.lineWidth = 8;
    canvasCtx.shadowColor = `hsla(${hue}, 100%, 70%, 0.8)`;
    canvasCtx.shadowBlur = 15;
    canvasCtx.stroke();

    // Inner Core Beam
    canvasCtx.beginPath();
    boneChain.forEach((index, i) => {
      const { x, y } = landmarks[index];
      if (i === 0) canvasCtx.moveTo(x, y);
      else canvasCtx.lineTo(x, y);
    });
    canvasCtx.strokeStyle = '#ffffff';
    canvasCtx.lineWidth = 2;
    canvasCtx.shadowBlur = 0;
    canvasCtx.stroke();
  });
}

function drawCyberJoints(landmarks, hue) {
  landmarks.forEach((point, index) => {
    if ([4, 8, 12, 16, 20].includes(index)) return; // Skip tips
    canvasCtx.beginPath();
    canvasCtx.arc(point.x, point.y, 4, 0, 2 * Math.PI);
    canvasCtx.fillStyle = '#050505';
    canvasCtx.fill();
    canvasCtx.lineWidth = 2;
    canvasCtx.strokeStyle = `hsla(${hue}, 100%, 70%, 0.8)`;
    canvasCtx.stroke();
  });
}

function drawPointerTips(landmarks, hue) {
  const fingertips = [4, 8, 12, 16, 20];
  const time = performance.now() * 0.005;

  fingertips.forEach((tipIndex) => {
    const { x, y } = landmarks[tipIndex];
    
    // Pulsing outer aura
    const pulseRadius = 12 + Math.sin(time + tipIndex) * 4;
    canvasCtx.beginPath();
    canvasCtx.arc(x, y, pulseRadius, 0, 2 * Math.PI);
    canvasCtx.fillStyle = `hsla(${hue}, 100%, 75%, 0.2)`;
    canvasCtx.fill();

    // Crosshair
    canvasCtx.strokeStyle = `hsla(${hue}, 100%, 85%, 0.9)`;
    canvasCtx.lineWidth = 2;
    canvasCtx.beginPath();
    canvasCtx.moveTo(x - 8, y); canvasCtx.lineTo(x + 8, y);
    canvasCtx.moveTo(x, y - 8); canvasCtx.lineTo(x, y + 8);
    canvasCtx.stroke();

    // Core
    canvasCtx.beginPath();
    canvasCtx.arc(x, y, 3, 0, 2 * Math.PI);
    canvasCtx.fillStyle = '#ffffff';
    canvasCtx.shadowColor = `hsla(${hue}, 100%, 80%, 1)`;
    canvasCtx.shadowBlur = 10;
    canvasCtx.fill();
    canvasCtx.shadowBlur = 0;
  });
}

// Used for Pinches (Straight dashed laser)
function drawEnergyBeams(landmarkA, landmarkB, hue) {
  canvasCtx.strokeStyle = `hsla(${hue}, 100%, 70%, 0.8)`;
  canvasCtx.lineWidth = 3;
  canvasCtx.shadowColor = `hsla(${hue}, 100%, 80%, 0.9)`;
  canvasCtx.shadowBlur = 15;
  
  canvasCtx.beginPath();
  canvasCtx.setLineDash([10, 15]);
  canvasCtx.moveTo(landmarkA.x, landmarkA.y);
  canvasCtx.lineTo(landmarkB.x, landmarkB.y);
  canvasCtx.stroke();
  canvasCtx.setLineDash([]);
  canvasCtx.shadowBlur = 0;
}

// Used for Hand-to-Hand Connections (Wavy Electric Plasma)
function drawElectricBeam(p1, p2, hue) {
  const dx = p2.x - p1.x;
  const dy = p2.y - p1.y;
  const dist = Math.hypot(dx, dy);
  
  if (dist < 20) return; // Don't draw if hands are overlapping

  const segments = Math.max(5, Math.floor(dist / 15));
  const time = performance.now() * 0.015;
  
  canvasCtx.beginPath();
  canvasCtx.moveTo(p1.x, p1.y);

  for (let i = 1; i < segments; i++) {
    const t = i / segments;
    const midX = p1.x + dx * t;
    const midY = p1.y + dy * t;
    
    // Add perpendicular wavy noise to make it look like electricity
    const waveAmp = Math.sin(t * Math.PI) * 15; // Max wave in the middle
    const wave = Math.sin(t * 10 - time) * waveAmp; 
    const perpX = (-dy / dist) * wave;
    const perpY = (dx / dist) * wave;

    canvasCtx.lineTo(midX + perpX, midY + perpY);
  }
  canvasCtx.lineTo(p2.x, p2.y);

  // Styling the lightning
  canvasCtx.strokeStyle = `hsla(${hue}, 100%, 75%, 0.8)`;
  canvasCtx.lineWidth = 2 + Math.random() * 2; // Flicker width
  canvasCtx.shadowColor = `hsla(${hue}, 100%, 85%, 1)`;
  canvasCtx.shadowBlur = 20;
  canvasCtx.stroke();
  canvasCtx.shadowBlur = 0;

  // Emit occasional sparks from the beam
  if (Math.random() > 0.85) {
    const t = Math.random();
    createParticle(p1.x + dx * t, p1.y + dy * t, hue, 1 + Math.random() * 3);
  }
}

// --- Main Render Loop ---
function normalizeLandmarks(rawLandmarks) {
  return rawLandmarks.map(l => ({ x: l.x * canvasWidth, y: l.y * canvasHeight, z: l.z }));
}

function setStatus(text) { statusText.textContent = text; }
function displayGesture(name) {
  lastGesture = name;
  gestureValue.textContent = `Gesture: ${name}`;
}
function clamp(value, min, max) { return Math.min(Math.max(value, min), max); }

function renderHands(results) {
  // 1. FADE PREVIOUS FRAME TO TRANSPARENT (Motion Blur over Live Camera)
  canvasCtx.globalCompositeOperation = 'destination-out';
  canvasCtx.fillStyle = 'rgba(0, 0, 0, 0.35)'; // Higher alpha = shorter trails
  canvasCtx.fillRect(0, 0, canvasWidth, canvasHeight);
  
  // 2. RESET TO NORMAL DRAWING MODE
  canvasCtx.globalCompositeOperation = 'source-over';

  const theme = themes[currentTheme];
  
  if (currentTheme === 'matrix') {
    drawMatrixBackground(theme);
  } 

  if (!results.multiHandLandmarks || results.multiHandLandmarks.length === 0) {
    setStatus('Point your hand(s) to the camera.');
    displayGesture('No hands');
    updateParticles();
    return;
  }

  const normalizedHands = results.multiHandLandmarks.map(normalizeLandmarks);
  const handednessArr = (results.multiHandedness || []).map(h => (h.label || h.className || 'Unknown'));
  
  handsDetected = normalizedHands.length;
  setStatus(`Tracking ${handsDetected} hand${handsDetected > 1 ? 's' : ''}`);

  const averageMove = { x: 0, y: 0 };

  // Draw Individual Hands
  normalizedHands.forEach((landmarks, handIndex) => {
    const label = handednessArr[handIndex] || `Hand${handIndex}`;
    const hue = label.toLowerCase().includes('left') ? 190 : 320; 

    drawCyberBones(landmarks, hue);
    drawCyberJoints(landmarks, hue);
    drawPointerTips(landmarks, hue);

    // Pinch Detection
    const thumbTip = landmarks[4];
    const indexTip = landmarks[8];
    const pinchDist = Math.hypot(thumbTip.x - indexTip.x, thumbTip.y - indexTip.y);
    const pinchThreshold = Math.min(canvasWidth, canvasHeight) * 0.08;

    if (pinchDist < pinchThreshold) {
      drawEnergyBeams(thumbTip, indexTip, hue); 
      displayGesture('Pinch');
      if (energyGain) {
        energyGain.gain.setTargetAtTime(0.45, audioContext.currentTime, 0.02);
        setTimeout(() => energyGain.gain.setTargetAtTime(0, audioContext.currentTime, 0.06), 120);
      }
    } else {
      const handOpenness = landmarks[8].y < landmarks[6].y && landmarks[12].y < landmarks[10].y;
      if (handOpenness) displayGesture('Open Hand');
    }

    // Motion calc
    let moveX = 0, moveY = 0;
    for (let i = 0; i < landmarks.length; i++) {
      moveX += landmarks[i].x; moveY += landmarks[i].y;
    }
    averageMove.x += moveX / landmarks.length;
    averageMove.y += moveY / landmarks.length;
  });

  // Finger-to-Finger connections between two hands
  if (normalizedHands.length >= 2) {
    const hand1 = normalizedHands[0];
    const hand2 = normalizedHands[1];
    const fingertips = [4, 8, 12, 16, 20];
    const time = performance.now();

    fingertips.forEach((tipIndex, i) => {
      const pt1 = hand1[tipIndex];
      const pt2 = hand2[tipIndex];
      
      const bridgeHue = (time * 0.05 + i * 40) % 360; 
      drawElectricBeam(pt1, pt2, bridgeHue);
    });
  }

  updateParticles();

  // Audio modulation
  if (oscillator && filter && masterGain) {
    const motionIntensity = clamp(Math.abs(averageMove.x) + Math.abs(averageMove.y), 0, 5);
    oscillator.frequency.setTargetAtTime(120 + motionIntensity * 60, audioContext.currentTime, 0.08);
    filter.frequency.setTargetAtTime(800 + motionIntensity * 520, audioContext.currentTime, 0.08);
    masterGain.gain.setTargetAtTime(0.02 + motionIntensity * 0.01, audioContext.currentTime, 0.08);
  }
}

function onResults(results) {
  renderHands(results);
  const now = performance.now();
  frameCount += 1;
  if (now - lastFrameTime >= 1000) {
    fps = Math.round((frameCount * 1000) / (now - lastFrameTime));
    fpsValue.textContent = `FPS: ${fps}`;
    frameCount = 0;
    lastFrameTime = now;
  }
}

function resizeCanvas() {
  const rect = canvasElement.getBoundingClientRect();
  canvasWidth = rect.width;
  canvasHeight = rect.height;
  canvasElement.width = rect.width * window.devicePixelRatio;
  canvasElement.height = rect.height * window.devicePixelRatio;
  canvasCtx.setTransform(window.devicePixelRatio, 0, 0, window.devicePixelRatio, 0, 0);
}

function startHandTracking() {
  if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
    setStatus('Camera not available.');
    return;
  }
  resumeAudio();
  setStatus('Initializing...');

  const hands = new Hands({ locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}` });
  hands.setOptions({
    maxNumHands: 2,
    modelComplexity: 1,
    minDetectionConfidence: 0.75,
    minTrackingConfidence: 0.65
  });
  hands.onResults(onResults);

  const camera = new Camera(videoElement, {
    onFrame: async () => { await hands.send({ image: videoElement }); },
    width: 1280,
    height: 720
  });
  
  camera.start()
    .then(() => setStatus('Camera active.'))
    .catch((error) => {
      setStatus('Camera access denied.');
      console.error(error);
    });
}

// Event Listeners
if (startButton) {
  startButton.addEventListener('click', () => {
    startButton.disabled = true;
    startButton.textContent = 'Connecting...';
    startHandTracking();
    setTimeout(() => startButton.textContent = 'Connected', 700);
  });
}

if (themeSelect) {
  themeSelect.addEventListener('change', (e) => currentTheme = e.target.value);
  themeSelect.style.display = 'inline-block'; 
}

window.addEventListener('resize', resizeCanvas);
resizeCanvas();