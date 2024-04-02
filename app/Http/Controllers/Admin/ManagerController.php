<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ImageTrait;

class ManagerController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $managers = User::role('MANAGER')->orderBy('id', 'desc')->paginate(15);
        return view('admin.manager.list',compact('managers'));
    }

    public function managerAjaxList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $managers = User::role('MANAGER')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('id', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('phone', 'like', '%' . $query . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

            return response()->json(['data' => view('admin.manager.filter', compact('managers'))->render()]);
        }
    }

    public function changeStatus(Request $request)
    {
        
        $manager = User::find($request->user_id);
        $manager->status = $request->status;
        $manager->save();
        return response()->json(['success' => 'Status changed successfully']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'status' => 'required',
        ]);

        //store data
        $manager = new User();
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->phone = $request->phone;
        $manager->password = bcrypt($request->password);
        $manager->status = $request->status;

        if($request->hasFile('profile_picture')){
            $manager->image = $this->imageUpload($request->file('profile_picture'), 'Manager')['filePath'];
        }
        $manager->save();
        $manager->assignRole('MANAGER');
       

        return redirect()->route('managers.index')->with('message', 'Manager created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manager = User::find($id);
        return view('admin.manager.edit',compact('manager'));
    }

    public function managerDelete($id)
    {
        $manager = User::find($id);
        $manager->delete();
        
        return redirect()->route('managers.index')->with('message', 'Manager deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'status' => 'required',
        ]);

        //store data
        $manager = User::find($id);
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->phone = $request->phone;
        $manager->status = $request->status;
        if($request->hasFile('profile_picture')){
            $manager->image = $this->imageUpload($request->file('profile_picture'), 'Manager')['filePath'];
        }
        if ($request->password != null) {
            $request->validate([
                'password' => 'min:8',
                'confirm_password' => 'min:8|same:password',
            ]);
            $manager->password = bcrypt($request->password);
        }
        $manager->update();

        return redirect()->route('managers.index')->with('message', 'Manager updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
