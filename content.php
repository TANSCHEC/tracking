<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome - TANSCHE File Tracking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      /* Bright purple to blue gradient */
      color: #ffffff;
      font-family: 'Segoe UI', sans-serif;
    }

    .content {
      padding: 40px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.1);
      /* Slight white transparent panel */
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(10px);
      margin-top: 40px;
    }

    h2 {
      font-weight: bold;
      color: #ffea00;
      text-shadow: 2px 2px #000;
    }

    p,
    li {
      font-size: 1.1rem;
      color: #ffffff;
      text-shadow: 1px 1px #222;
    }

    ul li strong {
      color: #00ffff;
    }

    ul li em {
      color: #ff80ab;
      font-style: normal;
      font-weight: 600;
    }
  </style>
</head>

<body>
  <main class="col-md-9 ms-sm-auto col-lg-10 content container">
    <h2>
      <centre><img src="tnlogo.png" width="50px" height="50px">Welcome to TANSCHE <img src="logo.png" width="50px" height="50px"></centre>
    </h2>

    <p>This system helps monitor official file movement across TANSCHE sections: Despatch, MS Sir Office, A-Section, B-Section, VC Sir Office, and Accounts.</p>

    <ul>
      <li><strong>Generate QR:</strong> Use <em>Add Document</em> to register files and generate QR codes.</li>
      <li><strong>Track Actions:</strong> Scan the QR and log actions per section.</li>
      <li><strong>Dashboard:</strong> View movement analytics and recent actions.</li>
    </ul>
  </main>
</body>

</html>