<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::get();

        return view('adminPanel.donations.index', compact('donations'));
    }

    public function show(Donation $donation)
    {
        return view('adminPanel.donations.show', compact('donation'));
    }

    public function assign_driver(Donation $donation)
    {
        $donation->update(['driver_id', request('driver_id')]);

        return back();
    }
}
