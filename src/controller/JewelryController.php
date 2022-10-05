<?php

namespace vebProjekat\controller;

use vebProjekat\core\Application;
use vebProjekat\model\JewelryModel;

class JewelryController
{
    public JewelryModel $jewelryModel;

    public function __construct(){
        $this->jewelryModel = new JewelryModel();
    }
    public function getJewelryList(){
        $preview = file_get_contents("C:\Users\Andrijana\OneDrive - Prirodno-matematički fakultet Univerziteta u Nišu\Radna površina\\vebProjekat\src\\view\jewelry.twig");
        $items = '';
        $jewelryList = $this->jewelryModel->findAll();
        foreach ($jewelryList as $jewelry){
            $item = file_get_contents("C:\Users\Andrijana\OneDrive - Prirodno-matematički fakultet Univerziteta u Nišu\Radna površina\\vebProjekat\src\\view\jewelryItem.twig");
            $item = str_replace("{{ price }}", $jewelry[2],$item);
            $items = $items.$item;
        }
        $preview = str_replace("{{ content }}", $items, $preview);
        return $preview;
    }
}