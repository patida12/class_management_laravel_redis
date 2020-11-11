<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ChallengeController extends Controller
{
    public const CHALLENGE_DIR = 'public/challenge';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = Cache::remember('challenges', Controller::SECONDS, function () {
            return Challenge::all();
        });
        return view(
            'challenge.index',
            ['challenges' => $challenges]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('challenge.create');
    }

    /**
     * Upload file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'description' => ['required', 'string', 'max:255'],
            'uploaded_file' => ['required', 'mimes:txt'],
        ]);
        $file =$request->file('uploaded_file');
        $challenge = new Challenge();
        $challenge->description = $request->description;
        $name = $file->getClientOriginalName();
        $challenge->save();
        Cache::forget("challenges");
        $idChallenge = (string)$challenge->id;

        $path = Storage::putFileAs(ChallengeController::CHALLENGE_DIR, $request->file('uploaded_file'), $idChallenge . '_' . $name);

        if ($path) {
            return redirect()->action([ChallengeController::class, 'index'])->with('success_upload', 'Upload thành công!');
        }
        return redirect()->action([ChallengeController::class, 'index'])->with('error_upload', 'Upload failt!');
    }

    /**
     * Upload file.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function answer(Request $request, $id)
    {
        $this->validate($request, [
            'answer' => ['required', 'string', 'max:255'],
        ]);
        $answer = (string)$id . '_' . $request->answer . '.txt';
        $idChallenge = (string)$id;
        $files = Storage::files(ChallengeController::CHALLENGE_DIR);
        foreach($files as $filePath) {
            $index = strripos($filePath,"/");
            $fileName = substr($filePath, $index + 1);
            $index = strpos($fileName,"_");
            $idFile = substr($fileName, 0, $index);

            if ($idChallenge == $idFile) {
                if ($answer == $fileName) {
                    return redirect()->action([ChallengeController::class, 'result'])->with('Correct', $filePath);
                }
                break;
            }
        }

        return redirect()->action([ChallengeController::class, 'result'])->with('Incorrect', 'Incorrect!');
    }

    public function result()
    {
        return view('challenge.result');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $challenge = Cache::remember("challenge:$id", Controller::SECONDS, function () use($id) {
            return Challenge::find($id);
        });
        $idChallenge = (string)$id;
        $files = Storage::files(ChallengeController::CHALLENGE_DIR);
        foreach($files as $filePath) {
            $index = strripos($filePath,"/");
            $fileName = substr($filePath, $index + 1);
            $index = strpos($fileName,"_");
            $idFile = substr($fileName, 0, $index);

            if ($idChallenge == $idFile) {
                Storage::delete($filePath);
                break;
            }
        }

        $challenge->delete();
        Cache::forget("challenge:$id");
        return redirect()->action([ChallengeController::class, 'index'])->with('success_delete', 'Delete thành công!');
    }
}
