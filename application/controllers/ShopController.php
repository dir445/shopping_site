<?php

class ShopController extends Controller {
    public function listAction() {
        $products = $this->db_manager->get('Product')->getAll();
        return $this->render(['products' => $products]);
    }
}