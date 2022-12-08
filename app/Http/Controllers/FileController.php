<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessFile;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return bool
     */
    public static function index()
    {
        $itemArray = [];

        echo 'Start'.Carbon::now()->format('Y-m-d H:i:s');
        echo "\n";

        // Generate number between 1 to 1300000 rows
        foreach (range(1, 1300000) as $data) {
            $itemArray[] = $data;

            // Chunk array into 4999 rows.
            if (count($itemArray) > 4999) {
                ProcessFile::dispatch($itemArray);

                $itemArray = [];
            }
        }

        echo 'End'.Carbon::now()->format('Y-m-d H:i:s');
        echo "\n";

        return true;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public static function create()
    {
        $fileList = [500000, 200000, 300000, 400000];

        foreach ($fileList as $file) {
            ProcessFile::dispatch($file);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public static function store()
    {
        $file = File::create([
            'file_name' => 'File name',
            'file_url' => 'url',
        ]);

        // Create podcast...

        ProcessFile::dispatch($file);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return Response
     */
    public function destroy(File $file)
    {
        //
    }
}
