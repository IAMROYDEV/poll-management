<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Question;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;

class QuestionsManagementController extends Controller
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
        $questions = Question::paginate();
        return View('questionsmanagement.show-questions', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('questionsmanagement.create-question', compact('roles'));
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
                'name'                  => 'required|max:255|unique:questions',
                'description'            => 'nullable|string',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $params = $request->all();
        if(isset($params['activated']) && $params['activated'] == 'on')
            $params['activated'] = true;
        $question = Question::create($params);

        return redirect('questions')->with('success', trans('questionsmanagement.createSuccess'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {

        return view('questionsmanagement.edit-question', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Question                     $question
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255|unique:questions,name,'.$question->id,
            'description'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $params = $request->all();
        if(isset($params['activated']) && $params['activated'] == 'on')
            $params['activated'] = true;
        $question->update($params);
        return back()->with('success', trans('questionsmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
            $question->delete();

            return redirect('questions')->with('success', trans('questionsmanagement.deleteSuccess'));
    }

    /**
     * Method to search the questions.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('question_search_box');
        $searchRules = [
            'question_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'question_search_box.required' => 'Search term is required',
            'question_search_box.string'   => 'Search term has invalid characters',
            'question_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Question::where('id', 'like', $searchTerm.'%')
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
