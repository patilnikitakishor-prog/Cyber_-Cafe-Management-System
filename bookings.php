<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_booking'])) {
        $person_id = $_POST['person_id'];
        $computer_id = $_POST['computer_id'];
        $start_time = $_POST['start_time'];

        // Update computer status
        $conn->query("UPDATE computers SET status='occupied' WHERE id=$computer_id");

        // Create booking
        $sql = "INSERT INTO bookings (person_id, computer_id, start_time, status) 
                VALUES ($person_id, $computer_id, '$start_time', 'active')";
        
        if ($conn->query($sql)) {
            $_SESSION['success'] = "Booking created successfully!";
        } else {
            $_SESSION['error'] = "Error: " . $conn->error;
        }
    }

    if (isset($_POST['end_booking'])) {
        $booking_id = $_POST['booking_id'];
        $end_time = $_POST['end_time'];
        $amount = $_POST['amount_paid'];

        $booking = $conn->query("SELECT * FROM bookings WHERE id=$booking_id")->fetch_assoc();
        $computer_id = $booking['computer_id'];

        // Calculate hours
        $start = strtotime($booking['start_time']);
        $end = strtotime($end_time);
        $hours = round(($end - $start) / 3600, 2);

        $sql = "UPDATE bookings SET end_time='$end_time', hours_used=$hours, amount_paid=$amount, status='completed' WHERE id=$booking_id";
        
        if ($conn->query($sql)) {
            $conn->query("UPDATE computers SET status='available' WHERE id=$computer_id");
            $_SESSION['success'] = "Booking completed! Amount received: ₹$amount";
        }
    }
}

$active_bookings = $conn->query("SELECT b.*, p.name as person_name, c.computer_name, c.hourly_rate 
                                  FROM bookings b 
                                  JOIN persons p ON b.person_id = p.id 
                                  JOIN computers c ON b.computer_id = c.id 
                                  WHERE b.status='active' ORDER BY b.start_time DESC");

$completed_bookings = $conn->query("SELECT b.*, p.name as person_name, c.computer_name 
                                     FROM bookings b 
                                     JOIN persons p ON b.person_id = p.id 
                                     JOIN computers c ON b.computer_id = c.id 
                                     WHERE b.status='completed' ORDER BY b.end_time DESC LIMIT 20");

$persons = $conn->query("SELECT * FROM persons ORDER BY name");
$computers = $conn->query("SELECT * FROM computers WHERE status='available' ORDER BY computer_name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Cyber Cafe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            color: white;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .back-btn {
            padding: 10px 20px;
            background: white;
            color: #38f9d7;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .card h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.95em;
            font-family: inherit;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #38f9d7;
        }

        .btn {
            padding: 12px 25px;
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 233, 123, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            animation: slideDown 0.3s ease-out;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        tr:hover {
            background: #f0fff9;
        }

        .time-display {
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 0.9em;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📅 Manage Bookings</h1>
            <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back</a>
        </div>

        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> ' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> ' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <!-- Create Booking Form -->
        <div class="card">
            <h2>➕ Create New Booking</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="person_id">Select Person *</label>
                        <select id="person_id" name="person_id" required>
                            <option value="">-- Choose Person --</option>
                            <?php 
                            $persons->data_seek(0);
                            while ($row = $persons->fetch_assoc()) { 
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . ' (' . $row['phone'] . ')</option>';
                            } 
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="computer_id">Select Computer *</label>
                        <select id="computer_id" name="computer_id" required>
                            <option value="">-- Choose Computer --</option>
                            <?php 
                            while ($row = $computers->fetch_assoc()) { 
                                echo '<option value="' . $row['id'] . '">' . $row['computer_name'] . ' (₹' . $row['hourly_rate'] . '/hr)</option>';
                            } 
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time *</label>
                        <input type="datetime-local" id="start_time" name="start_time" required>
                    </div>
                </div>
                <button type="submit" name="create_booking" class="btn"><i class="fas fa-calendar-check"></i> Create Booking</button>
            </form>
        </div>

        <!-- Active Bookings -->
        <div class="card">
            <h2>🔴 Active Bookings</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Person</th>
                            <th>Computer</th>
                            <th>Start Time</th>
                            <th>Hourly Rate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $active_bookings->data_seek(0);
                        while ($row = $active_bookings->fetch_assoc()) { 
                        ?>
                        <tr>
                            <td>#<?php echo $row['id']; ?></td>
                            <td><?php echo $row['person_name']; ?></td>
                            <td><?php echo $row['computer_name']; ?></td>
                            <td><span class="time-display"><?php echo date('d-m-Y H:i', strtotime($row['start_time'])); ?></span></td>
                            <td>₹<?php echo $row['hourly_rate']; ?></td>
                            <td>
                                <button class="btn" style="padding: 8px 15px; font-size: 0.9em; background: #ff6b6b;" onclick="showEndForm(<?php echo $row['id']; ?>, <?php echo $row['hourly_rate']; ?>)">
                                    <i class="fas fa-stop"></i> End
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- End Booking Modal -->
        <div id="endModal" style="display:none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; display: flex; align-items: center; justify-content: center;">
            <div class="card" style="max-width: 400px; position: relative;">
                <h2>✅ End Booking</h2>
                <form method="POST" id="endForm">
                    <input type="hidden" name="booking_id" id="bookingId">
                    <div class="form-group">
                        <label for="end_time">End Time *</label>
                        <input type="datetime-local" name="end_time" id="endTime" required>
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Amount to Collect (₹) *</label>
                        <input type="number" name="amount_paid" id="amountPaid" step="0.01" required>
                    </div>
                    <button type="submit" name="end_booking" class="btn"><i class="fas fa-check"></i> Complete Booking</button>
                    <button type="button" class="btn btn-danger" style="margin-left: 10px;" onclick="document.getElementById('endModal').style.display='none';">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Completed Bookings -->
        <div class="card">
            <h2>✅ Recent Completed Bookings</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Person</th>
                            <th>Computer</th>
                            <th>Hours Used</th>
                            <th>Amount Paid</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = $completed_bookings->fetch_assoc()) { 
                        ?>
                        <tr>
                            <td>#<?php echo $row['id']; ?></td>
                            <td><?php echo $row['person_name']; ?></td>
                            <td><?php echo $row['computer_name']; ?></td>
                            <td><?php echo $row['hours_used']; ?> hours</td>
                            <td><strong>₹<?php echo number_format($row['amount_paid'], 2); ?></strong></td>
                            <td><?php echo date('d-m-Y H:i', strtotime($row['end_time'])); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function showEndForm(bookingId, hourlyRate) {
            document.getElementById('bookingId').value = bookingId;
            document.getElementById('endTime').value = new Date().toISOString().slice(0, 16);
            document.getElementById('endModal').style.display = 'flex';
            
            // Calculate estimated amount (base calculation)
            document.getElementById('amountPaid').value = hourlyRate;
        }

        document.getElementById('endModal').onclick = function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        }
    </script>
</body>
</html>
