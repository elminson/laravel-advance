<?php

namespace App\Http\Controllers\Web;

use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function __construct(\App\Teams\Repository $teams)
    {
        $this->teams = $teams;
        $this->authorizeResource(Team::class, 'team');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Team::all()->sortBy('users_count')->values();
        //return Team::all()->sortBy('users_count');
        //  return Team::all()->take(2);
        //return Team::all()->pluck('title');
//        return Team::all()->transform(function ($team){
//            $team->title = strtoupper($team->title);
//            return $team;
//        });
//        $collection1 = Team::all();
//        $collection2 = $collection1->nth(2);
        //return $collection1->diff($collection2);

        //return $collection2->intersect($collection1);
        //return $collection2->concat($collection1)->unique();
        //   return $collection2->concat($collection1)->unique('created_at');
        //return Team::all()->sum->users_count;
        //return Team::all()->each->forceFill(['title' => 'each']);
        return Team::all()->map->getTable();
    }

    public function indexTesta()
    {
        // return Team::all()->firstWhere('users_count','<', 2);
//        return Team::all()->filter(function ($team){
//            return $team->users_count > 22;
//        });
//        return Team::all()->reject(function ($team){
//            return $team->users_count > 22;
//        });
//        return Team::all()->search(function ($team){
//            return $team->users_count > 2;
//        });
//        return Team::all()->chunk(2)->mapSpread(function ($team1, $team2){
//            return [$team2, $team1];
//        })->collapse();
//
//        return Team::all()->mapToGroups(function ($team){
//            return [$team->id => $team->users_count];
//        });
//reduce
//        return Team::all()->reduce(function ($carry, $team){
//            return $carry + $team->users_count;
//        });

//         return Team::all()->reduce(function ($carry, $team){
//            return $carry + $team->users_count;
//        }, 10);

        //return Team::all()->sum('users_count');
        return Team::all()->mode('users_count');

    }

    public function indextitle()
    {
        return Team::all()->map(function ($team, $key) {
            return $team->id;
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team/create')->with('points', 5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\StoreTeam $request)
    {
        $team = new Team();
        $team->title = $request->input('title');
        $team->save();

        return redirect('/teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        throw new \App\Exceptions\ActionNotCompletedException();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Team $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }

    public function points(Team $team)
    {
        $this->authorize('view', $team);
        return response()->json($this->teams->points($team));
    }
}
