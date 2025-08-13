<?php
// functions.php - common DB helpers

function get_properties($mysqli, $limit=6, $offset=0, $category=null) {
    $sql = "SELECT p.* FROM properties p";
    $params = [];
    $types = "";
    if ($category) {
        $sql .= " WHERE p.category = ?";
        $params[] = $category;
        $types .= "s";
    }
    $sql .= " ORDER BY p.created_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $types .= "ii";
    $stmt = $mysqli->prepare($sql);
    if(!$stmt){ die("Prepare failed: ".$mysqli->error); }
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $res = $stmt->get_result();
    $rows = $res->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $rows;
}

function get_property_by_id_or_slug($mysqli, $id_or_slug) {
    if (ctype_digit((string)$id_or_slug)) {
        $stmt = $mysqli->prepare("SELECT * FROM properties WHERE id = ?");
        $stmt->bind_param("i", $id_or_slug);
    } else {
        $stmt = $mysqli->prepare("SELECT * FROM properties WHERE slug = ?");
        $stmt->bind_param("s", $id_or_slug);
    }
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();
    return $row;
}

function get_property_images($mysqli, $property_id) {
    $stmt = $mysqli->prepare("SELECT * FROM property_images WHERE property_id = ? ORDER BY sort_order ASC, id ASC");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $rows = $res->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $rows;
}

function count_properties($mysqli, $category=null) {
    if ($category) {
        $stmt = $mysqli->prepare("SELECT COUNT(*) AS c FROM properties WHERE category = ?");
        $stmt->bind_param("s", $category);
    } else {
        $stmt = $mysqli->prepare("SELECT COUNT(*) AS c FROM properties");
    }
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();
    return (int)$row['c'];
}
?>
