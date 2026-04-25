<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Import Students - Cyber Cafe Manager</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);min-height:100vh;padding:20px;}
.topnav{background:rgba(255,255,255,0.15);backdrop-filter:blur(10px);border-radius:50px;padding:12px 24px;display:flex;align-items:center;justify-content:space-between;margin-bottom:30px;}
.topnav h1{color:#fff;font-size:1.1rem;font-weight:700;display:flex;align-items:center;gap:10px;}
.topnav a{color:#fff;text-decoration:none;background:rgba(255,255,255,0.2);padding:8px 18px;border-radius:25px;font-size:.85rem;font-weight:500;transition:.2s;}
.topnav a:hover{background:rgba(255,255,255,0.35);}
.container{max-width:900px;margin:0 auto;}
.card{background:#fff;border-radius:20px;padding:30px;margin-bottom:24px;box-shadow:0 10px 40px rgba(0,0,0,0.15);}
.card-title{font-size:1.1rem;font-weight:700;color:#2d3748;margin-bottom:20px;display:flex;align-items:center;gap:10px;padding-bottom:15px;border-bottom:2px solid #f0f0f0;}
.card-title i{color:#667eea;}

/* Upload Box */
.upload-area{border:2px dashed #667eea;border-radius:14px;padding:40px;text-align:center;background:#f8f7ff;cursor:pointer;transition:.3s;position:relative;}
.upload-area:hover{background:#ede9ff;border-color:#764ba2;}
.upload-area input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
.upload-icon{font-size:3rem;margin-bottom:15px;}
.upload-area h3{font-size:1.1rem;font-weight:600;color:#4a5568;margin-bottom:8px;}
.upload-area p{font-size:.85rem;color:#718096;}
.upload-area .file-name{margin-top:15px;font-size:.9rem;font-weight:600;color:#667eea;display:none;}

/* Template Box */
.template-box{background:linear-gradient(135deg,#e8f5e9,#f1f8e9);border:1px solid #a5d6a7;border-radius:14px;padding:20px;margin-bottom:20px;}
.template-box h4{color:#2e7d32;font-size:.95rem;font-weight:600;margin-bottom:8px;display:flex;align-items:center;gap:8px;}
.template-box p{color:#4caf50;font-size:.82rem;margin-bottom:12px;}
.template-table{width:100%;border-collapse:collapse;font-size:.82rem;margin-bottom:12px;}
.template-table th{background:#4caf50;color:#fff;padding:8px 14px;text-align:left;}
.template-table td{padding:7px 14px;background:#fff;border:1px solid #c8e6c9;color:#555;}

/* Steps */
.steps{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;}
.step{background:linear-gradient(135deg,#667eea,#764ba2);border-radius:14px;padding:20px;text-align:center;color:#fff;}
.step-num{width:36px;height:36px;background:rgba(255,255,255,0.25);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;margin:0 auto 12px;}
.step h4{font-size:.9rem;font-weight:600;margin-bottom:6px;}
.step p{font-size:.78rem;opacity:.85;}

/* Buttons */
.btn{display:inline-flex;align-items:center;gap:8px;padding:11px 24px;border-radius:10px;border:none;cursor:pointer;font-size:.88rem;font-weight:600;font-family:'Poppins',sans-serif;text-decoration:none;transition:.2s;}
.btn-primary{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;box-shadow:0 4px 15px rgba(102,126,234,0.4);}
.btn-primary:hover{box-shadow:0 6px 20px rgba(102,126,234,0.6);transform:translateY(-1px);}
.btn-success{background:linear-gradient(135deg,#48bb78,#38a169);color:#fff;}
.btn-download{background:linear-gradient(135deg,#38b2ac,#319795);color:#fff;}
.btn-ghost{background:#f7f7f7;color:#4a5568;border:1px solid #e2e8f0;}
.btn-ghost:hover{background:#eee;}
.btn-sm{padding:7px 16px;font-size:.8rem;border-radius:8px;}

/* Table */
.table-wrap{overflow-x:auto;}
table{width:100%;border-collapse:collapse;font-size:.85rem;}
thead tr{background:linear-gradient(135deg,#667eea,#764ba2);}
th{padding:11px 16px;text-align:left;color:#fff;font-weight:600;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;}
td{padding:12px 16px;border-bottom:1px solid #f0f0f0;color:#4a5568;vertical-align:middle;}
tbody tr:hover td{background:#f8f7ff;}
tbody tr:last-child td{border-bottom:none;}

/* Alert */
.alert{padding:13px 18px;border-radius:10px;margin-bottom:20px;font-size:.88rem;display:flex;align-items:center;gap:10px;}
.alert-success{background:#f0fff4;color:#276749;border:1px solid #c6f6d5;}
.alert-danger{background:#fff5f5;color:#c53030;border:1px solid #fed7d7;}
.alert-info{background:#ebf8ff;color:#2b6cb0;border:1px solid #bee3f8;}

/* Stats row */
.import-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:20px;}
.istat{background:#f8f7ff;border:1px solid #e9e3ff;border-radius:12px;padding:16px;text-align:center;}
.istat-val{font-size:1.6rem;font-weight:800;color:#667eea;}
.istat-label{font-size:.78rem;color:#718096;margin-top:4px;}

/* Badge */
.badge{display:inline-flex;align-items:center;padding:4px 11px;border-radius:20px;font-size:.72rem;font-weight:600;}
.badge-new{background:#e0f2fe;color:#0277bd;}
.badge-exists{background:#fff3e0;color:#e65100;}

/* Preview area */
#previewSection{display:none;}
#importSection{display:none;}
</style>
</head>
<body>

<?php
$conn = new mysqli('localhost','root','','cybercafe_db');
$conn->set_charset("utf8mb4");

// Create persons table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS persons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$msg = '';
$msgType = '';
$importedRows = [];
$totalImported = 0;
$totalSkipped = 0;
$totalNew = 0;

// Handle CSV Import
if (isset($_POST['do_import']) && !empty($_POST['csv_data'])) {
    $lines = explode("\n", trim($_POST['csv_data']));
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        $parts = str_getcsv($line);
        if (count($parts) < 1) continue;
        $naam  = $conn->real_escape_string(trim($parts[0] ?? ''));
        $phone = $conn->real_escape_string(trim($parts[1] ?? ''));
        $email = $conn->real_escape_string(trim($parts[2] ?? ''));
        $addr  = $conn->real_escape_string(trim($parts[3] ?? ''));
        if (empty($naam)) { $totalSkipped++; continue; }
        $exists = $conn->query("SELECT id FROM persons WHERE naam='$naam' AND phone='$phone'")->num_rows > 0;
        if (!$exists) {
            $conn->query("INSERT INTO persons (naam,phone,email,address) VALUES ('$naam','$phone','$email','$addr')");
            $totalImported++;
            $totalNew++;
        } else {
            $totalSkipped++;
        }
    }
    $msg = "Import complete! $totalNew new records added, $totalSkipped skipped.";
    $msgType = 'success';
}

// Handle manual add
if (isset($_POST['manual_add'])) {
    $naam  = $conn->real_escape_string(trim($_POST['naam']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $addr  = $conn->real_escape_string(trim($_POST['address']));
    if (!empty($naam)) {
        $conn->query("INSERT INTO persons (naam,phone,email,address) VALUES ('$naam','$phone','$email','$addr')");
        $msg = "Student added successfully!";
        $msgType = 'success';
    }
}

// Handle delete
if (isset($_GET['del'])) {
    $conn->query("DELETE FROM persons WHERE id=".intval($_GET['del']));
    $msg = "Record deleted!";
    $msgType = 'success';
}

// Download sample excel
if (isset($_GET['sample'])) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="sample_import.xls"');
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><style>th{background:#667eea;color:white;padding:10px 16px;border:1px solid #764ba2;}td{padding:8px 16px;border:1px solid #ddd;}</style></head><body>';
    echo '<table><tr><th>Naam</th><th>Phone</th><th>Email</th><th>Address</th></tr>';
    echo '<tr><td>Rahul Sharma</td><td>9876543210</td><td>rahul@email.com</td><td>Mumbai</td></tr>';
    echo '<tr><td>Priya Singh</td><td>9765432109</td><td>priya@email.com</td><td>Delhi</td></tr>';
    echo '<tr><td>Amit Kumar</td><td>9654321098</td><td>amit@email.com</td><td>Pune</td></tr>';
    echo '</table></body></html>';
    exit;
}

// Export all to excel
if (isset($_GET['export'])) {
    $all = $conn->query("SELECT * FROM persons ORDER BY naam");
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="students_'.date('Y-m-d').'.xls"');
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><style>body{font-family:Arial;}.hd{font-size:16pt;font-weight:bold;background:#667eea;color:white;padding:12px;}th{background:#764ba2;color:white;padding:9px 14px;border:1px solid #5a3a8a;}td{padding:8px 14px;border:1px solid #e2e8f0;}.ev{background:#f8f7ff;}.tot{background:#667eea;color:white;font-weight:bold;}</style></head><body>';
    echo '<table width="100%"><tr><td colspan="6" class="hd">&#x1F393; Cyber Cafe - Students Data</td></tr>';
    echo '<tr><td colspan="6" style="padding:5px 12px;color:#666;">Exported: '.date('F j, Y h:i A').'</td></tr><tr><td colspan="6">&nbsp;</td></tr>';
    echo '<tr><th>#</th><th>Naam</th><th>Phone</th><th>Email</th><th>Address</th><th>Registered</th></tr>';
    $i=0; $rows=[];
    while($r=$all->fetch_assoc()) $rows[]=$r;
    foreach($rows as $r){
        $c=($i++%2==0)?'ev':'';
        echo '<tr class="'.$c.'"><td>'.$r['id'].'</td><td><strong>'.htmlspecialchars($r['naam']).'</strong></td><td>'.$r['phone'].'</td><td>'.$r['email'].'</td><td>'.htmlspecialchars($r['address']).'</td><td>'.date('M d, Y',strtotime($r['created_at'])).'</td></tr>';
    }
    echo '<tr class="tot"><td colspan="5" style="padding:8px 14px;text-align:right;">TOTAL STUDENTS:</td><td style="padding:8px 14px;">'.count($rows).'</td></tr>';
    echo '</table></body></html>';
    exit;
}

$allPersons = $conn->query("SELECT * FROM persons ORDER BY created_at DESC");
$totalCount = $conn->query("SELECT COUNT(*) c FROM persons")->fetch_assoc()['c'];
?>

<div class="topnav">
    <h1>🎮 Cyber Cafe Manager</h1>
    <a href="index.php">← Back to Dashboard</a>
</div>

<div class="container">

<?php if ($msg) echo '<div class="alert alert-'.$msgType.'"><i class="fas fa-'.(($msgType=='success')?'check-circle':'exclamation-circle').'"></i> '.$msg.'</div>'; ?>

<!-- Steps -->
<div class="steps">
    <div class="step">
        <div class="step-num">1</div>
        <h4>Download Template</h4>
        <p>Sample Excel file download karo format samajhne ke liye</p>
    </div>
    <div class="step">
        <div class="step-num">2</div>
        <h4>Data Bharo</h4>
        <p>Excel mein naam, phone, email, address fill karo</p>
    </div>
    <div class="step">
        <div class="step-num">3</div>
        <h4>Import Karo</h4>
        <p>CSV format mein save karo aur yahan upload karo</p>
    </div>
</div>

<!-- Import Card -->
<div class="card">
    <div class="card-title">
        📥 Excel / CSV Se Import Karo
    </div>

    <!-- Template Download -->
    <div class="template-box">
        <h4>📋 Excel Format — Aisa hona chahiye:</h4>
        <p>Apni Excel file mein exactly yah columns rakho (pehli row headers honi chahiye):</p>
        <table class="template-table">
            <tr><th>Naam</th><th>Phone</th><th>Email</th><th>Address</th></tr>
            <tr><td>Rahul Sharma</td><td>9876543210</td><td>rahul@email.com</td><td>Mumbai</td></tr>
            <tr><td>Priya Singh</td><td>9765432109</td><td>priya@email.com</td><td>Delhi</td></tr>
        </table>
        <a href="?sample=1" class="btn btn-download btn-sm">⬇️ Sample File Download Karo</a>
    </div>

    <!-- File Upload -->
    <div class="upload-area" id="uploadArea" onclick="document.getElementById('csvFile').click()">
        <input type="file" id="csvFile" accept=".csv,.xlsx,.xls" style="display:none;" onchange="handleFile(this)">
        <div class="upload-icon">📂</div>
        <h3>Click karke CSV/Excel file select karo</h3>
        <p>Supported: .csv, .xlsx, .xls</p>
        <div class="file-name" id="fileName"></div>
    </div>

    <div style="margin-top:14px;padding:12px;background:#fffbeb;border:1px solid #f6e05e;border-radius:10px;font-size:.82rem;color:#744210;">
        <strong>⚠️ Important:</strong> Excel file ko pehle <strong>CSV (Comma delimited)</strong> format mein save karo — File → Save As → CSV → phir yahan upload karo
    </div>

    <!-- Preview Section -->
    <div id="previewSection" style="margin-top:20px;">
        <div class="import-stats">
            <div class="istat"><div class="istat-val" id="statTotal">0</div><div class="istat-label">Total Rows</div></div>
            <div class="istat"><div class="istat-val" id="statValid" style="color:#38a169;">0</div><div class="istat-label">Valid Records</div></div>
            <div class="istat"><div class="istat-val" id="statEmpty" style="color:#e53e3e;">0</div><div class="istat-label">Empty/Invalid</div></div>
        </div>
        <h4 style="margin-bottom:12px;color:#2d3748;">Preview (first 10 rows):</h4>
        <div class="table-wrap">
            <table id="previewTable">
                <thead><tr><th>#</th><th>Naam</th><th>Phone</th><th>Email</th><th>Address</th><th>Status</th></tr></thead>
                <tbody id="previewBody"></tbody>
            </table>
        </div>
        <form method="POST" id="importForm" style="margin-top:16px;">
            <input type="hidden" name="do_import" value="1">
            <textarea name="csv_data" id="csvDataHidden" style="display:none;"></textarea>
            <button type="submit" class="btn btn-success"><i>✅</i> Confirm Import Karo</button>
            <button type="button" class="btn btn-ghost" onclick="resetUpload()" style="margin-left:10px;">Cancel</button>
        </form>
    </div>
</div>

<!-- Manual Add Card -->
<div class="card">
    <div class="card-title">➕ Manually Student Add Karo</div>
    <form method="POST">
        <input type="hidden" name="manual_add" value="1">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <label style="font-size:.8rem;font-weight:600;color:#4a5568;display:block;margin-bottom:6px;">NAAM *</label>
                <input type="text" name="naam" placeholder="Student ka naam" required style="width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:9px;font-family:'Poppins',sans-serif;font-size:.88rem;outline:none;">
            </div>
            <div>
                <label style="font-size:.8rem;font-weight:600;color:#4a5568;display:block;margin-bottom:6px;">PHONE</label>
                <input type="text" name="phone" placeholder="Mobile number" style="width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:9px;font-family:'Poppins',sans-serif;font-size:.88rem;outline:none;">
            </div>
            <div>
                <label style="font-size:.8rem;font-weight:600;color:#4a5568;display:block;margin-bottom:6px;">EMAIL</label>
                <input type="email" name="email" placeholder="Email address" style="width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:9px;font-family:'Poppins',sans-serif;font-size:.88rem;outline:none;">
            </div>
            <div>
                <label style="font-size:.8rem;font-weight:600;color:#4a5568;display:block;margin-bottom:6px;">ADDRESS</label>
                <input type="text" name="address" placeholder="Ghar ka address" style="width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:9px;font-family:'Poppins',sans-serif;font-size:.88rem;outline:none;">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:16px;"><i>💾</i> Add Student</button>
    </form>
</div>

<!-- All Students Table -->
<div class="card">
    <div class="card-title" style="justify-content:space-between;">
        <span>👥 All Students (<?php echo $totalCount; ?> total)</span>
        <a href="?export=1" class="btn btn-success btn-sm">📊 Export Excel</a>
    </div>

    <?php if ($totalCount == 0) { ?>
    <div style="text-align:center;padding:40px;color:#a0aec0;">
        <div style="font-size:3rem;margin-bottom:14px;">📭</div>
        <h3 style="font-weight:600;margin-bottom:8px;color:#718096;">Koi student nahi hai abhi</h3>
        <p style="font-size:.85rem;">Excel se import karo ya manually add karo</p>
    </div>
    <?php } else { ?>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Naam</th><th>Phone</th><th>Email</th><th>Address</th><th>Added On</th><th>Action</th></tr>
            </thead>
            <tbody>
            <?php while ($r = $allPersons->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $r['id']; ?></td>
                <td><strong><?php echo htmlspecialchars($r['naam']); ?></strong></td>
                <td><?php echo $r['phone'] ?: '-'; ?></td>
                <td><?php echo $r['email'] ?: '-'; ?></td>
                <td><?php echo htmlspecialchars($r['address']) ?: '-'; ?></td>
                <td style="color:#718096;font-size:.8rem;"><?php echo date('M d, Y', strtotime($r['created_at'])); ?></td>
                <td>
                    <a href="?del=<?php echo $r['id']; ?>" class="btn btn-sm" style="background:#fff5f5;color:#c53030;border:1px solid #fed7d7;" onclick="return confirm('Delete this record?')">🗑️</a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>

</div><!-- container -->

<script>
function handleFile(input) {
    var file = input.files[0];
    if (!file) return;
    document.getElementById('fileName').style.display = 'block';
    document.getElementById('fileName').textContent = '✅ File selected: ' + file.name;

    var reader = new FileReader();
    reader.onload = function(e) {
        var text = e.target.result;
        parseAndPreview(text);
    };
    reader.readAsText(file);
}

function parseAndPreview(text) {
    var lines = text.trim().split('\n');
    var tbody = document.getElementById('previewBody');
    tbody.innerHTML = '';
    var validCount = 0;
    var emptyCount = 0;
    var csvRows = [];
    var startIdx = 0;

    // Skip header row if first cell looks like a label
    var firstLine = lines[0].toLowerCase();
    if (firstLine.includes('naam') || firstLine.includes('name') || firstLine.includes('phone')) {
        startIdx = 1;
    }

    var previewLines = lines.slice(startIdx);
    var totalData = previewLines.length;

    previewLines.forEach(function(line, idx) {
        line = line.trim();
        if (!line) { emptyCount++; return; }
        var parts = line.split(',');
        var naam  = (parts[0] || '').trim().replace(/^"|"$/g,'');
        var phone = (parts[1] || '').trim().replace(/^"|"$/g,'');
        var email = (parts[2] || '').trim().replace(/^"|"$/g,'');
        var addr  = (parts[3] || '').trim().replace(/^"|"$/g,'');

        if (!naam) { emptyCount++; return; }
        validCount++;
        csvRows.push([naam, phone, email, addr].join(','));

        if (idx < 10) {
            var tr = '<tr>';
            tr += '<td>' + (idx+1) + '</td>';
            tr += '<td><strong>' + naam + '</strong></td>';
            tr += '<td>' + (phone || '-') + '</td>';
            tr += '<td>' + (email || '-') + '</td>';
            tr += '<td>' + (addr || '-') + '</td>';
            tr += '<td><span class="badge badge-new">New</span></td>';
            tr += '</tr>';
            tbody.innerHTML += tr;
        }
    });

    document.getElementById('statTotal').textContent = totalData;
    document.getElementById('statValid').textContent = validCount;
    document.getElementById('statEmpty').textContent = emptyCount;
    document.getElementById('csvDataHidden').value = csvRows.join('\n');
    document.getElementById('previewSection').style.display = 'block';
}

function resetUpload() {
    document.getElementById('previewSection').style.display = 'none';
    document.getElementById('fileName').style.display = 'none';
    document.getElementById('csvFile').value = '';
    document.getElementById('previewBody').innerHTML = '';
}
</script>
</body>
</html>
