<?php

namespace App\Http\Controllers;

use App\Functional\Lenta\ILenta;
use Illuminate\Http\Request;

class LentaController extends Controller
{
    private $_lenta;

    public function __construct(ILenta $lenta)
    {
        $this->_lenta = $lenta;
    }
    public function index(Request $request) {
        $result = $this->_lenta->Index($request);
        return $result;
    }

    public function getInfo(Request $request) {
        $result = $this->_lenta->Info($request);
        return $result;
    }

    public function Comments(Request $request) {
        $result = $this->_lenta->Comments($request);
        return $result;
    }

    public function AddComment(Request $request) {
        $result = $this->_lenta->AddComment($request);
        return $result;
    }
}
