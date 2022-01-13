<?php


function InsertTag($pdo, $user_id, $string_tag)
{
    $tag_id_array = array(); //arrayの初期化
    $tag = explode("#", $string_tag);
    foreach ($tag as $t) {
        $sql = "insert into tags (tag, user_id) values (:tag, :user_id)";
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':tag', $t, PDO::PARAM_STR);
        $sth->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $result = $sth->execute();

        $last_tag_id = $pdo->lastInsertId();
        array_push($tag_id_array, $last_tag_id);
        return $tag_id_array;
    }
}

function InsertApl_tag($pdo, $last_dead_id, $tag_id_array)
{
    foreach ($tag_id_array as $t) {
        $sql = "insert into apl_tag (apl_id, tag_id) values(:apl_id, :tag_id)";
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':apl_id', $last_dead_id);
        $sth->bindValue(':tag_id', $t);
        $result = $sth->execute();
    }
}
