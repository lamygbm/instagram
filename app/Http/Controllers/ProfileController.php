<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $follow=(auth()->user()) ? auth()->user()->following->contains($user->profile->id):false;
        return view('profiles.show',compact('user'));
    }
    public function edit(user $user)
    {
        $this->authorize('update',$user->profile);
       return view('profiles.edit',compact('user'));
    }
    public function update(user $user)
    {
        $data=request()->validate([ 
            'title' =>'required',
            'description' => 'required',
            'url' => 'required|url',
            'image'=>'sometimes|image|max:3000',

            ]);
            
            if(request('image')){ 
           $imagePath = request('image')->store('uploads','public');
           $image =Image::make(public_path("/storage/{$imagePath}"))->fit(200,200);
           $image->save();

           auth()->user()->profile->update(array_merge(
              $data,
            ['image'=> $imagePath]

           ));
           
            }else{
               auth()->user()->profile->update($data);
            }
            
     
            $user->profile->update($data);
            return redirect()->route('profiles.show',['user' => $user]);
        
        $user->profile->update($data);
        return redirect()->route('profiles.show',['user' => $user]);
    }
}
