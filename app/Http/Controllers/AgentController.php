<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Storage;

class AgentController extends Controller
{
     public function index()
    {
        session(['title' => 'Agents']);
        $agents = Agent::get();
        return view('agents.index', compact('agents'));
    }

    public function create()
    {
        session(['title' => 'Create Agent']);

        $agent = new Agent();

        return view('agents.create', compact('agent'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agent_name' => 'required',
            'phone' => 'required',
        ]);


        if ($request->agent_id) {
            $agent = Agent::find($request->agent_id);
            $message = "Agent has been updated successfully";
        } else {
            $agent = new Agent();
            $agent->phone = str_replace(' ', '', strtoupper($request->agent_name));
            $message = "Agent has been added successfully";

        }
        $agent->agent_name = $request->agent_name;
        $agent->phone = $request->phone;

       if ($request->hasFile('profile_pic')) {
            $imageName = time() . "." . $request->profile_pic->extension();
            $request->profile_pic->storeAs('public/agents', $imageName);
            $agent->profile_pic = url(Storage::url('agents/' . $imageName));
        }


        $agent->save();

        return redirect()->route('index.agents')
            ->with('message', $message);
    }


    public function edit($id)
    {
        session(['title' => 'Edit Agent']);

        $agent = Agent::find($id);

        return view('agents.create', compact('agent'));
    }


    public function confirmDelete($id){
        session(['title' => 'Confirm Delete']);
        $agent = Agent::find($id);
        return view('agents.confirm_delete', compact('agent'));
    }

    public function delete(Request $request){
        $agent = Agent::find($request->id);

        $agent->delete();

        return redirect()->route('index.agents');
    }


    public function getAgents()
    {
        $agents = Agent::get();
        return response()->json($agents);
    }

    public function search(Request $request)
    {
        $builder = Agent::query()->with('phone');
        $builder->where('phone', '%' . $request->input('query') . '%');
        return response()->json($builder->get());
    }

    public function getAgent($id)
    {
        // Get a single category
        $agent = Agent::find($id);
        return response()->json($agent);
    }


    public function show($category_id)
    {
        $agent = Agent::find($category_id);

        return view('agents.show', compact('agent'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'agent_name' => 'required',
            'phone' => 'required',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $agent = Category::find($id);
        $agent->agent_name = is_null($request->agent_name) ? $agent->agent_name : $request->agent_name;
        $agent->phone = is_null($request->phone) ? $agent->phone : $request->phone;

        if ($image = $request->file('profile_pic')) {
            $destinationPath = 'profile_pic/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $agent['profile_pic'] = "$profileImage";
        }

        $agent->save();

        return redirect()->route('agents.index')
            ->with('success', 'Agent Has Been updated successfully');
    }

    public function destroy(agent $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')
            ->with('success', 'Agent has been deleted successfully');
    }
}


