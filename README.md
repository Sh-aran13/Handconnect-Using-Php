# Hand Connect

![Hand Connect](./screenshot.png)

A futuristic hand-tracking web experience that turns your camera into a reactive light show.

Built with **MediaPipe Hands**, **Canvas rendering**, and **Web Audio**, Hand Connect creates neon fingertip trails, energy bridges, pinch-triggered shockwaves, and live audio feedback.

---

## 🚀 Highlights

- **Real-time tracking** for one or two hands
- **Mirror-friendly live camera** with responsive overlay effects
- **Pinch detection** for gesture-driven visuals and sound
- **Neon glow mesh** and dynamic connections across fingers
- **Multi-theme visual modes** including neon, sunset, and matrix
- **Particle systems** and energy beams that respond to motion
- **FPS monitoring** and a polished HUD for live feedback

---

## 🎮 Demo

1. Open `live.php` with a local PHP server or place the project in a PHP web root.
2. Click **Dive In** to enable the camera and start tracking.
3. Show one or two hands in front of the camera.
4. Move fingers to paint the screen with particles and energy connections.
5. Bring thumb and index fingertips together to trigger pinch effects.

---

## 🛠️ Run locally with PHP

From the project root:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000/live.php
```

> If your setup serves from a specific document root, keep `index.php`, `live.php`, `script.js`, and `styles.css` together.

---

## 📁 Project Structure

- `index.php` — landing page and project overview
- `live.php` — live camera interface with tracking overlay
- `styles.css` — theme, layout, and HUD styling
- `script.js` — MediaPipe integration, rendering, gesture logic, and audio

---

## 🔧 Built with

- HTML5
- CSS3
- JavaScript (ES6)
- Php
- [MediaPipe Hands](https://developers.google.com/mediapipe)
- Canvas API
- Web Audio API

---

## 💡 Tips

- Best experienced in **Chrome**, **Edge**, or **Firefox**
- Grant camera access when prompted
- Use a clean background and good lighting for best hand detection
- If the camera looks mirrored, `live.php` is already styled to match the overlay

---

## ✨ Want to improve it?

- Add more gesture recognition patterns
- Add sound presets or custom audio layers
- Export movement trails or record sessions
- Add candidate support for mobile camera control
