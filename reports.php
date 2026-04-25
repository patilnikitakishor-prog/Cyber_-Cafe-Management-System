<?php
session_start();
include 'config.php';

// Get statistics
$total_persons = $conn->query("SELECT COUNT(*) as count FROM persons")->fetch_assoc()['count'];
$total_computers = $conn->query("SELECT COUNT(*) as count FROM computers")->fetch_assoc()['count'];
$total_bookings = $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count'];
$total_revenue = $conn->query("SELECT SUM(amount_paid) as total FROM bookings WHERE status='completed'")->fetch_assoc()['total'] ?? 0;
$active_bookings = $conn->query("SELECT COUNT(*) as count FROM bookings WHERE status='active'")->fetch_assoc()['count'];

// Top customers
$top_customers = $conn->query("SELECT p.id, p.name, p.phone, COUNT(b.id) as bookings_count, SUM(b.amount_paid) as total_spent 
                               FROM persons p 
                               LEFT JOIN bookings b ON p.id = b.person_id 
                               GROUP BY p.id ORDER BY bookings_count DESC LIMIT 10");

// Revenue by date
$revenue_data = $conn->query("SELECT DATE(end_time) as booking_date, COUNT(*) as bookings, SUM(amount_paid) as daily_revenue 
                              FROM bookings WHERE status='completed' 
                              GROUP BY DATE(end_time) ORDER BY booking_date DESC LIMIT 30");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Cyber Cafe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
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
            color: #fa709a;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #fa709a, #fee140);
            border-radius: 15px 15px 0 0;
            position: relative;
            margin-bottom: 15px;
        }

        .stat-icon {
            font-size: 2.5em;
            margin-bottom: 10px;
            display: block;
        }

        .stat-value {
            font-size: 2em;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 0.95em;
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
            font-size: 1.5em;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(135deg, #fa709a, #fee140);
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
            background: #fff9e6;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85em;
        }

        .badge-primary {
            background: #cce5ff;
            color: #004085;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }

            .header h1 {
                font-size: 1.8em;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Reports & Analytics</h1>
            <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Home</a>
        </div>

        <!-- Key Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-users stat-icon" style="color: #fa709a;"></i>
                <div class="stat-value"><?php echo $total_persons; ?></div>
                <div class="stat-label">Total Persons</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-desktop stat-icon" style="color: #fee140;"></i>
                <div class="stat-value"><?php echo $total_computers; ?></div>
                <div class="stat-label">Total Computers</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-calendar stat-icon" style="color: #54a0ff;"></i>
                <div class="stat-value"><?php echo $total_bookings; ?></div>
                <div class="stat-label">Total Bookings</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-rupiah stat-icon" style="color: #48dbfb;"></i>
                <div class="stat-value">₹<?php echo number_format($total_revenue, 2); ?></div>
                <div class="stat-label">Total Revenue</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-play-circle stat-icon" style="color: #ff9ff3;"></i>
                <div class="stat-value"><?php echo $active_bookings; ?></div>
                <div class="stat-label">Active Bookings</div>
            </div>
        </div>

        <!-- Top Customers -->
        <div class="card">
            <h2>👥 Top Customers</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Bookings</th>
                            <th>Total Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $rank = 1;
                        while ($row = $top_customers->fetch_assoc()) { 
                        ?>
                        <tr>
                            <td><span class="badge badge-primary">#<?php echo $rank++; ?></span></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><span class="badge badge-success"><?php echo $row['bookings_count']; ?> bookings</span></td>
                            <td><strong>₹<?php echo number_format($row['total_spent'] ?? 0, 2); ?></strong></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Daily Revenue -->
        <div class="card">
            <h2>📈 Daily Revenue (Last 30 Days)</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Bookings</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = $revenue_data->fetch_assoc()) { 
                        ?>
                        <tr>
                            <td><?php echo date('d-m-Y', strtotime($row['booking_date'])); ?></td>
                            <td><?php echo $row['bookings']; ?></td>
                            <td><strong>₹<?php echo number_format($row['daily_revenue'], 2); ?></strong></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
