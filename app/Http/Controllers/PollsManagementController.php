<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Poll;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;

class PollsManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::paginate();
        return View('pollsmanagement.show-polls', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('pollsmanagement.create-poll', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => 'required|max:255|unique:polls',
                'description'            => 'nullable|string',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $params = $request->all();
        if(isset($params['activated']) && $params['activated'] == 'on')
            $params['activated'] = true;
        $poll = Poll::create($params);

        return redirect('polls')->with('success', trans('pollsmanagement.createSuccess'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Poll $poll
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {

        return view('pollsmanagement.edit-poll', compact('poll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Poll                     $poll
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255|unique:polls,name,'.$poll->id,
            'description'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $params = $request->all();
        if(isset($params['activated']) && $params['activated'] == 'on')
            $params['activated'] = true;
        $poll->update($params);
        return back()->with('success', trans('pollsmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Poll $poll
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
            $poll->delete();

            return redirect('polls')->with('success', trans('pollsmanagement.deleteSuccess'));
    }

    /**
     * Method to search the polls.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('poll_search_box');
        $searchRules = [
            'poll_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'poll_search_box.required' => 'Search term is required',
            'poll_search_box.string'   => 'Search term has invalid characters',
            'poll_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Poll::where('id', 'like', $searchTerm.'%')
                            ->orWhere('name', 'like', $searchTerm.'%')
                            ->orWhere('email', 'like', $searchTerm.'%')->get();

        // Attach roles to results
        foreach ($results as $result) {
            $roles = [
                'roles' => $result->roles,
            ];
            $result->push($roles);
        }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
