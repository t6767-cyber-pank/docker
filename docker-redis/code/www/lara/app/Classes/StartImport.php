<?php
namespace App\Classes;

use App\Models\File;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;

class StartImport
{
    public function start()
    {
        // берем все не сделанные файлы
        $file = File::where("done", 0)->get();
        // если нет выводим сообщение
        if ($file->isEmpty()) return "NOTHING TO DO";
        $name=$file[0]->name;
        // Сохраняем начальные переменные статусов файлов
        Redis::hSet($name, 'name', $name);
        $this->setRedis($name);
        // import
        Redis::hSet("tst", 'name', "start progress");
        Excel::import(new Import($name), 'storage/'.$name);
        Redis::hSet("tst", 'name', "end progress");
        return Redis::hGet($name, 'progress');
    }

    // set Redis varibles
    private function setRedis($nameFile)
    {
        $rprogress=Redis::hGet($nameFile, 'progress');
        if ($rprogress=="") Redis::hSet($nameFile, 'progress', 0);
    }
}
