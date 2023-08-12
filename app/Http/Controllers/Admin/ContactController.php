<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Exception;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Contact::create($request->all());

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.contacts.index');

        } catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.contacts.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        try {
            $contact->update($request->all());

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');
            return redirect()->route('admin.contacts.index');
        } catch (\Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.contacts.index');
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
