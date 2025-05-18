<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'professional_id' => 'required|exists:professionals,id',
            'client_id' => 'required|exists:clients,id',
            'date_time' => 'required|date',
            'duration' => 'required|integer|min:30',
        ]);

        $booking = Booking::create($validated);
        return response()->json($booking, 201);
    }
}
