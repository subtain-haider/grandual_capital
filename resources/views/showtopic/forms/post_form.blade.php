<link href="{{ asset('assets/tam-emoji/css/emoji.css') }}" rel="stylesheet">

<link href="{{ asset('assets/summernote/summernote-bs4.css') }}" rel="stylesheet">
<script src="{{ asset('assets/summernote/summernote-bs4.js') }}"></script>
<div style="min-height: 20px;"></div>
<style>
    .dropdown_tags{
        position: absolute;
        transform: translate3d(0px, 38px, 0px);
        top: 0px;
        left: 0px;
        will-change: transform;
        margin-top: -35px;
        width: 100%;
    }
    
</style>

<div class="topic_textarea bg-white">
    <form action="{{ route('showtopic', [$topicid]) }}" method="post">
        <div id="tags_to_save" style="display:none !important;"></div>

        <textarea id="save_answers" name="answerskeeper" style="display:none !important;"></textarea>
        
        {{ csrf_field() }}
        <div class="w3-container">
            <div class="tag-container" id="tc" style="display:none;"></div>  
            <div id="new_chq"></div>
            <input type="hidden" value="1" id="total_chq">
        </div>

        
        <textarea name="content" id="summernote" style="display: none !important;">{{ old('content') }}</textarea>
                    
        @error('content')
            <span class="invalid-feedback" style="display:block !important;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
         @enderror
        



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

</div>

<!--uncompleted username here-->
<input type="hidden" id="utag_checkd">

<!--include tam-emoji js-->
<script src="{{ asset('assets/tam-emoji/js/config.js') }}"></script>
<script src="{{ asset('assets/tam-emoji/js/tam-emoji.min.js?v=1.1') }}"></script>

<form method="post" id="upload_form" enctype="multipart/form-data" style="display:none !important;">
    {{ csrf_field() }}
    <input type="file" name="file" id="file" />
    <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload">
</form>
<script src="https://www.w3schools.com/lib/w3codecolor.js"></script>
<script>
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
                    var the_user_tags_body = '<div id="user_tags_dingdong" class="utsb">6666</div>';
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



function quote(id) {
    $.insintosummernote(id);
};
$.insintosummernote = function(id) {
    //$('#summernote').summernote('editor.insertText', $('#pcont_'+id).text());
    var posturl = "{{ route('showtopic', ['id' => $topicid, 'page' => $current_page]) }}#p";
    var quote_by = $('#pby'+id).text();
    var a ='<blockquote cite="'+posturl+id+'"><div class="quote_by"><i class="fas fa-quote-right"></i>by '+quote_by+'</div>';
    var b = $('#pcont_'+id).html();
    var c = '</blockquote><p><br><br></p>';
    var d = a+b+c;

    $('#summernote').summernote('pasteHTML', d);

}
           
    function answer(name,to){
        var tc = document.getElementById("tc");
        var hm ="array[]";
        var new_chq_no = parseInt($('#total_chq').val())+1;
      
        if(!document.getElementById("new_"+Number(to)) && !document.getElementById("fula_"+Number(to))){
            
            var new_input="<input type='hidden' name="+hm+" id='new_"+Number(to)+"' value="+Number(to)+">";
            var q="'";
            tc.innerHTML += '<div class="tag tag label label-info" id="fula_'+Number(to)+'"><span>'+name+'</span><i class="fas fa-times-circle" style="font-size: 16px;" onclick="rem('+q+''+Number(to)+''+q+')"></i></div>';

            $('#tags_to_save').append('<button id="auo'+Number(to)+'" class="tag2"><span>@'+name+'</span></button>');
            
           
            var str = $('.note-editable').html();
            var toreplace = $('#utag_checkd').val();
            var replace_width = '<b>'+name+'</b>,';

            var x = document.querySelector(".note-editable");
            
            //display: flex !important;
            if(tc.style.display=="none"){
                $('#tc').css('display', 'flex');
            }
            $('#new_chq').append(new_input);
            $('#total_chq').val(new_chq_no);
            tc.scrollIntoView();

            if($('#utag_checkd').val() == ""){
                $('#summernote').summernote('pasteHTML', replace_width);
                $('#utag_checkd').val('');
            }
            else
            {
                var res = x.innerHTML.replace("@"+toreplace, replace_width);

                if(res){
                    x.innerHTML = res;
                    $('#user_tags_dingdong').hide();
                    $('#utag_checkd').val('');
               
                    
                }
            }
            
            
            
           
        }
       
        
        
         
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

       $(document).ready(function() {
       
        $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
   
       });

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

               $('#upload_form').on('submit', function(event){
                     event.preventDefault();
                     
                   $.ajax({
                         url:"{{ route('ajaxupload.action') }}",
                         method:"POST",
                         data:new FormData(this),
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

