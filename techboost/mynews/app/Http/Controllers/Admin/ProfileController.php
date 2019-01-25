<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    //
    public function edit(Request $request)
    {
        // News Modelからデータを取得する

        $profile = Profile::find($request->id);
        \Debugbar::info($profile);
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    public function create(Request $request)
      {

          // Varidationを行う
          $this->validate($request, Profile::$rules);

          $profile = new Profile;
          $form = $request->all();

          // formに画像があれば、保存する

          unset($form['_token']);
          // データベースに保存する
          $profile->fill($form);
          $profile->save();

          return redirect('admin/profile/create');
      }

      public function add()
   {
     return view('admin.profile.create');
   }

      public function update(Request $request)
      {
          // Validationをかける
          $this->validate($request, Profile::$rules);
          // News Modelからデータを取得する
          \Debugbar::info($request);
          $profile = Profile::find($request->id);
          \Debugbar::info($profile);
          // 送信されてきたフォームデータを格納する
          $profile_form = $request->all();
          unset($profile_form['_token']);
          //\Debugbar::info($profile);

          // 該当するデータを上書きして保存する
          $profile->fill($profile_form);
          $profile->save();

          return redirect('admin/profile/edit');
      }
      public function delete(Request $request)
      {
      // 該当するNews Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
      }
}
