<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function pageCopiasSeguridad()
    {
        $disk = Storage::disk('local');
        $files = $disk->files('backups');
        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'path' => $file,
                'size' => $disk->size($file),
                'last_modified' => $disk->lastModified($file),
            ];
        }

        return view('admin.backup.list', compact('backups'));
    }

    // Método para ejecutar el backup
    public function runBackup()
    {
        try {
            Artisan::call('backup:run');
            return redirect()->back()->with('success', 'Backup ejecutado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar el backup: ' . $e->getMessage());
        }
    }


    public function downloadBackup($file)
    {
        $filePath = 'backups/' . $file;

        if (Storage::disk('local')->exists($filePath)) {
            return Storage::disk('local')->download($filePath);
        }

        return redirect()->back()->with('error', 'El archivo de backup no existe.');
    }

    public function deleteBackup($name)
    {
        $filePath = 'backups/' . $name;

        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
            return back()->with('success', 'Backup eliminado exitosamente.');
        }

        return back()->with('error', 'No existe el archivo del backup.');
    }
}
