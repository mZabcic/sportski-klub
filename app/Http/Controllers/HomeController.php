<?php

namespace App\Http\Controllers;
use App\Repositories\Repository;
use App\Team;
use App\User;
use App\Player;

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
    protected $playerRepo;

    public function __construct(Team $team, User $user, Player $player)
    {
        $this->teamRepo = new Repository($team);
        $this->usersRepo = new Repository($user);
        $this->playerRepo = new Repository($player);
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
        $users = $this->usersRepo->all()->where('role_id', '=', 3)->get();
        return view('team', ['coaches' => $users]);
    }


     /**
     * Show team edit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function teamEditView($id)
    {
        $users = $this->usersRepo->all()->where('role_id', '=', 3)->get();
        $team = $this->teamRepo->show($id);
        $players = $this->playerRepo->all()->where('team_id', $id)->sortable()->paginate(10);
        return view('teamEdit', ['coaches' => $users, 'team' => $team , 'players' => $players]);
    }


    


      /**
     * Post method for creating team
     *
     * @return \Illuminate\Http\Response
     */
    public function teamCreate(Request $request)
    {
        $data = $request;
        $team = $this->teamRepo->create([
            'name' => $data['name'],
            'yearFrom' => $data['yearFrom'],
            'yearUntil' => $data['yearUntil'],
            'coach_id' => $data['coach_id']
        ]);
        return redirect('teams');
    }

      /**
     * Put method for editing team
     *
     * @return \Illuminate\Http\Response
     */
    public function teamEdit($id, Request $request)
    {
        $data = $request;
        $team = $this->teamRepo->show($id);
        $team->update([
            'name' => $data['name'],
            'yearFrom' => $data['yearFrom'],
            'yearUntil' => $data['yearUntil'],
            'coach_id' => $data['coach_id']
        ], [$id]);

        return redirect('teams');
    }

       /**
     * Delete method for deleting team
     *
     * @return \Illuminate\Http\Response
     */
    public function teamDelete($id)
    {
        $data = $this->teamRepo->delete($id);
        return redirect('teams');
    }


}
