<?php
namespace App\Classes;

use App\Models\File;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Concerns\ToModel;

class Import implements ToModel
{

    private $file;
    private $process;
    private $i;
    private $exit;
    private $limit;

    /**
     * Import constructor.
     * @param $nameFile
     */
    public function __construct($nameFile)
    {
        $this->file=$nameFile;
        $this->process=(int)Redis::hGet($nameFile, 'progress');
        $this->i=0;
        $this->exit=0;
        if ($this->process==0) { $this->limit=999; } else { $this->limit=999+$this->process; }
    }

    /**
     * @param array $row
     *
     * @return User
     */
    public function model(array $row)
    {
        if ($this->exit>0) return null;
        // проверяем на то заголовок ли это. Проверяем по первому парамметру
        if($row[0]=="id") {} else
        {
            if(isset($row[0])) {
                try {
                    $this->i++;
                    if ($this->i > $this->limit) $this->exit=1;
                    if($this->i>$this->process) {
                        Redis::hincrby($this->file, 'progress', 1);
                        Test::create([
                            'name' => $row[1],
                            'date' => $this->convertDate($row[2])
                        ]);
                    }
                } catch (QueryException $e) {
                }
            } else {
                File::where('name', $this->file)->update(['done' => 1]);
                return null;
            }
        }
    }

    // clean Excel string
    private function cleanString($str)
    {
        $str1 = str_replace('=A', '', $str);
        return str_replace('+1', '', $str1);
    }

    // convert time excel to time unix
    private function convertDate($str)
    {
        $UNIX_DATE = ((int)$str - 25569) * 86400;
        return gmdate("Y-m-d", $UNIX_DATE);
    }
}
