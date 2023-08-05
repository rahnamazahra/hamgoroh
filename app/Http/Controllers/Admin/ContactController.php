<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::query()->first();

        return view('admin.contacts.index', ['contact' => $contact]);
    }

    /**
     * Show the form for creating a new resource.
     */
//    public function create()
//    {
//        return view('admin.abouts.create');
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
//            $validatedData = $request->validated();
            Contact::create($request->all());


            return redirect()->route('admin.contacts.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');

        } catch (\Exception $e) {
            return redirect()->route('admin.contacts.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
//    public function edit(About $about)
//    {
//        return view('admin.abouts.edit', ['about' => $about]);
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        try {

            $contact->update($request->all());


            return redirect()->route('admin.contacts.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->route('admin.contacts.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Contact $contact)
    {
        try {
            $contact->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
