<?php

namespace App\Http\Controllers;
use App\Repositories\Repository;
use App\Team;
use App\User;
use App\Player;
use App\Position;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $playerRepo;
    protected $teamRepo;
    protected $positionRepo;


    public function __construct(Player $player, Team $team, Position $position)
    {
        $this->playerRepo = new Repository($player);
        $this->teamRepo = new Repository($team);
        $this->positionRepo = new Repository($position);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = $this->playerRepo->all()->with('position')->sortable()->paginate(10);
        return view('players.index', ['players' => $players]);
    }


      /**
     * Show team create form.
     *
     * @return \Illuminate\Http\Response
     */
    public function createView()
    {
        $teams = $this->teamRepo->all()->get();
        $positions = $this->positionRepo->all()->get();
        return view('players.create', ['teams' => $teams, 'positions' => $positions]);
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
        return view('teamEdit', ['coaches' => $users, 'team' => $team ]);
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
