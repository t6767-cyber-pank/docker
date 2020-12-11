<?php

namespace App\Http\Controllers;

use App\Classes\Import;
use App\Classes\StartImport;
use App\Jobs\runImport;
use App\Models\File;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isEmpty;

class ExcelController extends Controller
{
    // start import
    public function import()
    {
        $job = (new runImport());
        $this->dispatch($job);
        return "job add to queue";
    }

    // dispatch now
    public function importNow()
    {
        $this->dispatchNow(new runImport());
    }


}
