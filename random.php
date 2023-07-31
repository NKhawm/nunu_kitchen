<?php

$query = "SELECT r.author_id, r.title, u.id,u.firstname 
          FROM recipes AS r
          JOIN users AS u ON r.author_id = u.id
          ORDER BY r.id DESC";


$query ="SELECT users.id, recipes.name
        FROM users
        JOIN recipes
        ON users.id = recipes.author_id";
