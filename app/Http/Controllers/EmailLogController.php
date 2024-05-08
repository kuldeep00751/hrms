<?php

namespace App\Http\Controllers;

use App\DataTables\EmailLogsDataTable;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(EmailLogsDataTable $dataTable)
    {
        return $dataTable->render('pages.communication.email_log.index');
    }
}
