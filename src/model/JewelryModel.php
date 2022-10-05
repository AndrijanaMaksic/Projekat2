<?php

namespace vebProjekat\model;

use vebProjekat\core\Database;

class JewelryModel
{
    public function findAll(){
        $database = Database::connect();
        $queryString = "SELECT * FROM jewelry";
        $query = mysqli_query($database,$queryString);
        return mysqli_fetch_all($query);
    }
}