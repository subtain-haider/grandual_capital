@extends('admin.app')

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

    
 <!-- content @s -->

 <div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Add Product </h3>
                        </div><!-- .nk-block-head-content -->
                       
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-12">
                                <div class="col-12 div_alert">
                                </div>
                                <div class="card card-full">
                                    <div class="nk-ecwg nk-ecwg8 h-100">
                                        <div class="card-inner ml-1 mr-1 my-1">
                                               <form class="form-validate is-alter" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" >
                                                    @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" >Product Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" name="name" required aria-required aria-invalid="false" class="form-control"  placeholder="Enter Product Name" required> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="default-06">Product Featured</label>
                                                        <div class="form-control-wrap ">
                                                            <div class="form-control-select">
                                                                <select class="form-control"  data-style="btn btn-rose btn-round" title="Featured" name="featured"   id="default-06">
                                                                    <option value="default_option" disabled selected>Select Featured</option>
                                                                    <option value="1">True</option>
                                                                     <option value="0" selected>False</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label " >Product Key </label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" name="key" required value="GrandeurCapital" class="form-control"  placeholder=" Product Key "  required> 
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Product Video</label>
                                                        <div class="form-control-wrap">
                                                            <input  type="text" name="video" class="form-control"  placeholder=" Product Video "  required> 
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="default-07">Category</label>
                                                        <div class="form-control-wrap ">
                                                            <div class="form-control-select">
                                                                <select class="form-control"  data-style="btn btn-rose btn-round" title="Select Category" name="category_id"  id="default-07">
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" >Product Thumbnail</label>
                                                        <div class="form-control-wrap">
                                                            <div class="fileinput text-center fileinput-new" data-provides="fileinput">
{{--                                                                <div class="fileinput-new thumbnail">--}}
{{--                                                                  <img src="{{asset('assets/admin/img/image_placeholder.jpg')}}" alt="...">--}}
{{--                                                                </div>--}}
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
                                                                <div>
                                                                  <span class="btn btn-rose btn-round btn-file">
                                                                    <span class="fileinput-new">Select image</span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="file" name="image" required>
                                                                  <div class="ripple-container"></div></span>
{{--                                                                  <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove<div class="ripple-container"><div class="ripple-decorator ripple-on ripple-out" style="left: 55.4062px; top: 24px; background-color: rgb(255, 255, 255); transform: scale(15.5098);"></div></div></a>--}}
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" >Product Gallery</label>
                                                        <div class="form-control-wrap">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"  name="gallery[]" multiple  >
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" >Product File</label>
                                                        <div class="form-control-wrap">
                                                            <div class="custom-file">
                                                                <input class="custom-file-input" type="file" name="download_file" >
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" >One Line Description </label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" name="one_description" class="form-control"  placeholder=" Enter One Line Description "  required> 
                                                        </div>
                                                    </div>

                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="product-desc">Description</label>
                                                            <div class="form-control-wrap">
                                                                <textarea  class="form-control" name="description" id="editor"  ></textarea>
                                                            </div>
                                                        </div>
            
                                                    <div class="form-group col-md-12 ">
                                                        <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                    </div><!-- .card-inner -->
                                </div>
                            </div><!-- .card -->                      
                        </div><!-- .col -->
                    </div><!-- .row -->


                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>


<!-- content @e -->
    <script>
        class MyUploadAdapter {
            constructor( loader ) {
                // The file loader instance to use during the upload. It sounds scary but do not
                // worry — the loader will be passed into the adapter later on in this guide.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then( file => new Promise( ( resolve, reject ) => {
                        this._initRequest();
                        this._initListeners( resolve, reject, file );
                        this._sendRequest( file );
                    } ) );
            }

            // Aborts the upload process.
            abort() {
                if ( this.xhr ) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open( 'POST', '/admin/product/image/upload', true );
                xhr.setRequestHeader('x-csrf-token', '{{csrf_token()}}');
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners( resolve, reject, file ) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener( 'error', () => reject( genericErrorText ) );
                xhr.addEventListener( 'abort', () => reject() );
                xhr.addEventListener( 'load', () => {
                    const response = xhr.response;

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if ( !response || response.error ) {
                        return reject( response && response.error ? response.error.message : genericErrorText );
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve( {
                        default: response.url
                    } );
                } );

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if ( xhr.upload ) {
                    xhr.upload.addEventListener( 'progress', evt => {
                        if ( evt.lengthComputable ) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    } );
                }
            }

            // Prepares the data and sends the request.
            _sendRequest( file ) {
                // Prepare the form data.
                const data = new FormData();

                data.append( 'upload', file );

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send( data );
            }
        }

        function SimpleUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter( loader );
            };
        }

        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                extraPlugins: [ SimpleUploadAdapterPlugin ],

                // ...
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
