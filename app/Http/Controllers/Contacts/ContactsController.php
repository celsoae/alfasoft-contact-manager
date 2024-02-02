<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::where('name', 'like', '%' . $search . '%')
            ->paginate(10);
        return view('pages.contacts.index', [
            'contactsList' => $contacts,
            'search' => $search
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
            'contact' => [
                'required',
                'numeric',
                'digits:9',
                Rule::unique('contacts')->whereNull('deleted_at')
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('contacts')->whereNull('deleted_at')
            ]
        ]);

        DB::beginTransaction();
        $contact = new Contact();
        try {
            $contact->fill($validationData);
            $contact->save();

            DB::commit();
            return redirect()->route('contacts.index')->with(['success' => 'Contact created successfully!']);
        } catch (\Throwable $t) {
            DB::rollBack();
            return redirect()->route('contacts.index')->with(['error' => 'Error' . $t->getMessage()]);
        }
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
            'contact' => [
                'required',
                'digits:9',
                Rule::unique('contacts')->ignore($contact->id)->whereNull('deleted_at'),

            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('contacts')->ignore($contact->id)->whereNull('deleted_at')
            ]
        ]);

        DB::beginTransaction();
        try {
            $contact->fill($validationData);
            $contact->update();

            DB::commit();
            return redirect()->route('contacts.index')->with(['success' => 'Contact updated successfully!']);
        } catch (\Throwable $t) {
            DB::rollBack();

            return redirect()->route('contacts.index')->with(['error' => 'Error' . $t->getMessage()]);
        }
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
