<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $noUser = "nouser.png";
    protected static $database;

    protected static function firebaseDatabaseInstance() {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/feelsewglam-d6dc1-firebase-adminsdk-dcrul-6ad05d6771.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        return $firebase->getDatabase();
    }
}
