<?php

//-----------------------------------------
// pdo_utilities.php
//-----------------------------------------

function queryAll(string $sql, array $params = []): array
{
    require '../db/pdo.php';
    $statement = $db->prepare($sql);
    $statement->execute($params);
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $items;
}

function query(string $sql, array $params = [], int $index = 0): ?array
{
    $result = queryAll($sql, $params);
    if (count($result) == 0) {
        return null;
    }

    return $result[$index];
}
