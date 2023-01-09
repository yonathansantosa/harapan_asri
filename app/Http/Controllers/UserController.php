<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
  public function __construct()
  {
    $this->Penghuni = new Penghuni();
  }
}
