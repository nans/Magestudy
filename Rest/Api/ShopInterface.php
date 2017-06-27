<?php

namespace Magestudy\Rest\Api;

interface ShopInterface
{
    /**
     * @param int $id
     * @return array
     */
    public function getPhone($id);

    /**
     * @return array
     */
    public function postPhone();

    /**
     * @return array
     */
    public function phones();

    /**
     * @param string $customerPhone
     * @param int $id
     * @return array
     */
    public function buy($customerPhone, $id);
}