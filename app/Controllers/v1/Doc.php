<?php

namespace App\Controllers\v1;

class Doc extends \App\Controllers\BaseController
{
    /**
     * @param int $version
     * @return mixed|string
     */
    public function index(int $version = 1)
    {
        $data = [
            'version' => $version,
        ];

        return view('swagger', $data);

    }

    //--------------------------------------------------------------------

}
