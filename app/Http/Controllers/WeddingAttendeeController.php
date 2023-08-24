<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeddingAttendee;
use Symfony\Component\Console\Input\Input;

class WeddingAttendeeController extends Controller
{

    /**
     * @var WeddingAttendee
     */
    protected WeddingAttendee $weddingAttender;

    /**
     * @param WeddingAttendee $weddingAttendee
     */
    public function __construct(
        WeddingAttendee $weddingAttendee
    ) {
        $this->weddingAttender = $weddingAttendee;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->weddingAttender->getCustomData();
        $weddingAttender = $this->weddingAttender::paginate(5);
        return view('index', compact('weddingAttender'))->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->weddingAttender::create($request->all());
        return redirect()->route('wedding_attendee.index')->with('info', 'Thêm mới người tham dự thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attender = $this->weddingAttender::find($id);
        return view('edit', compact('attender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $attender, $id)
    {
        $attender = $this->weddingAttender::find($attender);
        $attender->update(['phone' => $request->phone]);
        return redirect()->route('wedding_attendee.index')->with('info', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attender = $this->weddingAttender::find($id);
        $attender->delete();
        return redirect()->route('wedding_attendee.index')->with('info', 'Xóa thành công người tham dự có só điện thoại là ' . $attender->phone . ' !');
    }
}
