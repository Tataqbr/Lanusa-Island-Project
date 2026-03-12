<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class GuestController extends Controller
{
    public function Home()
    {
        $featuredResorts = DB::table('resorts')
        ->LeftJoin('destinations', 'resorts.destination_id', '=', 'destinations.id')
        ->LeftJoin('regions', 'destinations.region_id', '=', 'regions.id')
        ->select('resorts.*', 'resorts.id as id_resort', 'destinations.name as destination', 'regions.name as region')
        ->limit(3)
        ->where('regions.name', 'Bali & Nusa Tenggara')
        ->get();

        $dataMemberships = DB::table('membership')->select('*')->get();

        return view('guest.home', compact('featuredResorts', 'dataMemberships'));
    }

    public function destinations(Request $request)
    {
        // 1. Ambil semua region untuk Tab
        $regions = DB::table('regions')->get();

        // 2. Ambil ID Region yang terpilih (default ke id pertama jika tidak ada)
        $selectedRegionId = $request->get('region', $regions->first()->id ?? null);

        // 3. Ambil daftar destination berdasarkan region terpilih
        $destinations = DB::table('destinations')
            ->where('region_id', $selectedRegionId)
            ->get();

        // 4. Ambil ID Destination yang terpilih (optional filter)
        $selectedDestId = $request->get('destination');

        // 5. Query Utama Resorts
        $resorts = DB::table('resorts')
            ->join('destinations', 'resorts.destination_id', '=', 'destinations.id')
            ->join('regions', 'destinations.region_id', '=', 'regions.id')
            ->select(
                'resorts.*', 
                'destinations.name as destination_name', 
                'regions.name as region_name'
            )
            ->where('destinations.region_id', $selectedRegionId)
            ->when($selectedDestId, function($query) use ($selectedDestId) {
                return $query->where('resorts.destination_id', $selectedDestId);
            })
            ->get();

        return view('guest.destinations', compact(
            'regions', 
            'destinations', 
            'resorts', 
            'selectedRegionId', 
            'selectedDestId'
        ));
    }

    public function resortDetail($slug)
    {
        // Detail Resort dengan Join untuk info lengkap
        $resort = DB::table('resorts')
            ->join('destinations', 'resorts.destination_id', '=', 'destinations.id')
            ->join('regions', 'destinations.region_id', '=', 'regions.id')
            ->select(
                'resorts.*', 
                'destinations.name as destination_name', 
                'regions.name as region_name'
            )
            ->where('resorts.slug', $slug)
            ->first();

        if (!$resort) {
            abort(404);
        }

        return view('guest.resort-detail', compact('resort'));
    }

    public function memberships()
    {
         $dataMemberships = DB::table('membership')->select('*')->get();

        return view('guest.memberships', compact('dataMemberships'));
    }

        public function membershipDetail($slug)
    {
        // Detail membership dengan Join untuk info lengkap
        $membership = DB::table('membership')
            ->select('*')
            ->where('membership.slug', $slug)
            ->first();

        if (!$membership) {
            abort(404);
        }

        return view('guest.membership-detail', compact('membership'));
    }

public function collections()
{
    // Menggunakan Query Builder untuk mengambil resort termahal per destinasi
    $dataCollections = DB::table('destinations')
        ->join('resorts', 'destinations.id', '=', 'resorts.destination_id')
        ->select(
            'destinations.name as destination_name',
            'destinations.image as destination_bg',
            'resorts.id',
            'resorts.name as resort_name',
            'resorts.slug as resort_slug',
            'resorts.price',
            'resorts.description',
            'resorts.images',
            'resorts.facilities'
        )
        // Logika untuk mengambil hanya baris dengan harga tertinggi di setiap destination_id
        ->whereIn('resorts.price', function ($query) {
            $query->select(DB::raw('MAX(price)'))
                  ->from('resorts')
                  ->groupBy('destination_id');
        })
        ->get();

    return view('guest.collections', compact('dataCollections'));
}

public function downloadFaqBrochure()
{
    // Mengonversi Logo ke Base64 agar terbaca DomPDF
    $path = public_path('assets/logo.png'); // Pastikan file ada
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $dataLogo = file_exists($path) ? file_get_contents($path) : null;
    $logoBase64 = $dataLogo ? 'data:image/' . $type . ';base64,' . base64_encode($dataLogo) : null;

    $data = [
        'logo' => $logoBase64,
        'title' => 'Institutional Clarity',
        'subtitle' => 'Frequently Asked Questions',
        'company' => 'PT Raga Nusa Property',
        'date' => date('F d, Y'),
    ];

    $pdf = Pdf::loadView('pdf.faq_brochure', $data);
    $pdf->setPaper('a4', 'portrait');

    return $pdf->download('Lanusa-Island-FAQ-Guidelines.pdf');
}
}