<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::latest()->paginate(5);
      
        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);

        $path = $request->file('image')->store('public');

        // dd($imageName);
        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $path;
        $company->website = $request->website;
        $company->save();

        return redirect()->route('companies.index')
                        ->with('success','Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        if($request->hasFile('image')){

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            Company::where('id', $company->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $imageName,
            ]);
        }
        else {
            Company::where('id', $company->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
            ]);
        }
        
        
        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
         
        return redirect()->route('companies.index')
                        ->with('success','Company deleted successfully');
    }
}
