@extends('layout.app')
  
@section('title', 'Dashboard - Cafe')
  
@section('contents')


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cashier Interface</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .cashier-interface {
      display: flex;
    }

    .receipt, .product-list {
      flex: 1;
      padding: 20px;
    }

    .receipt {
      background-color: #f0f0f0;
    }

    .receipt h2, .product-list h2 {
      margin-top: 0;
    }

    .total {
      margin-top: 10px;
    }

    .products {
      list-style-type: none;
      padding: 0;
    }

    .products li {
      margin-bottom: 5px;
    }

    .products li:hover {
      cursor: pointer;
      background-color: #e0e0e0;
    }

    /* New Styles for Dashboard */
    .dashboard-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .dashboard-content {
      text-align: center;
    }

    .dashboard-content h2 {
      font-size: 2.5em;
      margin-bottom: 20px;
    }

    .dashboard-content p {
      font-size: 1.2em;
    }

    .dashboard-content a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .dashboard-content a:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <div class="dashboard-content">
      <h2>Welcome to Cafe Dashboard</h2>
      <p>Manage your cafe efficiently with our powerful tools.</p>
      <a href="#">Get Started</a>
    </div>
  </div>
</body>
</html>

@endsection
