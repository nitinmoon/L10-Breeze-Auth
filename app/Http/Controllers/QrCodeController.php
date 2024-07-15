<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;

class QrCodeController extends Controller
{
    public function generate()
    {
        $user = User::findOrFail(1); #Fetch the user details

        // Generate a URL that links to a route or endpoint showing user details
        $url = route('qrcode.user.details', ['id' => $user->id]);

        // Generate QR code with the URL
        $qrcode = QrCode::size(300)->generate($url);

        return view('qrcode.qrcode', compact('qrcode', 'user'));
    }

    public function userdetails()
    {
        $user = User::findOrFail(1); #Fetch the user details
        return view('qrcode.user-details', compact('user'));
    }
    
}
