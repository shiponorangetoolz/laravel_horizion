<?php

namespace App\Helper;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Helpers
{
    public static function runner($items)
    {
        $insertData = [];

        foreach ($items as $key => $item) {
            $contact = 100000000 .''.$item;

            $db = new DbHelpers();

            $duplicate = $db->checkDuplicate($contact);

            if (is_null($duplicate)) {
                $insertData[] = [
                    'contact' => $contact,
                ];
            }
        }

        $db = new DbHelpers();
        $db->insert($insertData);
    }

    public static function runnerTwo($items)
    {
        Log::info('Start of process file : ', [Carbon::now()->format('Y-m-d H:i:s')]);

        $itemsArray = [];

        foreach (range(0, (int) $items) as $key => $item) {
            $itemsArray[] = $item;

            if (count($itemsArray) > 999) {
                $contact = 100 .''.$item;

                $db = new DbHelpers();

                $duplicate = $db->checkDuplicate($contact);

                if (is_null($duplicate)) {
                    Contact::create([
                        'contact' => $contact,
                    ]);
                }

                $itemsArray = [];
            }
        }

        try {
            DB::connection()->getPDO();
            echo DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
            echo 'None';
        }

        Log::info('End of process file : ', [Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
