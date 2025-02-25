<?php
session_start();
include "koneksi.php";

// Function to format date in SQL Server format (Y-m-d)
function formatDateForSQLServer($date)
{
    return date_format($date, 'Y-m-d');
}

// Function to check if a date is valid and return formatted date
function validateAndFormatDate($dateString)
{
    $date = DateTime::createFromFormat('Y-m-d', $dateString);
    if (!$date) {
        return false;
    }
    return formatDateForSQLServer($date);
}

// Default today date
$today = date('Y-m-d');
$sixMonthsAgo = date('Y-m-d', strtotime('-6 months', strtotime($today)));

// Initialize variables for filtered dates
$startDate = $today;
$endDate = $today;

// Initialize variables for pagination
$resultsPerPage = 50; // Number of results per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page, default is 1
$offset = ($currentPage - 1) * $resultsPerPage;

// Process filter if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDateInput = $_POST["start_date"];
    $endDateInput = $_POST["end_date"];

    // Validate and format filter dates
    $formattedStartDate = validateAndFormatDate($startDateInput);
    $formattedEndDate = validateAndFormatDate($endDateInput);
    if ($formattedStartDate && $formattedEndDate) {
        $startDate = $formattedStartDate;
        $endDate = $formattedEndDate;
    } else {
        echo "<p>Invalid date format or date input.</p>";
    }
}

// // Function to count jenis kendaraan based on status
// function countJenisKendaraanByStatus($data)
// {
//     $count = array('Umum' => array(), 'Tidak Umum' => array());
//     foreach ($data as $item) {
//         $jenis = $item['NmJenis'];
//         $status = $item['NmStatus'];

//         if ($status == 'Umum') {
//             if (isset($count['Umum'][$jenis])) {
//                 $count['Umum'][$jenis]++;
//             } else {
//                 $count['Umum'][$jenis] = 1;
//             }
//         } else {
//             if (isset($count['Tidak Umum'][$jenis])) {
//                 $count['Tidak Umum'][$jenis]++;
//             } else {
//                 $count['Tidak Umum'][$jenis] = 1;
//             }
//         }
//     }
//     return $count;
// }

// Function to count jenis kendaraan based on status and uji status
function countJenisKendaraanByStatus($data)
{
    $count = array(
        'Umum' => array('Lulus' => array(), 'Tidak Lulus' => array()),
        'Tidak Umum' => array('Lulus' => array(), 'Tidak Lulus' => array())
    );
    
    foreach ($data as $item) {
        $jenis = $item['NmJenis'];
        $status = $item['NmStatus'];
        $statusUji = $item['NmStatusUji'];

        if ($status == 'Umum') {
            if (isset($count['Umum'][$statusUji][$jenis])) {
                $count['Umum'][$statusUji][$jenis]++;
            } else {
                $count['Umum'][$statusUji][$jenis] = 1;
            }
        } else { // Tidak Umum
            if (isset($count['Tidak Umum'][$statusUji][$jenis])) {
                $count['Tidak Umum'][$statusUji][$jenis]++;
            } else {
                $count['Tidak Umum'][$statusUji][$jenis] = 1;
            }
        }
    }
    
    return $count;
}

// SQL query for data within date range with pagination using ROW_NUMBER()
$strFiltered = "
SELECT *
FROM (
    SELECT
        wu.NoUji,
        p.NoReg, 
        p.TglRegistrasi, 
        ds.NoKendaraan,
        pm.NmPemilik,
        j.NmJenis,
        s.NmStatus,
        su.NmStatusUji,
        ROW_NUMBER() OVER (ORDER BY p.TglRegistrasi DESC) AS RowNum
    FROM 
        Pengujian p
    JOIN
        DataWajibUji wu ON p.IdWajibUji = wu.IdWajibUji
    JOIN 
        DataPemilik pm ON p.IdWajibUji = pm.IdWajibUji
    JOIN 
        DataKendaraan k ON p.IdWajibUji = k.IdWajibUji
    JOIN
        DataSTNK ds ON p.IdWajibUji = ds.IdWajibUji
    JOIN 
        MasterJenis j ON k.IdJenis = j.IdJenis
    JOIN
        MasterStatus s ON k.IdStatus = s.IdStatus
    JOIN
        MasterStatusUji su ON p.IdStatusUji = su.IdStatusUji
    WHERE 
        p.NoReg <> 'REG.' 
        AND CONVERT(date, p.RecDate, 101) BETWEEN '$startDate' AND '$endDate'
) AS SubQuery
WHERE RowNum BETWEEN $offset + 1 AND $offset + $resultsPerPage";

// Execute filtered query
$rsFiltered = sqlsrv_query($conn, $strFiltered);
if ($rsFiltered === false) {
    die(print_r(sqlsrv_errors(), true));
}

$filteredData = array(); // Array to store NoUji data
while ($ruFiltered = sqlsrv_fetch_array($rsFiltered, SQLSRV_FETCH_ASSOC)) {
    $filteredData[] = $ruFiltered;
}

// Count total results for pagination
$totalResultsQuery = "SELECT COUNT(*) AS Total FROM (
    SELECT
        wu.NoUji
    FROM 
        Pengujian p
    JOIN
        DataWajibUji wu ON p.IdWajibUji = wu.IdWajibUji
    JOIN 
        DataPemilik pm ON p.IdWajibUji = pm.IdWajibUji
    JOIN 
        DataKendaraan k ON p.IdWajibUji = k.IdWajibUji
    JOIN
        DataSTNK ds ON p.IdWajibUji = ds.IdWajibUji
    JOIN 
        MasterJenis j ON k.IdJenis = j.IdJenis
    JOIN
        MasterStatus s ON k.IdStatus = s.IdStatus
    JOIN
        MasterStatusUji su ON p.IdStatusUji = su.IdStatusUji
    WHERE 
        p.NoReg <> 'REG.' 
        AND CONVERT(date, p.RecDate, 101) BETWEEN '$startDate' AND '$endDate'
) AS TotalQuery";

$rsTotalResults = sqlsrv_query($conn, $totalResultsQuery);
if ($rsTotalResults === false) {
    die(print_r(sqlsrv_errors(), true));
}

$totalResults = sqlsrv_fetch_array($rsTotalResults)['Total'];

// Query to count total kendaraan for the filtered date range
$totalKendaraanQuery = "SELECT COUNT(*) AS TotalKendaraan FROM (
    SELECT
        wu.NoUji
    FROM 
        Pengujian p
    JOIN
        DataWajibUji wu ON p.IdWajibUji = wu.IdWajibUji
    JOIN 
        DataPemilik pm ON p.IdWajibUji = pm.IdWajibUji
    JOIN 
        DataKendaraan k ON p.IdWajibUji = k.IdWajibUji
    JOIN
        DataSTNK ds ON p.IdWajibUji = ds.IdWajibUji
    JOIN 
        MasterJenis j ON k.IdJenis = j.IdJenis
    JOIN
        MasterStatus s ON k.IdStatus = s.IdStatus
    JOIN
        MasterStatusUji su ON p.IdStatusUji = su.IdStatusUji
    WHERE 
        p.NoReg <> 'REG.' 
        AND CONVERT(date, p.RecDate, 101) BETWEEN '$startDate' AND '$endDate'
) AS TotalKendaraanQuery";

$rsTotalKendaraan = sqlsrv_query($conn, $totalKendaraanQuery);
if ($rsTotalKendaraan === false) {
    die(print_r(sqlsrv_errors(), true));
}

$totalKendaraan = sqlsrv_fetch_array($rsTotalKendaraan)['TotalKendaraan'];

// SQL query to fetch all data without pagination for jenis kendaraan count
$strFilteredAll = "
SELECT
    wu.NoUji,
    p.NoReg, 
    p.TglRegistrasi, 
    ds.NoKendaraan,
    pm.NmPemilik,
    j.NmJenis,
    s.NmStatus,
    su.NmStatusUji
FROM 
    Pengujian p
JOIN
    DataWajibUji wu ON p.IdWajibUji = wu.IdWajibUji
JOIN 
    DataPemilik pm ON p.IdWajibUji = pm.IdWajibUji
JOIN 
    DataKendaraan k ON p.IdWajibUji = k.IdWajibUji
JOIN
    DataSTNK ds ON p.IdWajibUji = ds.IdWajibUji
JOIN 
    MasterJenis j ON k.IdJenis = j.IdJenis
JOIN
    MasterStatus s ON k.IdStatus = s.IdStatus
JOIN
    MasterStatusUji su ON p.IdStatusUji = su.IdStatusUji
WHERE 
    p.NoReg <> 'REG.' 
    AND CONVERT(date, p.RecDate, 101) BETWEEN '$startDate' AND '$endDate'
ORDER BY p.TglRegistrasi DESC";

// Execute query to fetch all data
$rsFilteredAll = sqlsrv_query($conn, $strFilteredAll);
if ($rsFilteredAll === false) {
    die(print_r(sqlsrv_errors(), true));
}

$filteredDataAll = array(); // Array to store all data for jenis kendaraan count
while ($ruFilteredAll = sqlsrv_fetch_array($rsFilteredAll, SQLSRV_FETCH_ASSOC)) {
    $filteredDataAll[] = $ruFilteredAll;
}

// Count the number of vehicle types for all data
// $jenisKendaraanFilteredAll = countJenisKendaraan($filteredDataAll);
$jenisKendaraanByStatus = countJenisKendaraanByStatus($filteredDataAll);

// Close SQL connection
sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kendaraan Uji</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            display: inline-block;
            padding: 6px 12px;
            margin: 0 3px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        .pagination span {
            display: inline-block;
            padding: 6px 12px;
            margin: 0 3px;
            background-color: #ccc;
            color: #333;
            border-radius: 5px;
        }

        .pagination .disabled {
            pointer-events: none;
            background-color: #eee;
            color: #666;

        
        }

        .lulus {
            color: green;
            font-weight: bold;
        }

        .tidak-lulus {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="page-home.html" class="headerButton">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->
    <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $startDate; ?>" required>
            <label for="end_date">Tanggal Akhir</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $endDate; ?>" required>
            <button type="submit">Filter</button>
        </form>

        <h2>Data Kendaraan Uji</h2>

        <h3>Jenis Kendaraan Umum:</h3>
        <ul>
            <?php foreach ($jenisKendaraanByStatus['Umum']['Lulus'] as $jenis => $count) {
                echo "<li>$jenis <span class='lulus'>Lulus</span>: $count</li>";
            } ?>
            <?php foreach ($jenisKendaraanByStatus['Umum']['Tidak Lulus'] as $jenis => $count) {
                echo "<li>$jenis <span class='tidak-lulus'>Tidak Lulus</span>: $count</li>";
            } ?>
        </ul>

        <h3>Jenis Kendaraan Tidak Umum:</h3>
        <ul>
            <?php foreach ($jenisKendaraanByStatus['Tidak Umum']['Lulus'] as $jenis => $count) {
                echo "<li>$jenis <span class='lulus'>Lulus</span>: $count</li>";
            } ?>
            <?php foreach ($jenisKendaraanByStatus['Tidak Umum']['Tidak Lulus'] as $jenis => $count) {
                echo "<li>$jenis <span class='tidak-lulus'>Tidak Lulus</span>: $count</li>";
            } ?>
        </ul>

        <table>
            <thead>
                <tr>
                    <th>No. Uji</th>
                    <th>No. Registrasi</th>
                    <th>Tanggal Registrasi</th>
                    <th>No. Kendaraan</th>
                    <th>Nama Pemilik</th>
                    <th>Jenis Kendaraan</th>
                    <th>Status Kendaraan</th>
                    <th>Pengujian</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredData as $data) : ?>
                    <tr>
                        <td><?php echo $data['NoUji']; ?></td>
                        <td><?php echo $data['NoReg']; ?></td>
                        <td><?php echo $data['TglRegistrasi']->format('d-m-Y'); ?></td>
                        <td><?php echo $data['NoKendaraan']; ?></td>
                        <td><?php echo $data['NmPemilik']; ?></td>
                        <td><?php echo $data['NmJenis']; ?></td>
                        <td><?php echo $data['NmStatus']; ?></td>
                        <td><?php echo $data['NmStatusUji']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            $totalPages = ceil($totalResults / $resultsPerPage);
            $range = 3; // Number of links to show before and after current page

            if ($totalPages > 1) {
                // Previous link
                if ($currentPage > 1) {
                    echo '<a href="?page=' . ($currentPage - 1) . '">Previous</a>';
                } else {
                    echo '<span class="disabled">Previous</span>';
                }

                // Pages link
                for ($i = max(1, $currentPage - $range); $i <= min($totalPages, $currentPage + $range); $i++) {
                    if ($i == $currentPage) {
                        echo '<span>' . $i . '</span>';
                    } else {
                        echo '<a href="?page=' . $i . '">' . $i . '</a>';
                    }
                }

                // Next link
                if ($currentPage < $totalPages) {
                    echo '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
                } else {
                    echo '<span class="disabled">Next</span>';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
