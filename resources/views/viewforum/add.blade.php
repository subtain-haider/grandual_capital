@extends('layouts.general_layout')
@section('title', 'Create new topic - '.cat_info($cat, 'title'))
@section('content')

<!-- accordion stylesheet -->
<link rel="stylesheet" href="{{ asset('assets/css/elements/accordion.css') }}">

    <div id="just-10pspace" style="height: 10px;"></div>
    <div class="breadcrumb-container overflow-auto">
        <div class="btn-group btn-breadcrumb">
            <a href="{{ route('index') }}" class="btn btn-default"><i class="fas fa-home" aria-hidden="true"></i></a>
            <a href="{{ route('forum', array('get_forum_id'=>$cat))}}" class="btn btn-default">{{ cat_info($cat, 'title') }}</a>
            <a class="btn btn-default">Create new topic</a>
        </div>
    </div>

<div class="all_post_items_container bg-white">
<div class="card-header bg-white text-uppercase bold">
    Create new topic<span class="material-icons pull-right">timeline</span>
 </div>

    <div class="card py-2 mb-4 border-0">
        <div class="card-body">
            <form action="{{ route('addtopic', array('get_forum_id'=>$cat)) }}" method="post">
                {{ csrf_field() }}
              
                <div class="form-group">
                    <label for="input_title" class="input__label">Topic title</label>
                    <input type="text" name="title" class="form-control input-style {{ $errors->has('title') ? 'error' : '' }}" id="input_title" value="{{ old('title') }}" placeholder="Enter topic title here...">
                    @error('title')
                        <span class="invalid-feedback" style="display:block !important;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- Error -->

     
                <input type="hidden" name="cat_id" value="{{ $cat }}">

                <div class="tc-accordion tc-accordion-style1" id="accordion1">
                    <div class="panel">
                        <h6 class="acdn-title">
                            <a data-toggle="collapse" data-parent="#accordion1" href="#collapse4" class="collapsed" aria-expanded="false">Add surway</a>
                        </h6>
                        <div id="collapse4" class="panel-collapse collapse" aria-expanded="false" style="">
                            <div class="acdn-body">

                                <div class="alert alert-info" role="alert">
                                    <strong>Heads up!</strong> 
                                    To add a poll you need to ask a question and fill in at least two possible answers (otherwise the poll will not appear on the topic). In case of non-indication of the start and end date of the survey or incorrectly, the start date of the survey is defined as the current day, and the end date is the next tenth day.
                                </div>

                                <div class="form-group">
                                    <input type="text" name="question" class="form-control input-style" value="{{ old('question') }}" placeholder="What`s your question?">
                                    @error('question')
                                        <span class="invalid-feedback" style="display:block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--დაიწყო - სავარაუდო პასუხები-->
                                <div class="form-group">
                                    <label for="inputAddress2" class="input__label">Answers to choose</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="validationTooltipUsernamePrepend">1</span>
                                        </div>
                                        <input type="text" name="q_one" value="{{ old('q_one') }}" class="form-control input-style" id="inputAddress2" placeholder="Answer...">
                                        @error('q_one')
                                            <span class="invalid-feedback" style="display:block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">2</span>
                                        </div>
                                        <input type="text" name="q_two" value="{{ old('q_two') }}" class="form-control input-style" id="inputAddress2" placeholder="Answer...">
                                        @error('q_two')
                                            <span class="invalid-feedback" style="display:block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <!--დაიწყო - დამატებით სავარაუდო პასუხები-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">3</span>
                                        </div>
                                        <input type="text" name="q_three" value="{{ old('q_three') }}" class="form-control input-style" id="inputAddress2" placeholder="Answer...">
                                        @error('q_three')
                                            <span class="invalid-feedback" style="display:block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">4</span>
                                        </div>
                                        <input type="text" name="q_four" value="{{ old('q_four') }}" class="form-control input-style" id="inputAddress2" placeholder="Answer...">
                                        @error('q_four')
                                            <span class="invalid-feedback" style="display:block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">5</span>
                                        </div>
                                        <input type="text" name="q_five" value="{{ old('q_five') }}" class="form-control input-style" id="inputAddress2" placeholder="Answer...">
                                        @error('q_five')
                                            <span class="invalid-feedback" style="display:block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">6</span>
                                        </div>
                                        <input type="text" name="q_six" value="{{ old('q_six') }}" class="form-control input-style" id="inputAddress2" placeholder="Answer...">
                                        @error('q_six')
                                            <span class="invalid-feedback" style="display:block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">7</span>
                                        </div>
                                        <input type="text" name="q_seven" value="{{ old('q_seven') }}" class="form-control input-style" id="inputAddress2" placeholder="Answer...">
                                        <div class="invalid-tooltip">
                                            Please choose a unique and valid username.
                                        </div>
                                    </div>
                                </div>
                                <!--დასრულდა - დამატებით სავარაუდო პასუხები-->


                                <!--დასრულდა - სავარაუდო პასუხები-->

                                <!-- დაიწყო - როდის იწყება და როდის მთავრდება გამოკოთხვა -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4" class="input__label">Poll starts</label>
                                        
                                        <div class="datepicker-dropdown">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="setdate_calendaricon las la-calendar-day"></i></span>
                                                </div>
                                                <input type="text" name="start_date" class="form-control input-style" value="{{ dayXnow() }}" id="pollstart_date" placeholder="Poll starts today?" readonly>
                                            </div>
                                            <div class="datepicker-dropdown-content">
                                                <div class="calendar-container" id="startdate"></div>
                                            </div>
                                        </div>
                                        <span><i>Example:</i> {{ dayXnow() }}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4" class="input__label">Poll ends</label>
                                        
                                        
                                        <div class="datepicker-dropdown">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="setdate_calendaricon las la-calendar-check"></i></span>
                                                </div>
                                                <input type="text" name="end_date" class="form-control input-style" value="{{ nextXday(10) }}" id="pollends_date" placeholder="When it ends?" readonly>
                                            </div>
                                            <div class="datepicker-dropdown-content">
                                                <div class="calendar-container" id="enddate"></div>
                                            </div>
                                        </div>
                                        <span><i>Example:</i> {{ nextXday(10) }}</span>
                                    </div>
                                </div>
                                <!-- დასრულდა - როდის იწყება და როდის მთავრდება გამოკოთხვა -->

                                <!--დაიწყო - მე მოვნიშნე ყველა პასუხი და მინდა გამოვაქვეყნო გამოკითხვა-->
                                <div class="form-check check-remember check-me-out">
                                    @if(old('offstatus')==1)
                                    <input type="checkbox" id="myCheck" class="form-check-input checkbox" onclick="checkthe()" checked>
                                    @else
                                    <input type="checkbox" id="myCheck" class="form-check-input checkbox" onclick="checkthe()">
                                    @endif
                                    <input type="hidden" name="offstatus" value="{{ old('offstatus') }}" id="putcheck">
                                    <label class="form-check-label checkmark" for="gridCheck">
                                        Let moderator to publish it late
                                    </label>
                                </div>
                                <!--დასრულდა - მე მოვნიშნე ყველა პასუხი და მინდა გამოვაქვეყნო გამოკითხვა-->
                            </div>
                        </div>
                    </div>
                </div>
                
                <link href="{{ asset('assets/tam-emoji/css/emoji.css') }}" rel="stylesheet">
                <link href="{{ asset('assets/summernote/summernote-bs4.css') }}" rel="stylesheet">
                <script src="{{ asset('assets/summernote/summernote-bs4.js') }}"></script>
                <div style="min-height: 20px;"></div>
                
                <div class="form-group">
                    <!--start tags-->
                    <div id="tags_to_save" style="display:none !important;">{!! old('answerskeeper') !!}</div>
                    <textarea id="save_answers" name="answerskeeper" style="display:none !important;">{{ old('answerskeeper') }}</textarea>
                    
                    <!--keep values tags-->
                    <textarea id="keep_input_values" name="keep_input_values" style="display:none !important;">{{ old('keep_input_values') }}</textarea>

                    <div class="w3-container">
                        <div class="tag-container" id="tc" style="display:none;"></div>  
                        <div id="new_chq"></div>
                        <input type="hidden" value="1" id="total_chq">
                    </div>
                    <!--end tags-->

                    <textarea name="content" id="summernote" style="display: none !important;">{{ old('content') }}</textarea>
                    
                    @error('content')
                        <span class="invalid-feedback" style="display:block !important;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <script>
                    getKeepenInputs();

                    function getKeepenInputs(){
                        // Decode the String
                        var decodedString = atob($('#keep_input_values').val());
                        $('#new_chq').html(decodedString);
                    }

                    function checkthe() 
                    {
                        var checkBox = document.getElementById("myCheck");
                        var text = document.getElementById("putcheck");
                        
                        if (checkBox.checked == true)
                        {
                            text.value = "1";
                        } 
                        else
                        {
                            text.value = "0";
                        }
                    }

                  </script>

                <!--Start upload file-->
        <textarea style="display:none !important;" name="attachment" id="attachment">{!! old('attachment') !!}</textarea>
        <div id="keep_links" style="display:none !important;">{!! old('attachment') !!}</div>


        <!--Save keep files-->
        <textarea style="display:none !important;" name="attachment-list" id="attachment-list">{!! old('attachment-list') !!}</textarea>
                
        <div id="message"></div>
                
        <table class="table table-bordered" id="attachs_table" style="display:none;">
            <thead>
                <tr>
                    <th style="padding:7px 10px !important;">Attachments</th>
                    <th style="width: 40px; padding:7px !important;" class="text-center">d</th>
                </tr>
            </thead>
            <tbody id="uploaded_image">
                <tr style="display:none !important">
                    <td style="padding:5px !important;"> 
                        <a href="#" style="padding:5px 7px !important;" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                    </td>
                    <td style="padding:7px !important;">
                        <button class='btn btn-light btn-outline-secondary btn-sm'>
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>    
            </tbody>
        </table>
        <script>
            $('#uploaded_image').append($('#attachment-list').val());
            if($('#attachment-list').val() != ''){
                $('#attachs_table').css('display','table');
            }

            $('#tags_to_save').bind('DOMSubtreeModified', function(){
                $('#save_answers').val($('#tags_to_save').html());
            });
        </script>

        <div id="filechooser" style="display: none;">
            <div class="gringo" style="min-height: 20px;"></div>
            <div class="upload_container">
                <div class="choose-f" id="choseb">Choose</div>
                <div class="choose-fname" id="path">File not chosen</div>
                <div class="choose-start" id="startupload">Upload</div>
            </div>
        </div>


                <button type="submit" class="btn btn-primary btn-style mt-4">Post</button>
            </form>





<!--uncompleted username here-->
<input type="hidden" id="utag_checkd">

<!--include tam-emoji js-->
<script src="{{ asset('assets/tam-emoji/js/config.js') }}"></script>
<script src="{{ asset('assets/tam-emoji/js/tam-emoji.min.js?v=1.1') }}"></script>

<form method="post" id="upload_form" enctype="multipart/form-data" style="display:none !important;">
    @csrf
    <input type="file" name="file" id="file" />
    <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload">
</form>
<script src="https://www.w3schools.com/lib/w3codecolor.js"></script>
<script type="text/javascript" src="{{ asset('assets/datepicker/jquery.datetimepicker.js') }}"></script>
<script type="text/javascript">
        $(document).ready(function(){
            function logEvent(type, date) {
                $("<div class='log__entry'/>").hide().html("<strong>"+type + "</strong>: "+date).prependTo($('#eventlog')).show(200);
            }
            $('#clearlog').click(function() {
                $('#eventlog').html('');
            });

        
            $('#startdate').datetimepicker({
                date: new Date(),
                viewMode: 'YMDHM',
                onDateChange: function(){
                    $('#pollstart_date').val(this.getText());
                }
            });

            $('#enddate').datetimepicker({
                date: new Date(),
                viewMode: 'YMDHM',
                onDateChange: function(){
                    $('#pollends_date').val(this.getText());
                }
            });
         
         
         
        
        });
w3CodeColor();

$(document).ready(function () {      
    document.emojiSource = "{{ asset('assets/tam-emoji/img') }}";
    var loaded = $('#summernote').summernote({
        placeholder: 'Put some text here...',
        spellCheck: false,
        tabsize: 2,
        height: 260,
        toolbar: [  
            ['history', ['undo', 'redo']],  
            ['smiles', ['emoji']], //emoji  
            ['style', ['style'],['code']],  
            ['font', ['bold', 'underline', 'clear']],  
            ['fontname', ['fontname']],  
            ['color', ['color']],  
            ['para', ['ul', 'ol', 'paragraph']],  
            ['table', ['table']],  
            ['insert', ['link', 'picture']],  
            ['view', ['fullscreen', 'help']]
  
        ]
       
    });

  $('#summernote').on('summernote.change', function(we, contents, $editable) {

        var str = $('.note-editable').html();
      
        var aaaa = str.split('@')[1];
        var part = str.substring(
            str.lastIndexOf("@") + 1, 
            str.lastIndexOf("2")
        );
       
            var raghac = str.split("@")[1].split(" ")[0];
            $('#utag_checkd').val(stripHtml(raghac));

            var word = $('#utag_checkd').val();
            $.get("{{ route('user_tags_json') }}?query="+word, function(data, status){

                var fuck =  document.getElementById('user_tags_dingdong');
                if (typeof(fuck) != 'undefined' && fuck != null)
                {   
                    $('#user_tags_dingdong').html(data);
                    w3.show('#user_tags_dingdong');
                }
                else{
                    var the_user_tags_body = '<div id="user_tags_dingdong" class="utsb">Checking...</div>';
                    $('.note-editing-area').append(the_user_tags_body); 
                }
                
            });

  });
   
  
    function stripHtml(html)
    {
        let tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }


    if(loaded){
        //alert();
        var mybutton = '<button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" id="sn_file_upload" title=""><i class="fas fa-upload"></i></button>';
        $('.note-insert').append(mybutton);

        var codebutton = '<button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" id="inscodepre"><i class="note-icon-code"></i></button>';
        $('.note-view').append(codebutton);

        var codebutton = '<button type="button" class="note-btn btn btn-light btn-sm" tabindex="-1" id="insspoiler" title="spoiler"><i class="fas fa-eye-slash"></i></button>';
        $('.note-style').append(codebutton);

    }
    
    $("#sn_file_upload").click(function(){
        w3.toggleShow('#filechooser');
        $('#file').click();
    }); 

    $("#inscodepre").click(function(){

        var code = '<div class="precode"><div class="codeby"><i class="fas fa-code"></i> CODE HERE</div><pre class="cssHigh">Put code here...</pre></div><p><br><br></p>';    
        $('#summernote').summernote('pasteHTML', code);
    }); 
    
    
    $("#insspoiler").click(function(){
        let rand = makeid(12);
        var code = '<div class="spoiler"><button type="button" class="colapse_triger text-left" data-toggle="collapse" data-target="#colapse_'+rand+'"><i class="fas fa-eye-slash" aria-hidden="true"></i>Spoiler</button><div id="colapse_'+rand+'" class="spoiler_body collapse">Put some text here...</div></div><p><br><br></p>';    
        $('#summernote').summernote('pasteHTML', code);
    }); 
    
    //$('#summernote').summernote('editor.insertText', $(this).text());
   

});


function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}


    function answer(name,to){
        var tc = document.getElementById("tc");
        var hm ="array[]";
        var new_chq_no = parseInt($('#total_chq').val())+1;
      
        if(!document.getElementById("new_"+Number(to)) && !document.getElementById("fula_"+Number(to))){
  
            var new_input="<input type='text' name="+hm+" id='new_"+Number(to)+"' value="+Number(to)+">";
            var q="'";
            tc.innerHTML += '<div class="tag tag label label-info" id="fula_'+Number(to)+'"><span>'+name+'</span><i class="fas fa-times-circle" style="font-size: 16px;" onclick="rem('+q+''+Number(to)+''+q+')"></i></div>';

            $('#tags_to_save').append('<button id="auo'+Number(to)+'" class="tag2"><span>@'+name+'</span></button>');
            
            var str = $('.note-editable').html();
            var toreplace = $('#utag_checkd').val();
            var replace_width = '<b>'+name+',</b>';
            var res = str.replace("@"+toreplace, replace_width);
            if(res){
                $('.note-editable').html(res);
                $('#user_tags_dingdong').hide();
                $('#utag_checkd').val('');
            }
        }

        //display: flex !important;
        if(tc.style.display=="none"){
            $('#tc').css('display', 'flex');
        }
        $('#new_chq').append(new_input);
        $('#total_chq').val(new_chq_no);
        tc.scrollIntoView();

        var encodedString = btoa($('#new_chq').html());

        $('#keep_input_values').val(encodedString);
        
    }
    
    function rem(w) {
        
        const tagvaluetext = $('#fula_'+Number(w)).html();
        const strippedString = tagvaluetext.replace(/(<([^>]+)>)/gi, "");
        if(strippedString){
            $("#fula_"+Number(w)).remove();
            $("#new_"+Number(w)).remove();
            $("#auo"+Number(w)).remove();
        
            if($('#new_chq').html()===''){
                $('#tc').css('display', 'none');
                $('#save_answers').val('');
            }
        }

            var str = $('.note-editable').html();
            var toreplace = '<b>'+strippedString+',</b>';
            var res = str.replace(toreplace, '');
            if(res){
                $('.note-editable').html(res);
            }


        
    }

    $.let_to_remove = function(id,fileextension) {
           
           $.post("{{ route('delete.attach') }}",
           {
               file: id,
               extension: fileextension
           },
           function(data){
               if(Number(data.del_status) == '1')
               {
                   del_this(data.file);
               }
           });
           

       };

       function del_attach(id,extension) {
           $.let_to_remove(id,extension);
       };
       
       function del_this(id){
           if($('#attach_'+id).remove())
           {
               if($('#attachment').val($('#keep_links').html()))
               {
                   delfile(id);
               }

           }      
       }
       function delfile(id){

           var a = document.getElementById("attachment");
           if (a.value == null || a.value == ""){
               if($('#attachment-list').val('')){
                   $('#message').html('');
                   $('#uploaded_image').html('');
                   
               }
               
           }
           else{
               if($('#file_'+id).remove()){
                   if($('#attachment-list').val('')){
                       $('#attachment-list').val($('#uploaded_image').html());
                   }
               }
           }
            
       }

       $(document).ready(function (e) {
            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });
            
               $('#upload_form').on('submit', function(event){
                   
                    event.preventDefault();
                     
                   $.ajax({
                         url:"{{ route('ajaxupload.action') }}",
                         method:"POST",
                         data: new FormData(this),
                         dataType:'JSON',
                         contentType: false,
                         cache: false,
                         processData: false,
                          success:function(data)
                           {
                               $('#path').html('Choose file to upload');
                               $('#message').html('<div id="uplalert" class="alert '+data.class_name+'">'+data.message+'</div>');
                               $('#uploaded_image').append(data.uploaded_image);
                               $('#attachment').val($('#attachment').val() + data.linkin_attach);
                               $('#keep_links').append(data.linkin_attach);
                               $('#attachment-list').val($('#attachment-list').val() + data.uploaded_image);
                               
                               if($('#attachs_table').css('display') == 'none'){
                                    $('#attachs_table').css('display','table');
                               }
                               $('#filechooser').hide();
                               //$('#uplalert').hide(900);
                               $("#uplalert").fadeOut(3000);
                                    
                           }
                   })
               });

               $('#choseb').click(function(){
                   $('#file').click();
               });
               
               $('input[type="file"]').change(function(e){
                   var fileName = e.target.files[0].name;
                   $('#path').html(fileName);
               });
               
               $('#startupload').click(function(){
                   $('#upload').click();
               });

       });

</script>
          












         





        </div>
    </div>





</div>



@endsection