<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();

        return view('pages.contacts.index', [
            'contactsList' => $contacts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        dd($request->all());


        return view('pages.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationData = $request->validate([
            'name' => 'required|min:5|max:255',
            'contact' => 'required|numeric|min:9|max:9',
            'email' => 'required|email|unique:contacts|max:255'
        ]);

        DB::beginTransaction();
        $contact = new Contact();
        try {
            $contact->fill($validationData);
            $contact->save();

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            dd($t->getMessage());
        }

        return redirect()->route('contacts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('pages.contacts.show', [
            'contact' => $contact
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('pages.contacts.edit', [
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validationData = $request->validate([
            'name' => 'required|min:5|max:255',
            'contact' => 'required|min:9|max:9',
            'email' => 'required|email|unique:contacts|max:255'
        ]);

        DB::beginTransaction();
        try {
            $contact->fill($validationData);
            $contact->update();

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            dd($t->getMessage());
        }

        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        DB::beginTransaction();

        try {
            $contact->delete();

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            dd($t->getMessage());
        }

        return redirect()->route('contacts.index');
    }
}
