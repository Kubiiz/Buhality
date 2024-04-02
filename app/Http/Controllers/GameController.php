<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Auth;
use Validator;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Auth::user()->game->where('active', 0)->first();

        if (count((array)$data) == 0)
            return redirect('new-game');

        $members = unserialize($data->members);

        return view('game.index', compact('data', 'members'));
    }

    /*
        1 = Pieskaita +1, 44%
        2 = Pieskaita +2, 15%
        4 = Pieskaita visiem +1, 10%
        5 = Neviens, 10%
        -1 = Atņem -1, 20%

        b (3) = dzer visi, 1%
    */

    public function random($b){
        $random = [
            1,1,-1,2,1,4,-1,5,1,1,-1,1,2,-1,1,5,1,2,1,4,
            1,1,-1,2,1,4,-1,5,1,1,-1,1,2,-1,1,5,1,2,4,
            1,1,-1,2,1,4,-1,5,1,$b,-1,1,2,-1,1,5,1,2,1,4,
            1,1,-1,2,1,4,-1,5,1,1,-1,1,2,-1,1,5,1,2,1,4,
            1,1,-1,2,1,4,-1,5,1,1,-1,1,2,-1,1,5,1,2,1,4
        ];

        $rand = array_rand($random);

        if ($random[$rand] == 3) {
            $randbomb = [1,1,1,3,1,1,1];

            $rands = array_rand($randbomb);

            $return = $randbomb[$rands];
        } else {
            $return = $random[$rand];
        }

        return $return;
    }

    public function bomba($data)
    {
        $memb = unserialize($data->members);

        foreach ($memb as $us) {
            foreach ($us as $ua => $s) {
                $members[] = [$ua => ($s + 1)];
            }
        }

        $data->update([
            'shots'     => $data->shots + count((array)$memb),
            'members'   => serialize($members)
        ]);

    }

    public function shot($data, $member)
    {
        if (isset($member)) {
            $memb = unserialize($data->members);

            $i = -1;

            foreach ($memb as $us) {
                foreach ($us as $ua => $s) {
                    $i++;

                    $plus = $i == $member ? $s + 1 : $s;

                    $members[] = [$ua => $plus];
                }
            }

            $update['shots'] = $data->shots + 1;
            $update['members'] = serialize($members);

            $data->update($update);
        }
    }

    public function game(Request $request)
    {
        $data = Auth::user()->game->where('active', 0)->first();

        if (count((array)$data) == 0)
            return 'Nothing special! (:';
        else {
            if ($request->query('do') == 'bomba')
                $this->bomba($data);

            if ($request->query('do') == 'drink') {
                $explode = explode(',', $request->query('member'));

                foreach($explode as $e) {
                    $this->shot($data, $e);
                }
            }

            $members = unserialize($data->members);
            $rand = rand(0, count((array)$members) - 1);

            $memb = array_keys($members[$rand]);
            //$shots = array_values($members[$rand]);
            $plus = $this->random($data->bomba);

            if ($plus == 2)
                $show = $memb[0] . ' <span class="x2 text-danger plus">+2</span>';
            elseif ($plus == -1)
                $show = $memb[0] . ' <span class="x2 text-success plus">-1</span>';
            elseif ($plus == 3)
                $show = 'BOMBA<br /><span class="x2 text-primary">Dzer visi!</span>';
            elseif ($plus == 4)
                $show = 'Visi';
            elseif ($plus == 5)
                $show = 'Neviens';
            else
                $show = $memb[0] . ' <span class="x2 text-danger plus">+1</span>';

            $decode = [
                'random'    => $show,
                'id'        => $rand,
                'count'     => $data->count,
                'plus'      => $plus,
            ];

            return json_encode($decode);
        }
    }

    public function stop()
    {
        Game::where('user_id', Auth::user()->id)->update([
            'active'      => 1
        ]);

        return back();
    }
}