<?php

namespace Core\Features\Common\Contracts;

use Core\Features\Common\Data\Data;

interface Query
{
    /**
     * Execute the command.
     */
    public function execute(Data $data): Data;
}
