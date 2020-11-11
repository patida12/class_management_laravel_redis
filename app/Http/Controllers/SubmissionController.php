<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $assignment = AssignmentController::getById($id);
        return view(
            'submission.index',
            ['assignment' => $assignment]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view(
            'submission.create',
            ['id' => $id]
        );
    }

    /**
     * Upload file.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $id)
    {
        $this->validate($request, [
            'uploaded_file' => ['required'],
        ]);
        $file =$request->file('uploaded_file');
        $submission = new Submission();
        $submission->name = $file->getClientOriginalName();
        $submission->user_id = Auth::user()->id;
        $submission->assignment_id = (int)$id;
        $filePath = "public/submission/" . $id . "_" . $submission->user_id . "_" . $submission->name;
        $submission->path = $filePath;
        if(!Storage::exists($filePath)) {
            $submission->save();
            $path = Storage::putFileAs('public/submission', $file, $id . "_" . $submission->user_id . "_" . $submission->name);

            if ($path) {
                return redirect()->action([SubmissionController::class, 'index'], ['id' => $id])
                                    ->with('success_upload', 'Upload thành công!');
            }
            return redirect()->action([SubmissionController::class, 'index'], ['id' => $id])
                                    ->with('error_upload', 'Upload failt!');
        }
        $path = Storage::putFileAs('public/submission', $file, $id . "_" . $submission->user_id . "_" . $submission->name);

        if ($path) {
            return redirect()->action([SubmissionController::class, 'index'], ['id' => $id])
                            ->with('success_upload', 'Đã update file thành công!');
        }
        return redirect()->action([SubmissionController::class, 'index'], ['id' => $id])
                            ->with('error_upload', 'Update file failt!');
    }

    /**
     * Download file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $submission = Cache::remember("submission:$id", Controller::SECONDS, function () use($id) {
            return Submission::find($id);
        });
        $index = strripos($submission->path,"/");
        $fileName = substr($submission->path, $index + 1);
        $index = strripos($fileName,"_");
        $name = substr($fileName, $index + 1);

        return Storage::download($submission->path, $name);
    }

}
