<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            overflow: hidden; /* Prevent overflow in smaller screens */
        }

        /* Sidebar Styles */
        .sidebar {
            width: 20%;
            background-color: #1c1c1c; /* Dark sidebar background */
            padding: 40px 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5); /* Darker shadow */
            position: relative;
            min-width: 250px; /* Ensure a minimum width */
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

        /* Payment Record Table */
        .payment-record {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow-x: auto; /* Enable horizontal scrolling */
        }

        .payment-record h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #2c3e50;
        }

        .payment-record table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .payment-record table th, .payment-record table td {
            border-bottom: 1px solid #eaeaea;
            padding: 15px;
            text-align: left;
            font-size: 16px;
            color: #2c3e50;
        }

        .payment-record table th {
            background-color: #f4f6f8;
        }

        /* Ensure table is responsive */
        .payment-record table td, .payment-record table th {
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                padding: 20px;
            }

            .main-content {
                padding: 20px;
            }

            .welcome h2 {
                font-size: 28px;
            }
        }

        /* Styled Button for Exporting */
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="{{ $admin->profile_picture ?? 'https://via.placeholder.com/50' }}" alt="Profile Picture">
            <h3><a href="{{ route('admin.dashboard') }}">Dashboard</a></h3>
            <ul>
                <li><a href="{{ route('make.payment') }}">Make Payment</a></li>
                <li><a href="{{ route('payment.admin') }}">Payment History</a></li>
                <li><a href="{{ route('admin.record') }}">Payment Record</a></li>
                <!-- Add other links as needed -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Section -->
            <div class="welcome">
                <h2>Payment Records for all users</h2>
                <!-- Profile Section -->
                <div class="profile">
                    <button>{{ $admin->name }}</button>
                    <div class="logout-dropdown">
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Payment Record -->
            <div class="payment-record">
                <h3>Payment Record</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Payment Status</th>
                            <th>Payment Date</th>
                            <th>Amount Paid</th>
                            <th>Amount Owing</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->user->name }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>₵{{ $payment->amount_paid }}</td>
                            <td>₵{{ number_format($payment->user->amountOwing(), 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('payments.export') }}" class="owing-btn">Download as Excel</a>
        </div>
    </div>
</body>
</html>
