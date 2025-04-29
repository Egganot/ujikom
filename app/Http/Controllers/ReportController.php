<?php

namespace App\Http\Controllers;

use App\DataTables\ReportDataTable;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(ReportDataTable $dataTable)
    {
        return $dataTable->render('pages.report.index');
    }
}
