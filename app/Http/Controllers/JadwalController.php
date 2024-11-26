<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil parameter sorting dari URL
        $sortColumn = $request->get('sort', 'duedate'); // Default kolom adalah 'duedate'
        $sortDirection = $request->get('direction', 'asc'); // Default arah adalah 'asc'
    
        // Ambil kata kunci pencarian
        $search = $request->get('search'); // 'search' adalah nama input dari form
        
        // Query data jadwal dengan sorting dan pencarian
        $jadwal = Jadwal::with('task')
            ->when($search, function ($query, $search) {
                $query->where('status', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhereHas('task', function ($query) use ($search) {
                        $query->where('task', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy($sortColumn, $sortDirection) // Tambahkan logika sorting
            ->get();
    
        // Return ke view
        return view('jadwal.index', compact('jadwal', 'sortColumn', 'sortDirection', 'search'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required',
            'description' => 'required',
            'duedate' => 'required',
            'status' => 'required|in:selesai,belum,pending'
        ]);

        Jadwal::create([
            'task_id'=>$request->get('task'),
            'description'=>$request->get('description'),
            'duedate'=>$request->get('duedate'),
            'status'=>$request->get('status')
        ]);

        return redirect()->route('jadwal.index')->with('message', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal = Jadwal::find($id);
        return view('jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required',
            'description' => 'required',
            'duedate' => 'required',
            'status' => 'required|in:selesai,belum,pending'
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->task_id = $request->task;
        $jadwal->description = $request->description;
        $jadwal->duedate = $request->duedate;
        $jadwal->status = $request->status;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('message', 'Jadwal berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('message', 'Jadwal berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:selesai,belum,pending',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->status = $request->status; // Perbarui status
        $jadwal->save(); // Simpan perubahan

        return redirect()->back()->with('message', 'Status berhasil diperbarui!');
    }
}
