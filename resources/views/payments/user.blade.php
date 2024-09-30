<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Payment</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif; /* Consistent font */
            background-color: #1a1a2e; /* Dark background */
            margin: 0;
            padding: 0;
            height: 100vh; /* Full height */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Modal Background */
        .modal-background {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Black with opacity */
            justify-content: center;
            align-items: center;
        }

        /* Modal Content Box */
        .modal-content {
            background: #121212; /* Dark background for the modal */
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px; /* Set a fixed width */
            position: relative;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
            text-align: center; /* Center content */
        }

        /* Close Button */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            color: white; /* Close button color */
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 30px;
            position: relative;
        }

        .form-group label {
            color: white; /* Label color */
            font-size: 14px;
            position: absolute;
            top: -20px;
            left: 0;
            transition: 0.3s;
        }

        /* Input field styling */
        .form-control {
            width: 100%;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.1); /* Light background for input */
            border: 2px solid #007bff; /* Blue border */
            border-radius: 5px;
            color: #fff; /* Input text color */
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #00c6ff; /* Bright blue when focused */
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7); /* Lighter placeholder color */
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff; /* Button color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%; /* Full width button */
        }

        .btn:hover {
            background-color: #0056b3; /* Darker on hover */
        }

        /* Neon border effect */
        .modal-content:before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #00c6ff, #0072ff, #007bff, #ff00ff);
            z-index: -1;
            filter: blur(10px);
            border-radius: 15px;
        }

        /* Error message style */
        .error-message {
            color: #fff; /* White color for error messages */
            font-size: 0.875rem; /* Slightly smaller font for error messages */
            margin-top: 8px;
        }
    </style>
</head>
<body>

    <!-- Trigger to open the modal -->
    <button class="open-modal-btn" onclick="openModal()">Make Payment</button>

    <!-- Modal Background -->
    <div id="paymentModal" class="modal-background">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            
            <!-- Payment Form -->
            <form action="{{ route('pay') }}" method="POST" id="paymentForm">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="amount">Amount (in GHS)</label>
                    <input type="number" name="amount" id="amount" class="form-control" required placeholder="Amount">
                </div>
                <button type="submit" class="btn">Make Payment</button>
            </form>
        </div>
    </div>

    <script>
        // Open modal
        function openModal() {
            document.getElementById('paymentModal').style.display = 'flex';
        }

        // Close modal
        function closeModal() {
            document.getElementById('paymentModal').style.display = 'none';
        }

        // Close modal if the background is clicked
        window.onclick = function(event) {
            if (event.target == document.getElementById('paymentModal')) {
                closeModal();
            }
        }

        // Automatically open the modal when the page loads
        window.onload = function() {
            openModal();
        }
    </script>

</body>
</html>
