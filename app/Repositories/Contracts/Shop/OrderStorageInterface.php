<?php

namespace App\Repositories\Contracts\Shop;

interface OrderStorageInterface {

    public function addItem($data);

    public function removeItem($id);

    public function get();
}
