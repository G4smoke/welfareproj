<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
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
        }

        .sidebar h3 a {
            color: #ffffff; /* White text for header */
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

        /* Payment History Table */
        .payment-history {
            background-color: #fff; /* White background for the payment history section */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Light shadow for the card */
        }

        .payment-history h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #2c3e50; /* Darker text color for contrast */
        }

        .payment-history table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .payment-history table th, .payment-history table td {
            border-bottom: 1px solid #eaeaea;
            padding: 15px;
            text-align: left;
            font-size: 16px;
            color: #2c3e50; /* Dark text for the table */
        }

        .payment-history table th {
            background-color: #f4f6f8; /* Light gray for header background */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="{{ $admin->profile_picture ?? 'https://via.placeholder.com/50' }}" alt="Profile Picture">
            <h3><a href="{{ route('user.dashboard') }}">Dashboard</a></h3>
            <ul>
                <li><a href="{{ route('make.payment') }}">Make Payment</a></li>
                <li><a href="{{ route('payment.user') }}">Payment History</a></li>
                <!-- Add other links as needed -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Section -->
            <div class="welcome">
                <h2>Your Payment History</h2>
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

            <!-- Payment History -->
            <div class="payment-history">
                <h3>Your Payment History</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Payment Date</th>
                            <th>Amount Paid</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_date }}</td>
                            <td>₵{{ $payment->amount_paid }}</td>
                            <td>{{ $payment->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
