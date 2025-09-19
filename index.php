<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú de Workshops</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --bg-color: #0d1117;
      --card-color: #161b22;
      --accent: #58a6ff;
      --text-color: #c9d1d9;
      --text-muted: #8b949e;
    }

    body {
      background-color: var(--bg-color);
      color: var(--text-color);
      font-family: 'Courier New', Courier, monospace;
      padding-top: 80px;
      text-align: center;
    }

    h1 {
      color: var(--accent);
      margin-bottom: 40px;
      font-weight: bold;
    }

    .workshop-link {
      display: block;
      margin: 15px auto;
      width: 320px;
      padding: 15px;
      background-color: var(--card-color);
      color: var(--accent);
      border: 1px solid var(--accent);
      border-radius: 12px;
      font-size: 1.1rem;
      text-decoration: none;
      transition: all 0.3s ease-in-out;
    }

    .workshop-link:hover {
      background-color: var(--accent);
      color: var(--bg-color);
      transform: scale(1.05);
    }

    footer {
      margin-top: 100px;
      color: var(--text-muted);
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <h1>📁 Menú de Workshops</h1>

  <?php
    $dirs = array_filter(glob('*'), 'is_dir');
    $dirs = array_filter($dirs, function($dir) {
      return $dir != 'extra' && $dir != '.' && $dir != '..';
    });
    sort($dirs, SORT_NATURAL | SORT_FLAG_CASE);
    foreach ($dirs as $dir) {
      echo "<a class='workshop-link' href='$dir/'>💻 $dir</a>";
    }
  ?>

  <footer>
    Desarrollado por Juan Daniel Gómez • <?php echo date("Y"); ?>
  </footer>

</body>
</html>

