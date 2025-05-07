<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
    $username = $request->input('username');
    $password = $request->input('password');

    // Simpan username ke session
    session(['username' => $username]);

    return redirect()->route('dashboard');
    }

    public function dashboard(Request $request)
    {
        $username = session('username', 'Guest');
        return view('dashboard', ['username' => $username]);
    }

    public function profile(Request $request)
    {
        $username = session('username', 'Guest');
        return view('profile', ['username' => $username]);
    }

    public function pengelolaan()
    {
    $tugas = [
        ['id' => 1, 'judul' => 'Tugas PWEB', 'deadline' => '2025-05-05'],
        ['id' => 2, 'judul' => 'Makalah Etika Profesi', 'deadline' => '2025-05-15'],
        ['id' => 3, 'judul' => 'Presentasi Proyek Akhir', 'deadline' => '2025-05-07'],
    ];

    foreach ($tugas as &$item) {
        $deadline = Carbon::parse($item['deadline']);
        $hariIni = Carbon::now()->startOfDay();

        if ($deadline->isToday()) {
            $item['status'] = 'today';
            $item['sisa'] = 'Deadline hari ini';
        } elseif ($deadline->isPast()) {
            $item['status'] = 'overdue';
            $item['sisa'] = 'Sudah lewat';
        } else {
            $daysLeft = $hariIni->diffInDays($deadline);
            $item['status'] = 'upcoming';
            $item['sisa'] = $daysLeft . ' hari lagi';
        }
    }

    return view('pengelolaan', ['tugas' => $tugas]);
    }

    public function logout()
    {
    session()->forget('username');
    return redirect()->route('login');
    }

}
