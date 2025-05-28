<?php
session_start();

// Contraseña correcta
define('PASSWORD_CORRECTA', 'miamor123');

if (isset($_SESSION['acceso_concedido']) && $_SESSION['acceso_concedido'] === true) {
    $acceso = true;
} else {
    $acceso = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clave = $_POST['clave'] ?? '';
    if ($clave === PASSWORD_CORRECTA) {
        $_SESSION['acceso_concedido'] = true;
        $acceso = true;
    } else {
        $error = "Contraseña incorrecta. Intenta de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Para ti, mi amor</title>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to bottom right, #ffdde1, #ee9ca7);
      background-image: url('fondo-romantico.jpg');
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
      font-family: 'Poppins', sans-serif;
      color: #3a3a3a;
      overflow-x: hidden;
      position: relative;
      min-height: 100vh;
    }
    .fade-in {
      animation: fadeInZoom 1.5s ease-out both;
    }
    @keyframes fadeInZoom {
      0% { opacity: 0; transform: scale(0.9); }
      100% { opacity: 1; transform: scale(1); }
    }
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    @keyframes typing {
      from { width: 0; }
      to { width: 100%; }
    }
    @keyframes blink-caret {
      from, to { border-color: transparent; }
      50% { border-color: #d63384; }
    }
    .welcome-screen {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: linear-gradient(to bottom right, #ffdde1, #ee9ca7);
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      z-index: 1000;
      text-align: center;
      padding: 20px;
    }
    .typewriter {
      overflow: hidden;
      border-right: 0.15em solid #d63384;
      white-space: nowrap;
      margin: 20px auto;
      letter-spacing: 0.15em;
      animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
      font-size: 1.2em;
      color: #bf296f;
      max-width: 90%;
    }
    .carousel-container {
      position: relative;
      width: 100%;
      max-width: 320px;
      margin: 30px auto 0;
      text-align: center;
    }
    .carousel-container img {
      width: 320px;
      height: 418px;
      object-fit: cover;
      border-radius: 15px;
      display: none;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      transform-style: preserve-3d;
    }
    .carousel-container img.active {
      display: block;
    }
    .carousel-container img:hover {
      transform: rotateY(5deg) scale(1.02);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
    .carousel-buttons {
      margin-top: 10px;
      display: flex;
      justify-content: center;
      gap: 15px;
    }
    .carousel-buttons button {
      background: #f0f0f3;
      border-radius: 50%;
      border: none;
      width: 50px;
      height: 50px;
      font-size: 1.5em;
      font-weight: bold;
      color: #d63384;
      box-shadow: 6px 6px 10px #d1d1d1, -6px -6px 10px #ffffff;
      transition: all 0.3s ease;
      cursor: pointer;
    }
    .carousel-buttons button:hover {
      box-shadow: inset 4px 4px 8px #d1d1d1, inset -4px -4px 8px #ffffff;
      background-color: #ffe6f0;
      color: #bf296f;
      transform: scale(1.1);
    }
    .welcome-screen button {
      background-color: #d63384;
      color: white;
      border: none;
      padding: 20px 40px;
      border-radius: 20px;
      font-size: 1.3em;
      cursor: pointer;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      animation: pulse 2s infinite;
      margin-top: 20px;
    }
    .welcome-screen button:hover {
      background-color: #bf296f;
    }
    .container {
      max-width: 800px;
      margin: 120px auto 50px;
      background: linear-gradient(135deg, #ffe6f0, #f7c8d6);
      padding: 40px 20px;
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(214, 51, 132, 0.4);
      animation: fadeIn 2s ease;
      display: none;
      color: #4a2e42;
      position: relative;
      z-index: 1;
    }
    h1 {
      font-family: 'Great Vibes', cursive;
      font-size: 2.5em;
      color: #d63384;
      text-align: center;
      margin-bottom: 25px;
    }
    p {
      font-size: 1.15em;
      line-height: 1.8;
      color: #4a2e42;
      margin-bottom: 20px;
    }
    em {
      color: #bf4080;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .floating-love {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 2em;
      color: #d63384;
      font-family: 'Great Vibes', cursive;
      animation: float 4s ease-in-out infinite;
      z-index: 2;
      pointer-events: none;
      opacity: 0.8;
    }
    @keyframes float {
      0% { transform: translate(-50%, 0); }
      50% { transform: translate(-50%, -20px); }
      100% { transform: translate(-50%, 0); }
    }
    @media screen and (max-width: 600px) {
      .container {
        margin: 100px 10px 40px;
        padding: 30px 15px;
      }
      h1 {
        font-size: 2em;
      }
      .carousel-buttons button {
        width: 40px;
        height: 40px;
        font-size: 1.2em;
      }
    }
    /* Estilos para formulario de contraseña */
    .login-container {
      max-width: 400px;
      margin: 150px auto;
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(214, 51, 132, 0.4);
      text-align: center;
    }
    input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      margin-top: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1em;
    }
    button.submit-pass {
      margin-top: 20px;
      background-color: #d63384;
      color: white;
      border: none;
      padding: 15px 30px;
      font-size: 1.2em;
      border-radius: 20px;
      cursor: pointer;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      transition: background-color 0.3s ease;
    }
    button.submit-pass:hover {
      background-color: #bf296f;
    }
    .error {
      color: red;
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<?php if (!$acceso): ?>
  <div class="login-container">
    <h2>Esta página está protegida 🔒</h2>
    <form method="post" action="">
      <input type="password" name="clave" placeholder="Ingresa la contraseña" required autofocus />
      <button type="submit" class="submit-pass">Ingresar</button>
    </form>
    <?php if (!empty($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
  </div>
<?php else: ?>

  <div class="welcome-screen" id="welcomeScreen">
    <h1 class="fade-in">💖 Para ti, mi amor</h1>
    <p class="typewriter">"Eres la casualidad más bonita que llegó a mi vida..."</p>
    <button onclick="showContent()">Mostrar sorpresa</button>
    <div class="carousel-container" id="carousel" style="display:none;">
      <img src="IMAGEN1.jpeg" alt="IMAGEN1" class="active" />
      <img src="IMAGEN2.jpeg" alt="IMAGEN2" />
      <img src="IMAGEN3.jpeg." alt="IMAGEN3" />
      <img src="IMAGEN4.jpeg" alt="IMAGEN4" />
      <img src="IMAGEN5.jpeg" alt="IMAGEN5" />
      <img src="IMAGEN6.jpeg" alt="IMAGEN6" />
      <img src="IMAGEN7.jpeg" alt="IMAGEN7" />
      <img src="IMAGEN8.jpeg" alt="IMAGEN8" />
      <img src="IMAGEN9.jpeg" alt="IMAGEN9" />
      <img src="IMAGEN10.jpeg" alt="IMAGEN10" />
      <img src="IMAGEN11.jpeg" alt="IMAGEN11" />
      <img src="IMAGEN12.jpeg" alt="IMAGEN12" />
      <img src="IMAGEN13.jpeg" alt="IMAGEN13" />
      <img src="IMAGEN14.jpeg" alt="IMAGEN14" />
    </div>
    <div class="carousel-buttons" id="carouselButtons" style="display:none;">
      <button onclick="prevImage()">❮</button>
      <button onclick="nextImage()">❯</button>
    </div>
  </div>

  <div class="container" id="content" style="display:none;">
    <h1>💖 Para ti, mi amor</h1>
    <p>Hoy no solo celebro el día en que naciste, sino también todo el tiempo que hemos construido juntos...</p>
    <p>Desde que llegaste a mi vida, <em>todo tiene más color y sentido.</em> Eres mi musa, mi alegría y mi paz.</p>
    <p>Gracias por cada risa, cada abrazo y cada momento compartido. Eres lo mejor que me ha pasado.</p>
    <p>Que este día sea tan especial como tú. Te amo con todo mi corazón.</p>
    <audio controls style="width: 100%; margin-top: 30px;" preload="auto">
      <source src="te-amo-franco-de-vita.mp3" type="audio/mpeg">
      Tu navegador no soporta audio.
    </audio>
  </div>

  <div class="floating-love">💕</div>

  <script>
    // Carrusel simple
    const images = document.querySelectorAll('#carousel img');
    let currentIndex = 0;

    function showImage(index) {
      images.forEach((img, i) => {
        img.classList.toggle('active', i === index);
      });
    }

    function nextImage() {
      currentIndex = (currentIndex + 1) % images.length;
      showImage(currentIndex);
    }

    function prevImage() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      showImage(currentIndex);
    }

    // Mostrar contenido al hacer click en botón
    function showContent() {
      document.getElementById('welcomeScreen').style.display = 'none';
      document.getElementById('content').style.display = 'block';
      document.getElementById('carousel').style.display = 'block';
      document.getElementById('carouselButtons').style.display = 'flex';
    }
  </script>

<?php endif; ?>

</body>
</html>



