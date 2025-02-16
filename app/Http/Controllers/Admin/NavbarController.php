<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Navbar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NavbarController extends Controller
{
    public function __construct(){
        $this->middleware(["XssSanitizer"]);
    }
    
    public function index()
    {
        $navbar = Navbar::whereNull('parent_id')
            ->with('navbars')
            ->orderBy('id', 'asc')
            ->get();
        $title = "Navbar List";
        return view('backend/pages/navbar/index', compact('navbar','title'));
    }

    public function create()
    {
        $title = "Create Navbar";
        $navbars = Navbar::whereNull('parent_id')->with('childrenNavbars')->get();
        return view('backend/pages/navbar/create', compact('navbars','title'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'route' => 'required',
            'ordering' => 'nullable',
        ]);

        $input = $request->all();

        if (empty($input['ordering'])) {
            $order = Navbar::max('ordering');
            $new_order = $order + 1;
            $input['ordering'] = $new_order;
        }
        $input['slug'] = Str::slug($request->name, '-');

        $navbar = Navbar::create($input);
        return redirect()->route('admin.navbar.index')->with('success_msg', 'Navbar created');
    }

    public function edit(Navbar $navbar)
    {
        $title = "Edit Navbar";
        $navbars = Navbar::whereNull('parent_id')->with('childrenNavbars')->get();
        return view('backend/pages/navbar/edit', compact('navbar','navbars','title'));
    }

    public function update(Request $request, Navbar $navbar)
    {
        $request->validate([
            'name' => 'required',
            'route' => 'required',
            'ordering' => 'nullable',
        ]);

        $input = $request->all();

        if (empty($input['ordering'])) {
            $order = Navbar::max('ordering');
            $new_order = $order + 1;
            $input['ordering'] = $new_order;
        }

        if ($request->has('status') && $request->status == 1) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $input['slug'] = Str::slug($request->name, '-');

        $navbar->update($input);
        return redirect()->route('admin.navbar.index')->with('success_msg', 'Navbar Updated');
    }

    
    public function destroy(Navbar $navbar)
    {
        $navbar->delete();
        return redirect()->route('admin.navbar.index')->with('success_msg', 'Navbar Deleted successfully.');
    }
}
