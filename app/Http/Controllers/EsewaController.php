<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

require '../vendor/autoload.php';

use RemoteMerge\Esewa\Client;

class EsewaController extends Controller
{
    public function success(Request $req){
        try{
            $order=Order::findOrFail($req->query('oid'));
        $order->update(
            ['payment_status'=>'eswea']
        );
        return redirect()->route('track.order')->with('success', 'Your payment process is successfull !');
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            
        }

    }
    public function failure(){
        return redirect()->route('track.order')->with('error', 'Your payment process failed !');

    }
}
