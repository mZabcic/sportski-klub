<?php

namespace App\Http\Controllers;
use App\Repositories\Repository;
use App\Team;
use App\User;
use App\Player;
use App\Position;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
     * Show player create form.
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
     * Show player edit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function editView($id)
    {
        $player = $this->playerRepo->show($id);
        $teams = $this->teamRepo->all()->get();
        $positions = $this->positionRepo->all()->get();
        if (is_null($player->team_id))
           $player->team_id = 0;
        return view('players.edit', ['player' => $player, 'teams' => $teams, 'positions' => $positions]);
    }


    


      /**
     * Post method for creating team
     *
     * @return \Illuminate\Http\Response
     */
    public function createMethod(Request $request)
    {
        $data = $request;
        if ($data['team_id'] == 0) {
            $data['team_id'] = null;
        }
        $player = $this->playerRepo->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'position_id' => $data['position_id'],
            'team_id' => $data['team_id']
        ]);
        return redirect($data['redirect']);
    }

      /**
     * Post method for editing team
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $data = $request;
        
        if ($data['team_id'] == 0) {
            $data['team_id'] = null;
        }
        $player = $this->playerRepo->show($id);
        $player->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'position_id' => $data['position_id'],
            'team_id' => $data['team_id']
        ], [$id]);

        return redirect('players');
    }

       /**
     * Delete method for deleting team
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = $this->playerRepo->delete($id);
        return redirect('players');
    }

         /**
     * Delete method for deleting team
     *
     * @return \Illuminate\Http\Response
     */
    public function kick($id)
    {
        $data = $this->playerRepo->show($id);
        $team_id = $data->team_id;
        $data->team_id = null;
        $data->save();
        return redirect('teams/' .  $team_id);
    }


}
