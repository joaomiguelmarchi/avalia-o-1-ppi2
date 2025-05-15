<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #6e8efb, #a777e3);
      min-height: 100vh;
      padding: 40px 20px;
    }

    .dashboard-container {
      max-width: 1000px;
      margin: 0 auto;
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .dashboard-header h2 {
      color: #333;
    }

    .dashboard-buttons button {
      padding: 10px 16px;
      margin-left: 10px;
      border: none;
      border-radius: 8px;
      background-color: #6e8efb;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .dashboard-buttons button:hover {
      background-color: #5a7bfa;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      color: #333;
    }

    th {
      background-color: #f4f4f4;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    @media (max-width: 768px) {
      .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
      }

      .dashboard-buttons {
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <div class="dashboard-header">
      <h2>Olá, João Miguel 👋</h2>
      <div class="dashboard-buttons">
        <button href="../cadastro.php">Cadastrar Usuário</button>
        <button>Logout</button>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php

        include 'Usuario.php';

        foreach (Usuario::getAll() as $u) {
          echo("<tr><td>" . $u->nome . "</td><td>" . $u->email . "</td></tr>");
        }

        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
