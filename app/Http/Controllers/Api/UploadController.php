<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{

    public function uploadFile(Request $request)
    {
        $id = $request->input('id');
        $file = $request->file('file'); // получаем файл из запроса

        if ($file) {
            $extension = $file->getClientOriginalExtension(); // получаем расширение файла
            //$filename = hash_file('sha256', $file->getRealPath()); // генерируем уникальное имя файла на основе его содержимого
            $filename = md5_file($file->getRealPath());
            $filename = mb_convert_encoding($filename, 'UTF-8', 'auto'); // преобразуем имя файла в кодировку UTF-8
            $filename = $filename . '.' . $extension; // добавляем расширение файла
            $path = asset('storage/'.$filename); // сохраняем файл в папке "storage/app/public" с новым именем

            return response()->json(['path' => $path], 200); // возвращаем путь к файлу в ответе
        } else {
            return response()->json(['error' => 'File not found'], 400);
        }
    }

}
