@extends('master')
@section('content')
<!-- requament posts -->
<section id="index-req-post" class="req__posts__container ">
    <div class="req__posts container">

        <!-- requament post links -->
        <div class="requament__links">
            <div class="req__posts__links">
                <h1>فهرست</h1>
                @foreach ($requirements as $requirementItem)
                    <div class="req__post__link">
                        <a href="{{ route('index.requirements', ['slug' => $requirementItem->slug]) }}"><i class="fa fa-external-link-alt"></i>{{ Str::limit($requirementItem->title, 40) }}</a>
                    </div>
                @endforeach
                

            </div>

            <a class="contact__us__btn" href="{{ route('index.contactus') }}" target="_blank">تماس با ما</a>
        </div>





        <!-- requament text box -->
        @php
            $fileCounts = $requirement->files->count();
        @endphp
        <div class="req__posts__text">
            <div class="@if ($fileCounts == 0) post__text__cr video__formats @else post__text__cr @endif">
                <h1>{{ $requirement->title }}</h1>
                <div class="req__img__cr">
                    <img loading="lazy" src="{{ asset('storage/requirements/' . $requirement->thumbnail) }}" alt="KMPlayer">
                </div>
                {!! $requirement->text !!}
            </div>

            <!-- requaments download box -->
            @if ($fileCounts > 0)
                <div class="req__posts__downloadbox">
                    @foreach ($requirement->files as $files)
                        <div class="req__post__btn">
                            <a href="{{ asset('storage/requirementFiles/' . $files->file) }}" download="KMPlayer Android"> <i class="fa fa-download"></i> {{ $files->title }} </a>
                            <span>{{ $files->size }}, {{ $files->format }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</section>
@endsection