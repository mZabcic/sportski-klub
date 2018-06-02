<?php

namespace App\Http\Controllers;
use App\Repositories\Repository;
use App\Team;
use App\User;
use App\Player;
use App\Position;
use App\BusinessLogic\TeamLogic;
use Carbon\Carbon;
use Workflow;



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
    protected $positionRepo;

    public function __construct(Team $team, User $user, Player $player, Position $position)
    {
        $this->teamRepo = new Repository($team);
        $this->usersRepo = new Repository($user);
        $this->playerRepo = new Repository($player);
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
        $teams = $this->teamRepo->all()->with('coach')->sortable()->paginate(10);
        $workflow = Workflow::get($teams[0]);
        return view('home', ['teams' => $teams, 'wf' => $workflow]);
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
        if (is_null($team->yearFrom)) {
            $od = 0;
        } else {
            $od = $team->yearFrom;
        }
        $add_players = $this->playerRepo->all()->where('team_id', null)->get();
        $positions = $this->positionRepo->all()->get();
        $workflow = Workflow::get($team);
        if (is_null($team->coach_id))
             $team->coach_id = 0;
        return view('teamEdit', ['coaches' => $users, 'team' => $team , 'players' => $players, 'selectPlayers' =>  $add_players, 'positions' => $positions,  'wf' => $workflow]);
    }


    


      /**
     * Post method for creating team
     *
     * @return \Illuminate\Http\Response
     */
    public function teamCreate(Request $request)
    {
        TeamLogic::validator($request->all(), null);
        $data = $request;
        $team = $this->teamRepo->create([
            'name' => $data['name'],
            'yearFrom' => $data['yearFrom'],
            'yearUntil' => $data['yearUntil'],
            'coach_id' => $data['coach_id']
        ]);
        if ($data['role'] == 1) {
            $team->workflow_apply('create_accept');
            $team->save();
            }
            if ($data['role'] == 2) {
                $team->workflow_apply('to_review');
                $team->save();
                }
        return redirect('teams');
    }

      /**
     * Put method for editing team
     *
     * @return \Illuminate\Http\Response
     */
    public function teamEdit($id, Request $request)
    {
        TeamLogic::validator($request->all(), $id);
        $data = $request;
        $team = $this->teamRepo->show($id);
        $team->update([
            'name' => $data['name'],
            'yearFrom' => $data['yearFrom'],
            'yearUntil' => $data['yearUntil'],
            'coach_id' => $data['coach_id']
        ], [$id]);
       if ($data['role'] == 1) {
        $team->workflow_apply('to_review');
        $team->save();
        }
        if ($data['role'] == 2) {
            $team->workflow_apply('accept');
            $team->save();
            }
         if ($data['role'] == 3) {
                $team->workflow_apply('reject');
                $team->save();
                }
        if ($data['role'] == 4) {
                    $team->workflow_apply('review_again');
                    $team->save();
                    }
        return redirect('teams');
    }



       /**
     * Delete method for deleting team
     *
     * @return \Illuminate\Http\Response
     */
    public function teamDelete($id)
    {
        $players = $this->playerRepo->all()->where('team_id', $id)->get();
        foreach ($players as $player) {
            $player->team_id = null;
            $player->save();
        }
        $data = $this->teamRepo->delete($id);
        return redirect('teams');
    }

    public function add($id, Request $request)
    { 
      $data = $request;
      $team = $this->teamRepo->show($id);
      $player = $this->playerRepo->show($data['player_id']);
      $year = Carbon::parse($player->date_of_birth)->year;
      if (TeamLogic::validatorAddPlayer($team->yearFrom,$team->yearUntil, $year)) {
        return redirect('teams/' . $id)->with('yearError', 'Greška');
      }
      $player->team_id = $id;
      $player->save();
      return redirect('teams/' . $id);
    }    

    public function forward(Request $request) {
        $teams = $this->teamRepo->all()->orderBy('id', 'ASC')->get();
        $currentId = $request['id'];
        $flag = false;
        $newId = 0;
        foreach ($teams as $team) {
           if ($team->id == $currentId) {
               $flag = true; 
               continue;              
           }
           if ($flag) {
               $newId = $team->id;
               break;
           }
        }
        if ($newId == 0) {
            $newId = $teams[0]->id;
        }
        return redirect('teams/' . $newId);
    }

    public function back(Request $request) {
        $teams = $this->teamRepo->all()->orderBy('id', 'DESC')->get();
        $currentId = $request['id'];
        $flag = false;
        $newId = 0;
        foreach ($teams as $team) {
           if ($team->id == $currentId) {
               $flag = true; 
               continue;              
           }
           if ($flag) {
               $newId = $team->id;
               break;
           }
        }
        if ($newId == 0) {
            $newId = $teams[0]->id;
        }
        return redirect('teams/' . $newId);
    }



}
