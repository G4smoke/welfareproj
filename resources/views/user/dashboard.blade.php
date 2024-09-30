<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212; /* Dark background */
            color: #ffffff; /* White text */
        }

        .container {
            display: flex;
            flex-direction: row;
            height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 20%;
            background-color: #1c1c1c; /* Dark sidebar background */
            padding: 40px 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5); /* Darker shadow */
            position: relative;
        }

        .sidebar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 20px;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .sidebar h3 {
            margin-top: 80px; /* Space for profile picture */
            color: #ffffff; /* White text for header */
        }

        .sidebar h3 a {
            color: #ffffff;
            text-decoration: none;
        }

        .sidebar ul {
            list-style: none;
            margin-top: 20px;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            display: inline-block;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #3498db;
            border-radius: 10px;
        }

        /* Main Content Styles */
        .main-content {
            flex-grow: 1;
            padding: 40px;
            background-color: #1c1c1c; /* Dark background for the main content */
            overflow-y: auto;
        }

        /* Welcome Section */
        .welcome {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px; /* Reduced margin */
        }

        .welcome h2 {
            font-size: 36px;
            color: #3498db; /* Neon blue for headings */
            margin-top: 20px;
        }

        /* Profile Section */
        .profile {
            position: relative;
            margin-left: auto;
        }

        .profile button {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 18px;
            cursor: pointer;
        }

        /* Logout Dropdown Styles */
        .logout-dropdown {
            position: absolute;
            top: 40px;
            right: 0;
            display: none;
            background-color: #1c1c1c;
            border: 1px solid #3498db; /* Neon border */
            border-radius: 5px;
            z-index: 10;
        }

        .logout-dropdown a {
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            color: #ffffff;
        }

        .logout-dropdown a:hover {
            background-color: #3498db;
            color: white;
        }

        .profile:hover .logout-dropdown,
        .profile:focus-within .logout-dropdown {
            display: block;
        }

        /* Summary Section */
        .summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .summary-card {
            background-color: #1a1a1a; /* Dark card background */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .summary-card h3 {
            color: #3498db; /* Neon blue */
            font-size: 24px;
            margin-bottom: 20px;
        }

        .summary-card p {
            font-size: 18px;
            color: #bbbbbb; /* Light gray for text */
        }

        .summary-card span {
            font-weight: bold;
            color: #3498db;
        }

        /* Styled Button for Number Owing */
        .owing-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: #fff;
            text-decoration: none;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .owing-btn:hover {
            background-color: #c0392b;
        }

        /* Payment Record Table */
        .payment-record {
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .payment-record h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #3498db;
        }

        .payment-record table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .payment-record table th, 
        .payment-record table td {
            border-bottom: 1px solid #3498db;
            padding: 15px;
            text-align: left;
            font-size: 16px;
            color: #ffffff;
        }

        .payment-record table th {
            background-color: #1c1c1c;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="{{ auth()->user()->profile_picture ?? 'https://via.placeholder.com/50' }}" alt="Profile Picture">
            <h3><a href="{{ route('user.dashboard') }}">Dashboard</a></h3>
            <ul>
                <li><a href="{{ route('make.payment') }}">Make Payment</a></li>
                <li><a href="{{ route('payment.user') }}">Payment History</a></li>
                <!-- Removed Payment Record link -->
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Section -->
            <div class="welcome">
                <h2>Welcome to your Dashboard</h2>
                <!-- Profile Section -->
                <div class="profile">
                    <button>{{ auth()->user()->name }}</button>
                    <div class="logout-dropdown">
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </form>
                    </div>
                </div>  
            </div>

            <!-- Summary Section -->
            <!-- Summary Section -->
            <div class="summary">
    <div class="summary-card">
        <h3>Total Amount Paid</h3>
        <p>Monthly: <span>₵{{ number_format($monthlyPaid, 2) }}</span></p>
        <p>Total: <span>₵{{ number_format($totalPaid, 2) }}</span></p>
    </div>
    <div class="summary-card">
        <h3>Pending Payments</h3>
        <p>Amount Owing: <span>₵{{ number_format($amountOwing, 2) }}</span></p>
        <p>Next Payment Due: <span>{{ $nextPaymentDate->format('Y-m-d') }}</span></p> <!-- Format date as needed -->
    </div>
</div>

        </div>
    </div>
</body>
</html>
