<?php

namespace App\Http\Controllers\Export;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Exports\ParticipantsExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

class ParticipantEventExportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Excel::download(new ParticipantsExport($request->event), 'participants.csv', ExcelExcel::CSV);
    }
}
