@extends('layouts.master')
@section('content')
<section>
    <div class="tab-content">
        @if (session('Incorrect'))
            <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('Incorrect') }}
            </div>
        @endif

        @if (session('Correct'))
        <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                Correct!
        </div>
        <?php
        $filePath = session('Correct');
        $file = fopen(storage_path('app/' . $filePath),'r');

        while ($line = fgets($file)) {
            echo $line;
            echo '<br>';
        }
        fclose($file);
        ?>
        @endif
        <br>
        <a class="btn btn-danger" href='/challenges'>Back</a>
    </div>
</section>
@endsection
