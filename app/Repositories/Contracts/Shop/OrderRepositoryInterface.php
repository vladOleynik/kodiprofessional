<?php

namespace App\Repositories\Contracts\Shop;

interface OrderRepositoryInterface {

    /**
     * 
     * @param array $data
     */
    public function addItem($data);

    /**
     * 
     * @param string|int $id - Item id
     */
    public function removeItem($item);

    public function save($data);
    public function get();
    public function count();
}
