
<!-- File Upload -->
<span style="font-size: 12px;  color: #a1a1a1;  margin-left: 10px;"><i class="icon-paper-clip icons"></i>&nbsp;
    Virtual Tour (Only zip file allowed)
</span>
<div id="upload-box" class="custom-file-input ot-center-text {{ Session::has('ResumeError') ? 'pulsate-regular' : '' }}">
<span class="fileinput-button btn btn-xs btn-success pull-left" style="margin-left: 10px; margin-top: 8px; color: white;">
        <i class="fa fa-cloud-upload icon-upload-custom"></i>
        {{ csrf_field() }}
        <span id="upload-title">
            @if($magazine->vtour)
                Change zip file
            @else
                Upload zip file
            @endif
        </span>
        <!-- The file input field used as target for the file upload widget -->
        {!! Form::file( 'file' , ['id' => 'FileUpload' , 'class' => 'disabled' , 'accept' => '.zip' ]) !!}
</span>
</div>
<!-- The global progress bar -->
<div  id="progress" class="progress progress-striped progress-custom active">
    <div id="progressBar" class="progress-bar progress-bar-success" role="progressbar">
    </div>
</div>
<!-- The container for the uploaded files -->
<div id="logo-thumb-container">
    @if($magazine->vtour)
        <a href="{{ $magazine->fullVtour }}" class="resume-upload-link btn btn-xs btn-info" style="margin-left: 3px;" target="_blank">
            <i class="fa fa-eye fa-1x"></i>&nbsp;View
        </a>
        <a href="{{route('admin.stores.removeFile' ,  $magazine )}}" class="resume-upload-link confirmation-remove btn btn-xs btn-danger">
            <i class="fa fa-times"></i>
        </a>
    @endif
</div>
<div id="logo-error-reporting"></div>
<!-- File Upload -->
