<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; 

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(25);
            // $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        
           return view('tasks.index', $data);
           
        }
        // Welcomeビューでそれらを表示 認証が通らなければ空の情報が渡る
        return view('welcome', $data);
     
        
        // タスク一覧を取得
        //$tasks = Task::all();
       // $tasks = Task::paginate(25);

        // // タスク一覧ビューでそれを表示
        // return view('tasks.index', [
        //     'tasks' => $tasks,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $task = new Task;

            // タスク作成ビューを表示
            return view('tasks.create', [
                'task' => $task,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        if (\Auth::id() === $task->user_id) {// 認証済みユーザ（閲覧者）がその投稿の所有者か確認する
           //dd($request);
           // バリデーション
            $request->validate([
                'status' => 'required|max:10', 
                'content' => 'required|max:255',
            ]);
            //dd($request);
            // タスクを作成
            $task = new Task;
      
      
            // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
            $a = $request->user()->tasks()->create([
                'status' => $request->status,
                'content' => $request->content,
            ]);
            
            // $task->status = $request->status; 
            // $task->content = $request->content;
            //$task->save();
        }
            // トップページへリダイレクトさせる
            return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
            // idの値でタスクを検索して取得
            $task = Task::findOrFail($id);
    
        if (\Auth::id() === $task->user_id) {// 認証済みユーザ（閲覧者）がその投稿の所有者か確認する
            // タスク詳細ビューでそれを表示
            return view('tasks.show', [
                'task' => $task,
            ]);
        }
            // トップページへリダイレクトさせる
            return redirect('/');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
 
            // idの値でタスクを検索して取得
            $task = Task::findOrFail($id);
           
        if (\Auth::id() === $task->user_id) {// 認証済みユーザ（閲覧者）がその投稿の所有者か確認する
            // タスク編集ビューでそれを表示
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }
            // トップページへリダイレクトさせる
            return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // putまたはpatchでmessages/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        
     if (\Auth::id() === $task->user_id) {// 認証済みユーザ（閲覧者）がその投稿の所有者か確認する
           // バリデーション
            $request->validate([
                'status' => 'required|max:10', 
                'content' => 'required|max:255',
            ]);
            
            // idの値でタスクを検索して取得
            $task = Task::findOrFail($id);
            // タスクを更新
            $task->status = $request->status; 
            $task->content = $request->content;
            $task->save();

        }
            // トップページへリダイレクトさせる
            return redirect('/');
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // deleteでtasks/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        
         if (\Auth::id() === $task->user_id) {// 認証済みユーザ（閲覧者）がその投稿の所有者か確認する
            // idの値でタスクを検索して取得
            $task = Task::findOrFail($id);
            // タスクを削除
            $task->delete();

        }
             // トップページへリダイレクトさせる
            return redirect('/');
     
    }
}

