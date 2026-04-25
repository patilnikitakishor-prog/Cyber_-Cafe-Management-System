<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_computer'])) {
        $name = $_POST['computer_name'];
        $rate = $_POST['hourly_rate'];

        $sql = "INSERT INTO computers (computer_name, hourly_rate) VALUES ('$name', $rate)";
        if ($conn->query($sql)) {
            $_SESSION['success'] = "Computer added successfully!";
        }
    }

    if (isset($_POST['update_status'])) {
        $id = $_POST['computer_id'];
        $status = $_POST['status'];
        $sql = "UPDATE computers SET status='$status' WHERE id=$id";
        if ($conn->query($sql)) {
            $_SESSION['success'] = "Status updated successfully!";
        }
    }

    if (isset($_POST['delete_computer'])) {
        $id = $_POST['computer_id'];
        $sql = "DELETE FROM computers WHERE id=$id";
        if ($conn->query($sql)) {
            $_SESSION['success'] = "Computer deleted successfully!";
        }
    }
}

$computers = $conn->query("SELECT * FROM computers ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Computers - Cyber Cafe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
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
            color: #f5576c;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            transform: translateY(-3px);
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
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

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #f5576c;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn {
            padding: 12px 30px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1em;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
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
            border: 1px solid #c3e6cb;
        }

        .table-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(135deg, #f093fb, #f5576c);
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
            background: #fff5f7;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9em;
        }

        .status-available {
            background: #d4edda;
            color: #155724;
        }

        .status-occupied {
            background: #ffeaa7;
            color: #856404;
        }

        .status-maintenance {
            background: #f8d7da;
            color: #721c24;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🖥️ Manage Computers</h1>
            <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Home</a>
        </div>

        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>

        <div class="form-card">
            <h2 style="margin-bottom: 20px; color: #333;">➕ Add New Computer</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="computer_name">Computer Name *</label>
                        <input type="text" id="computer_name" name="computer_name" placeholder="e.g., PC-01" required>
                    </div>
                    <div class="form-group">
                        <label for="hourly_rate">Hourly Rate (₹) *</label>
                        <input type="number" id="hourly_rate" name="hourly_rate" step="0.01" placeholder="50.00" required>
                    </div>
                </div>
                <button type="submit" name="add_computer" class="btn"><i class="fas fa-plus"></i> Add Computer</button>
            </form>
        </div>

        <div class="table-card">
            <h2 style="margin-bottom: 20px; color: #333;">📋 All Computers</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Computer Name</th>
                        <th>Status</th>
                        <th>Hourly Rate</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $computers->fetch_assoc()) { ?>
                    <tr>
                        <td>#<?php echo $row['id']; ?></td>
                        <td><?php echo $row['computer_name']; ?></td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="computer_id" value="<?php echo $row['id']; ?>">
                                <select name="status" onchange="this.form.submit()" style="padding: 5px; border-radius: 5px; border: none; cursor: pointer;">
                                    <option value="available" <?php echo ($row['status'] == 'available' ? 'selected' : ''); ?>>Available</option>
                                    <option value="occupied" <?php echo ($row['status'] == 'occupied' ? 'selected' : ''); ?>>Occupied</option>
                                    <option value="maintenance" <?php echo ($row['status'] == 'maintenance' ? 'selected' : ''); ?>>Maintenance</option>
                                </select>
                                <input type="hidden" name="update_status">
                            </form>
                        </td>
                        <td>₹<?php echo $row['hourly_rate']; ?>/hour</td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="computer_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_computer" class="btn" onclick="return confirm('Are you sure?');" style="background: linear-gradient(135deg, #f093fb, #f5576c); padding: 8px 15px; font-size: 0.9em;">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
