<?php

include_once "functions.php";

if(isset($_POST['offset'])) {
    $offset = $_POST['offset'];
    $limit = $_POST['limit'];
    $sort_by = $_POST['sortBy'];
    $search = $_POST['search'];

    $sort = ["price-ascending" => "price", "price-descending" => "price", "date-ascending" => "p.created_at", "date-descending" => "p.created_at"];
    $order = ["price-ascending" => "ASC", "price-descending" => "DESC", "date-ascending" => "ASC", "date-descending" => "DESC"];

    $sort_by = !empty($sort_by) ? $sort_by : 'p.created_at';
    $q = !empty($search) ? $search : '';

    $query = "SELECT *, p.id AS productID, p.name AS productName, u.id AS userID, c.id AS catID, c.name AS catName FROM products p INNER JOIN users u on p.user_id = u.id INNER JOIN categories c on p.cat_id = c.id";

    if (!empty($q)) {
        $q = urldecode($q);
        echo $q;
        $query .= " WHERE p.name LIKE '%{$q}%'";
    }

    if ($sort_by != 'p.created_at') {
        $query .= " ORDER BY {$sort[$sort_by]} {$order[$sort_by]}";
    } else {
        $query .= " ORDER BY p.created_at DESC";
    }

    $query .= " LIMIT {$limit} OFFSET {$offset}";

    $products = findAllByQuery($query);

    echo json_encode($products);
}