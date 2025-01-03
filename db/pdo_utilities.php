<?php

//-----------------------------------------
// pdo_utilities.php
//-----------------------------------------

function queryAll($sql, $params = [])
{
    require '../db/pdo.php';
    $statement = $db->prepare($sql);
    $statement->execute($params);
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $items;
}

function query($sql, $params = [], $index = 0)
{
    $result = queryAll($sql, $params);
    if (count($result) == 0) {
        return null;
    }

    return $result[$index];
}
