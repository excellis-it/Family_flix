<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('ADMIN')) {
            $emails = EmailTemplate::orderBy('id', 'desc')->paginate(15);
            return view('admin.email.list', compact('emails'));
        } else {
            abort(404);
        }
    }

    public function fetchEmailseData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $emails = EmailTemplate::where('id', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orWhere('subject', 'like', '%' . $query . '%')
                ->orWhere('title', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->paginate(15);

            return response()->json(['data' => view('admin.email.filter', compact('emails'))->render()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('ADMIN')) {
            return view('admin.email.create');
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string:255|unique:email_templates,name',
            'subject' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $email = new EmailTemplate();
        $email->name = $request->name;
        $email->subject = $request->subject;
        $email->title = $request->title;
        $email->content = $request->content;
        $email->save();

        return redirect()->route('emails.index')->with('message', 'Email Template added successfully');
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
        if (auth()->user()->hasRole('ADMIN')) {
            $email = EmailTemplate::where('id', $id)->first();
            return view('admin.email.edit', compact('email'));
        } else {
            abort(404);
        }
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
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('email_templates', 'name')->ignore($id),
            ],
            'subject' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $email_template = EmailTemplate::findOrFail($id);
        $email_template->name = $request->name;
        $email_template->subject = $request->subject;
        $email_template->title = $request->title;
        $email_template->content = $request->content;
        $email_template->update();

        return redirect()->route('emails.index')->with('message', 'Email Template updated successfully');
    }


    public function delete($id)
    {
        if (auth()->user()->hasRole('ADMIN')) {
            EmailTemplate::findOrFail($id)->delete();
            return back()->with('error', 'Email Template deleted successfully');
        } else {
            abort(404);
        }
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
