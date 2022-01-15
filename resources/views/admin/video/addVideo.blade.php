@extends('admin.app')

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

    <style>
    .bootstrap-select
    {
        width: 100% !important;
    }
</style>
 <!-- content @s -->

 <div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Add Video </h3>
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
                                            <form class="form-horizontal" action="{{route('admin.video.store')}}" method="POST" enctype="multipart/form-data" >
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="form-label" >Video Title</label>
                                                        <div class="form-control-wrap">
                                                            <input class="form-control"  type="text" name="name" required aria-required aria-invalid="false"> 
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group col-md-4">
                                                        <label class="form-label " >Video </label>
                                                        <div class="form-control-wrap">
                                                            <input class="form-control"  type="file" name="video" required >
                                                        </div>
                                                    </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="form-label" for="default-06">Category</label>
                                                            <div class="form-control-wrap ">
                                                                <div class="form-control-select">
                                                                    <select class="form-control" data-style="btn btn-rose btn-round" title="Select Category" name="category_id" required>
                                                                        @foreach ($categories as $category)
                                                                                <option value="{{$category->id}}">{{$category->category}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="product-desc">Description</label>
                                                            <div class="form-control-wrap">
                                                                <input  class="form-control" type="text" name="one_description" required >
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
