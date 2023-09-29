@extends('front.partial.app')
@section('content')
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 text-end match_left pl-0"></div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 my-3 mb-6">
                <div class="match-main text-center">
                    <h1 class="match-heading">Find Your Match</h1>
                    <p class="match-title">This quick matching quiz is designed to help you discover your <br> ideal
                        Fitness Providers and Wellness
                        Professionals.</p>

                    <p class="match-title"><a href="{{ route('front.create-account') }}">Create a free account</a> or <a
                            href="{{ route('front.create-account') }}">log</a> in to Save
                        matches and start<br>
                        chatting with your connections!</p>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Lets
                        Go!</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade find-match" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="staticBackdropLabel">
                        <h2 class="f-poup-heading">FIND YOUR MATCH</h2>
                        <p class="f-poup-title">“Once you are exercising regularly, the hardest thing is to stop it.”</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $count = 0;
                        $totalQuestion = count($question_list);
                    @endphp
                    <form action="javascript:void(0);" id="matchForm">
                        @php
                            $numOfOpction = 1;
                        @endphp
                        @foreach ($question_list as $question)
                            <div class="inner-space" @if ($count !== 0) style="display: none;" @endif
                                id="visibal{{ $count }}">
                                <input type="hidden" name="questionid[]" value="{{ $question['question_id'] }}">

                                <p class="fm-poup-title">{{ $question['question'] }}</p>

                                <div class="radio-part">
                                    @php
                                        $numOf = count($question['opction']);
                                    @endphp
                                    {{-- @if ($numOf < 8) --}}
                                        @foreach ($question['opction'] as $key => $value)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="opction{{ $question['question_id'] }}" id="exampleRadios1"
                                                    value="{{ $question['opction_ids'][$key] }}" checked>
                                                <label class="form-check-label">
                                                    {{ $value }}
                                                </label>
                                            </div>
                                        @endforeach
                                    {{-- @else
                                        <div class="form-check" style="display: flex;">
                                            <div style="width: 279px;">
                                                <input class="form-check-input" type="radio"
                                                    name="opction{{ $question['question_id'] }}" id="exampleRadios1"
                                                    value="{{ $question['opction_ids'][$key] }}" checked>
                                                <label class="form-check-label">
                                                    {{ $value }}
                                                </label>
                                            </div>
                                            <div style="width: 100px;">
                                                <input class="form-check-input" type="radio"
                                                    name="opction{{ $question['question_id'] }}" id="exampleRadios1"
                                                    value="{{ $question['opction_ids'][$key] }}" checked>
                                                <label class="form-check-label">
                                                    {{ $value }}
                                                </label>
                                            </div>
                                        </div>
                                    @endif --}}

                                </div>
                            </div>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                        <div class="right-arrow">
                            <button type="button" class="custom-btn next-btn" style="padding: 14px;color: #fff;">Next--></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        var total = {{ $totalQuestion }} - 1;
        var count = 0;
        var isValid = true;
        $(".next-btn").click(function() {
            if (isValid == true) {
                $("#visibal" + count).css('display', 'none');
                count++;
                $("#visibal" + count).css('display', '');
                if (total == count) {
                    isValid = false;
                    $(this).text("Submit")
                }
            } else {

                var data = $("#matchForm").serializeArray();
                var formData = new FormData();
                formData = getFormData(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('front.match.add') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.location.replace("{{ route('front.explore-fitness') }}")
                    }
                });
            }
        });
    </script>
@endsection
