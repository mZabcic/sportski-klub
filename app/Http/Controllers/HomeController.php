<?php

namespace App\Http\Controllers;
use App\Repositories\Repository;
use App\Team;
use App\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $teamRepo;
    protected $usersRepo;

    public function __construct(Team $team, User $user)
    {
        $this->teamRepo = new Repository($team);
        $this->usersRepo = new Repository($user);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = $this->teamRepo->all()->with('coach')->sortable()->paginate(10);
        return view('home', ['teams' => $teams]);
    }


      /**
     * Show team create form.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamCreateView()
    {
        $users = $this->usersRepo->where('role_id', '=', 3);
        return view('team', ['coaches' => $users]);
    }

    


      /**
     * Post method for creating team
     *
     * @return \Illuminate\Http\Response
     */
    public function teamCreate(Request $request)
    {
        $data = $request;
        $team = Team::create([
            'name' => $data['name'],
            'yearFrom' => $data['yearFrom'],
            'yearUntil' => $data['yearUntil'],
            'coach_id' => $data['coach_id']
        ]);
        return redirect('teams');
    }
}
