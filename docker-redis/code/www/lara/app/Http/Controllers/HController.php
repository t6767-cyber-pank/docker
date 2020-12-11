<?php

namespace App\Http\Controllers;

use App\Events\ChatMessage;
use App\Models\File;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Matrix\Exception;
use Predis\Command\KeyRandom;

class HController extends Controller
{
    // upload xls file
    public function upload(Request $request)
    {
        $this->validate($request, [
            'fileToUpload' => 'required|mimes:xls,xlsx',
        ]);

        $num = rand(0, 1000000000000000);
        if (isset($request->fileToUpload)) {
            try {
                Storage::putFileAs('public', $request->fileToUpload, $num . $request->fileToUpload->getClientOriginalName());
                File::create([
                    'name' => $num . $request->fileToUpload->getClientOriginalName(),
                    'done' => 0
                ]);
                return "OK";
            } catch (Exception $e) {
            }
        }
    }

    // test Redis пришлось помучиться с докером чтобы его правильно установить
    public function show()
    {
        $user=User::all()[0];
        var_dump(event(new ChatMessage('hello world', $user)));
        $user=User::all()[1];
        event(new ChatMessage('hello world1', $user));
        return Redis::hGet("tst", 'name');
    }

    //show pusher
    public function showPusher()
    {
        return view("pusher");
    }

    // show all records
    public function showAll()
    {
        $data=Test::all()->sortByDesc('date');
        return view("output", ["Data" => $data]);
    }
}
