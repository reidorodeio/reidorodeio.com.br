<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\General;
use App\Models\Transaction;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $data['page_title'] = "All Games";
        $general = General::first();
        $data['games'] = Game::orderBy('id', 'DESC')->paginate($general->paginate);
        return view('admin.games.index', $data);
    }

    public function create()
    {
        $data['page_title'] = "Add Games";
        return view('admin.games.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'rules' => 'required',
            'min' => 'required',
            'max' => 'required',
            'image' => 'sometimes|mimes:jpeg,jpg,png,bmp,gif,svg,webp|max:1024'
        ]);
        try{

            if ($request->image) {
                $size = [550,518];
            }

            $fileName = uploadImage($request->file('image'),'images/games',null,null,$size);
            Game::create([
                'image'  => $fileName,
                'name'   => $request->name,
                'rules'  => $request->rules,
                'min'    => $request->min,
                'max'    => $request->max,
                'rate1'  => $request->rate1,
                'rate2'  => $request->rate2,
                'rate3'  => $request->rate3,
                'rate4'  => $request->rate4,
                'rate5'  => $request->rate5,
                'rate6'  => $request->rate6,
                'rate7'  => $request->rate7,
                'rate8'  => $request->rate8,
                'rate9'  => $request->rate9,
                'rate10' => $request->rate10,
                'auto'   => $request->auto,
                'base'   => $request->base,
                'option' => $request->option,
                'status' => 1

            ]);
            return back()->with('success',__('Create Successfully'));
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Game";
        $data['games'] = Game::find($id);
        return view('admin.games.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'rules' => 'required',
            'min' => 'required',
            'max' => 'required',
            'image' => 'sometimes|mimes:jpeg,jpg,png,bmp,gif,svg,webp|max:1024'
        ]);
        try{
            $games = Game::find($id);

            if ($games->image) {
                $size = [550,518];
            }

            if ($request->file('image')){
                @unlink('public/images/games/'.$games->image);
                $fileName = uploadImage($request->file('image'),'images/games',null,null, $size);
            }else{
                $fileName = $games->image;
            }

            $games->update([
                'image'  => $fileName,
                'name'   => $request->name,
                'rules'  => $request->rules,
                'min'    => $request->min,
                'max'    => $request->max,
                'rate1'  => $request->rate1,
                'rate2'  => $request->rate2,
                'rate3'  => $request->rate3,
                'rate4'  => $request->rate4,
                'rate5'  => $request->rate5,
                'rate6'  => $request->rate6,
                'rate7'  => $request->rate7,
                'rate8'  => $request->rate8,
                'rate9'  => $request->rate9,
                'rate10' => $request->rate10,
                'auto'   => $request->auto,
                'base'   => $request->base,
                'option' => $request->option,
                'status' => $request->status
            ]);
            return back()->with('success',__('Update Successfully'));
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function gamesLog() {
        $data['page_title'] = 'Games Log';
        $general = General::first();
        $data['trx'] = Transaction::where('status', 10)->latest()->paginate($general->paginate);
        return view('admin.games.log', $data);
    }
}
