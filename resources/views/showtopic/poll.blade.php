<div class="loader-fullwidth" style="display:none !important;">
    <div class="lds-ripple">
        <div></div><div></div>
    </div>
    <div class="loader-message" id="loader-answer-received"></div>
</div>



@php
$p_id = PollQuestion_By_topicID($topicid, 'id');
@endphp

@auth
@if(ifanswered($p_id) == 0 && topic_info($topicid, 'close') == 0)

    @php
        $nonfree_values = 0;
        $output = '';
        for ($x = 1; $x <= 7; $x++){
            $p_varianti='ans_'.$x;
            if(!empty(PollQuestion($p_id, $p_varianti))){
                $nonfree_values++;
                $output .= '<div class="ans_parianti" id="pasuxi'.$x.'" onclick="ansset('.$x.');"><div class="pollans-point"></div><div class="pasuxis_texti">'.PollQuestion($p_id, $p_varianti).'</div></div>';
            }
    
        }
    @endphp


    @if($nonfree_values >= 2 && !empty(PollQuestion($p_id, 'question')))
        
        <div class="container222">
	        <div class="pasuxis_pariantebi">
                <span class="heading-gaugzavnelze">{{ PollQuestion($p_id, 'question') }}</span>
                {!! $output !!}
                <div style="min-height: 10px;" id="resp"></div>
                <button type="button" class="btn btn-primary btn-style" id="sendanswer" disabled>Send my answer</button>
            </div>
        </div>

        <input type="hidden" value="0" id="ans-set">
        <script>
        $(document).ready(function() {

            $("#sendanswer").click(function(){

                var the_pasuxi = $('#ans-set').val();
                $.post('{{ route("answer_poll") }}', {
                    poll_id:'{{ $p_id }}', 
                    answer: the_pasuxi
                }, 
                function(response){ 
                    $('.loader-fullwidth').show();
                    $('#loader-answer-received').text(response.message);
                    // Simulate a mouse click:
                    window.location.href = '{{ route('showtopic', [$topicid]) }}';
                });

            });
        });

        function ansset(n){
            $('#sendanswer').removeAttr('disabled');
            var yle = Number($('#ans-set').val());
            if(yle != n){
    	        $('#pasuxi'+yle).removeClass("ans-checked");
                $('#pasuxi'+n).addClass("ans-checked");
                $('#ans-set').val(n);       
            }   
        }
        </script>
    @endif
@endif
@endauth



@if(ifanswered($p_id) == 1 || topic_info($topicid, 'close') == 1)
    @php
        $nonfree_values = 0;
        $output = '';

        for ($x = 1; $x <= 7; $x++){
            $p_varianti='ans_'.$x;
               
            if(!empty(PollQuestion($p_id, $p_varianti))){
                $nonfree_values++;
                $percentage = procenti(total_answer_answered_reviewers($p_id, $x), poll_reviewers($p_id));
                $output .= '<div class="progress_bar"><div class="pro-bar"><small class="progress_bar_title">'.PollQuestion($p_id, $p_varianti).'<span class="progress_number">'.round($percentage).'%</span></small><span class="progress-bar-inner" style="background-color: '.progressbar_color($x).'; width: '.round($percentage).'%;" data-value="'.round($percentage).'" data-percentage-value="'.round($percentage).'"></span></div></div>';
            }
        }
        
    @endphp
    
    @if($nonfree_values >= 2 && !empty(PollQuestion($p_id, 'question')))

        <div class="container bg-white">
            <div class="row">
                <div class="poll-column">
                    <span class="heading">{{ PollQuestion($p_id, 'question') }}</span>
                    <p>The average based on {{ poll_reviewers($p_id) }} reviews.</p>
                    {!! $output !!}
                </div>
            </div>
        </div>
    @endif

@endif