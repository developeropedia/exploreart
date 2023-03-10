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

    if(isset($_POST['userID']) && !empty($_POST['userID'])) {
        $query = "SELECT *, p.id AS productID, p.name AS productName, u.id AS userID, c.id AS catID, c.name AS catName FROM products p INNER JOIN users u on p.user_id = u.id INNER JOIN categories c on p.cat_id = c.id WHERE u.id = {$_POST['userID']}";
    } else if(isset($_POST['page']) && !empty($_POST['page'])) {
        $query = "SELECT *, p.id AS productID, p.name AS productName, u.id AS userID, c.id AS catID, c.name AS catName FROM art_purchases ap INNER JOIN products p ON p.id = ap.product_id INNER JOIN users u on p.user_id = u.id INNER JOIN categories c on p.cat_id = c.id WHERE ap.user_id = {$_SESSION['user']}";
    } else {
        $query = "SELECT *, p.id AS productID, p.name AS productName, u.id AS userID, c.id AS catID, c.name AS catName FROM products p INNER JOIN users u on p.user_id = u.id INNER JOIN categories c on p.cat_id = c.id";
    }

    if (!empty($q)) {
        $q = urldecode($q);
        if(isset($_POST['userID']) && !empty($_POST['userID'])) {
            $query .= " AND p.name LIKE '%{$q}%'";
        } else if(isset($_POST['page']) && !empty($_POST['page'])) {
            $query .= " AND p.name LIKE '%{$q}%'";
        } else {
            $query .= " WHERE p.name LIKE '%{$q}%'";
        }
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

if(isset($_POST['checkLogin'])) {
    if(!isset($_SESSION['user'])) {
        echo json_encode(['loggedIn' => false]);
    } else {
        echo json_encode(['loggedIn' => true]);
    }
}

if(isset($_POST['checkCredits'])) {
    $credits = $_POST['credits'];
    $user = findById("users", $_SESSION['user']);
    $subscription = findByQuery("SELECT * FROM subscriptions WHERE user_id = {$user->id} AND status = 1");
    if(!empty($subscription)) {
        if($user->credits < $credits) {
            echo json_encode(['credits' => "less"]);
        } else {
            echo json_encode(['credits' => "high"]);
        }
    } else {
        echo json_encode(['subscription' => "none"]);
    }
}

if(isset($_POST['confirmPurchase'])) {
    $productID = $_POST['productID'];
    $userID = $_SESSION['user'];

    $insertID = insert("art_purchases", ['user_id' => $userID, 'product_id' => $productID]);
    $user = findById("users", $userID);
    $product = findById("products", $productID);
    $credits = $user->credits - $product->price;

    if(!empty($insertID)) {
        update("users", ['credits' => $credits], "id", $userID);
        echo json_encode(['message' => "Congratulations! You have unlocked this art.", 'credits' => $credits]);
    } else {
        echo json_encode(['error', "Purchase was not successful! Try again later."]);
    }
}