<?php
//tag to task id. if gone, delete. if new, insert. if present, update. flawed, what if new task 
function taskUpdate($pdo) {
    $stmt = $pdo->prepare('DELETE from');
}
