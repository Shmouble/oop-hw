<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function get()
    {
        if(!Session::has('FileManagerPath')){
            Session::put('FileManagerPath', 'public');
        }

        $path = Session::get('FileManagerPath');

        $directoriesNames = $this->getDirectories($path);
        $filesNames = $this->getFiles($path);

        return view('layouts.filemanager', compact('directoriesNames', 'filesNames', 'path'));
    }

    public function getFolder($folderName)
    {
        if(Session::has('FileManagerPath'))
        {
            if (Storage::disk('local') -> exists(Session::get('FileManagerPath') . "/" . $folderName)){
                Session::put('FileManagerPath', Session::get('FileManagerPath') . "/" . $folderName);
                $path = Session::get('FileManagerPath');

                $directoriesNames = $this->getDirectories($path);
                $filesNames = $this->getFiles($path);

                return view('layouts.filemanager', compact('directoriesNames', 'filesNames', 'path'));
            }
            else{
                return abort(404);
            }
        }
        else{
            return abort(404);
        }
    }

    // Чтобы подняться вверх по папкам
    public function goUp()
    {
        if(Session::has('FileManagerPath'))
        {
            if(Session::get('FileManagerPath') != 'public'){

                $path = explode("/", Session::get('FileManagerPath'));

                $tmp = '';

                for($i=0; $i<count($path)-1; $i++)
                {
                    $tmp = $tmp . $path[$i] . "/";
                }

                $tmp = rtrim($tmp, "/ ");
                Session::put('FileManagerPath', $tmp);
                $path = Session::get('FileManagerPath');

                $directoriesNames = $this->getDirectories($path);
                $filesNames = $this->getFiles($path);

                return view('layouts.filemanager', compact('directoriesNames', 'filesNames', 'path'));
            }
        }
        else{
            return abort(404);
        }
    }

    // Чтобы сохранять файл
    public function upload(Request $request)
    {
        if($_FILES['file'] && $_FILES['file']['error'] == 0){
            Storage::put(Session::get('FileManagerPath') . "/", $request->file('file'));
        }
    }

    // Чтобы создать папку
    public function create($newFolderName)
    {
        if(Session::has('FileManagerPath')){
            if (!Storage::disk('local') -> exists(Session::get('FileManagerPath') . "/" . $newFolderName)){
                Storage::disk('local') -> makeDirectory(Session::get('FileManagerPath') . "/" . $newFolderName);
            }
            else{
                return abort(403);
            }
        }
        else{
            return abort(404);
        }
    }

    // Чтобы удалить файл
    public function delete($fileName)
    {
        if(Session::has('FileManagerPath')){
            if(Storage::disk('local') -> exists(Session::get('FileManagerPath') . "/" . $fileName)){
                Storage::disk('local') -> delete(Session::get('FileManagerPath') . "/" . $fileName);
            }
            else{
                return abort(403);
            }
        }
        else{
            return abort(404);
        }
    }

    // Получаем имена папок в текущей папке
    private function getDirectories($path)
    {
        $directories = Storage::directories($path);

        $directoriesNames = [];

        foreach ($directories as $directory)
        {
            $directory = explode('/', $directory);
            $directoriesNames[] = $directory[count($directory) - 1];
        }

        return $directoriesNames;
    }

    // Получаем имена файлов в текущей папке
    private function getFiles($path)
    {
        $filesInFolder = Storage::files($path);

        $filesNames = [];

        foreach ($filesInFolder as $file)
        {
            $file = explode('/', $file);
            $filesNames[] = $file[count($file) - 1];
        }

        return $filesNames;
    }
}
