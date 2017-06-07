<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadAvatar(Request $request) {
        $day = date('Y-m-d');
        // Handle the user upload of avatar
        if($request->hasFile('file')){
            $user = $request->user();
            $avatar = $request->file('file');
            if(!\Storage::disk('public')->exists('uploads/avatars/'.$day)) {
                // path does not exist
                \Storage::disk('public')->makeDirectory('uploads/avatars/'.$day);
            }
            $filename =  $user->id. time() . '.' . $avatar->getClientOriginalExtension();
            $folderPath = storage_path('app/public/uploads/avatars/'.$day);
            $fullpath =  $folderPath. '/' .  $filename;
            \Image::make($avatar)->save($fullpath);
            $avatarPath = route('file.avatar', ['day' => $day, 'filename' => $filename]);
            $user->contacts->avatar = $avatarPath;
            $user->contacts->save();
            return response()->json(['image' =>  $avatarPath]);
        }
    }

    /**
     * @param Request $request
     * @param $day
     * @param $filename
     * @return string
     */
    public function avatar(Request $request, $day, $filename)
    {
        return \File::get(storage_path('app/public/uploads/avatars/' . $day.'/'.$filename));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadResume(Request $request) {
        $day = date('Y-m-d');
        $user = $request->user();
        $file_status = $request->get('file_status');
        if($file_status == 'exists' || $file_status == 'empty') {
            return response()->json(['resume' => null]);
        }
        if($file_status == 'removed') {
            $user->contacts->resume = null;
            $user->contacts->original_resume_name = null;
            $user->contacts->save();
            return response()->json(['resume' => null]);
        }
        if($file_status == 'uploaded') {
            // Handle the user upload of avatar
            if($request->hasFile('resume')){
                $resume = $request->file('resume');
                if(!\Storage::disk('public')->exists('uploads/resumes/'.$day)) {
                    // path does not exist
                    \Storage::disk('public')->makeDirectory('uploads/resumes/'.$day);
                }
                $filename =  $user->id. time() . '.' . $resume->getClientOriginalExtension();
                $folderPath = storage_path('app/public/uploads/resumes/'.$day);
                $fullpath =  $folderPath. '/' .  $filename;
                $storagePath = 'uploads/resumes/'.$day;
                \Storage::disk('public')->putFileAs($storagePath, $request->file('resume'), $filename);
                $resumePath = route('file.resume', ['day' => $day, 'filename' => $filename]);
                $user->contacts->resume = $resumePath;
                $user->contacts->original_resume_name = $resume->getClientOriginalName();
                $user->contacts->save();
                return response()->json(['resume' => $resumePath]);
            }
        }
    }

    /**
     * @param Request $request
     * @param $day
     * @param $filename
     * @return string
     */
    public function resume(Request $request, $day, $filename)
    {
        return \File::get(storage_path('app/public/uploads/resumes/' . $day.'/'.$filename));
    }
}
