<?php
include '../../config/functions.php';

// Ambil semua data legalitas
$dataLegalitas = getAllLegalitas();

function getAllLegalitas()
{
    global $conn;
    $sql = "SELECT id, legalitas, sertifikat FROM legalitas";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Legalitas List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Legalitas List</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Sertifikat</th>
                <th>Legalitas File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataLegalitas as $legalitas) : ?>
                <tr>

                    <td><?= htmlspecialchars($legalitas['id']); ?></td>
                    <td><?= htmlspecialchars($legalitas['sertifikat']); ?></td>
                    <td>
                        <?php if (!empty($legalitas['legalitas'])) : ?>
                            <a href="legalitas_pdf.php?id=<?= htmlspecialchars($legalitas['id']); ?>" target="_blank">
                                Lihat PDF
                            </a>
                        <?php else : ?>
                            No File
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="read_legalitas.php?id=<?= htmlspecialchars($legalitas['id']); ?>">View</a> |
                        <a href="update_legalitas.php?id=<?= htmlspecialchars($legalitas['id']); ?>">Update</a> |
                        <a href="delete_legalitas.php?id=<?= htmlspecialchars($legalitas['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="add_legalitas.php">Add New Legalitas</a>
</body>

</html>