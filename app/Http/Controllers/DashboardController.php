<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\bookings;
use App\Models\Experience;
use App\Models\inquiry;
use App\Models\Trip;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalBookings' => bookings::count(),
            'activeCustomers' => bookings::distinct('email')->count('customer_email'), // Counting unique customer emails
            'upcomingTours' => Trip::where('start_date', '>', now())->count(),
            'pendingbookingss' => bookings::where('status', 'pending')->count(),
            'totalExperiences' => Experience::count(),
            'publishedBlogs' => Blog::count(),
            'pendingBookings' => bookings::where('status', 'pending')->count(),
        ];

        // Get upcoming bookingss (no revenue calculation)
        $recentbookings = bookings::with(['trip'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($bookings) {
                return [
                    'id' => $bookings->id,
                    'customer' => $bookings->full_name, // Assuming customer_name is stored
                    'tour' => optional($bookings->trip)->title,
                    'date' => optional($bookings->trip)->start_date,
                    'status' => $bookings->status,
                ];
            });

        // Get calendar events (e.g., upcoming trips)
        $calendarEvents = $this->getCalendarEvents();

        $monthlyBookings = Bookings::selectRaw('COUNT(id) as bookings, DATE_FORMAT(created_at, "%Y-%m") as month')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('bookings', 'month');

    // Fetch monthly inquiries
    $monthlyInquiries = Inquiry::selectRaw('COUNT(id) as inquiries, DATE_FORMAT(created_at, "%Y-%m") as month')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('inquiries', 'month');

    // Merge bookings and inquiries into one dataset
    $months = $monthlyBookings->keys()->merge($monthlyInquiries->keys())->unique()->sort();
    $monthlyData = $months->map(function ($month) use ($monthlyBookings, $monthlyInquiries) {
        return [
            'month' => $month,
            'bookings' => $monthlyBookings[$month] ?? 0,
            'inquiries' => $monthlyInquiries[$month] ?? 0,
        ];
    });

        return view('dashboard', compact(
            'stats',
            'recentbookings',
            'calendarEvents',
            'monthlyBookings',
            'monthlyInquiries',
            'monthlyData'
        ));
    }

    private function getCalendarEvents()
    {
        // Logic to fetch calendar events
        return [];
    }
}
