<div id="createNewGroup" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title group-modal-title">{{ __('messages.group.create_group') }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {!! Form::open(['id'=>'createGroupForm']) !!}
            @csrf
            <div class="modal-body">
                <div class="form-group col-sm-12">
                    <div class="alert alert-danger" style="display: none" id="groupValidationErrorsBox"></div>
                </div>
                <input type="hidden" name="id" value="" id="groupId">
                <div class="row flex-lg-row flex-column-reverse">
                    <div class="col-lg-6">
                        {!! Form::label('name', __('messages.group.name').':',['class' => 'login-group__sub-title']) !!}<span class="red">*</span>
                        {!! Form::text('name', null, ['class' => 'form-control login-group__input', 'required', 'id' => 'groupName']) !!}
                    </div>
                    <div class="col-lg-6 d-flex edit-profile-image">
                        <div class="col-lg-6 pl-0 edit-profile-btn">
                            {!! Form::label('photo', 'Group Icon'.':', ['class' => 'login-group__sub-title']) !!}
                            <label class="edit-profile__file-upload btn-primary mb-0"> {{__('messages.group.choose_file')}}
                                {!! Form::file('photo',['id'=>'groupImage','class' => 'd-none']) !!}
                            </label>
                        </div>
                        <div class="mt-2 profile__inner m-auto">
                            <div class=" preview-image-video-container text-center chat-profile__img-wrapper mt-0">
                                <img id='groupPhotoPreview' class=""
                                     src="{{asset('assets/images/group-img.png')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-lg-6 mt-lg-0 mt-3 radio-group-section">
                        <div class="div-group-type d-flex">
                            <div class="mr-3">
                                {!! Form::label('type', __('messages.group.type'),['class' => 'login-group__sub-title']).":" !!}<span class="red">*</span>
                            </div>
                            <div class="d-flex justify-content-around radio-group-type">
                                <div class="mr-3">
                                    {!! Form::radio('group_type', 1, true, ['class' => 'group-type', 'id' => 'groupTypeOpen']) !!} {{ __('messages.group.open') }}
                                    <i class="fa fa-question-circle ml-2 question-type-open cursor-pointer"
                                       data-toggle="tooltip" data-placement="top"
                                       title="All group members can send messages into the group."></i>
                                </div>
                                <div>
                                    {!! Form::radio('group_type', 2, false, ['class' => 'group-type', 'id' => 'groupTypeClose']) !!} {{ __('messages.group.close') }}
                                    <i class="fa fa-question-circle ml-2 question-type-close cursor-pointer"
                                       data-toggle="tooltip" data-placement="top"
                                       title="The admin only can send messages into the group."></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-3 ">
                        <div class="div-group-privacy d-flex">
                            <div class="mr-3">
                                {!! Form::label('privacy', __('messages.group.privacy'),['class' => 'login-group__sub-title']).":" !!}<span
                                        class="red">*</span>
                            </div>
                            <div class="d-flex justify-content-around ml-1 radio-group-type">
                                <div class="mr-3">
                                    {!! Form::radio('privacy', 1, true, ['class' => 'group-privacy', 'id' => 'groupPublic']) !!} {{ __('messages.group.public') }}
                                    <i class="fa fa-question-circle ml-2 question-type-public cursor-pointer"
                                       data-toggle="tooltip" data-placement="top"
{{--                                       title="All group members can add or remove members from the group."--}}
                                       title="All existing and new members will be added in this group automatically."
                                    ></i>
                                </div>
                                <div>
                                    {!! Form::radio('privacy', 2, false, ['class' => 'group-privacy', 'id' => 'groupPrivate']) !!} {{ __('messages.group.private') }}
                                    <i class="fa fa-question-circle ml-2  question-type-private cursor-pointer"
                                       data-toggle="tooltip" data-placement="top"
{{--                                       title="The admin only can add or remove members from the group."--}}
                                       title="Admin have to choose members to add."
                                    ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="groupMembersList">
                    <div class="col-sm-12">
                        {!! Form::label('users', __('messages.group.members'),['class' => 'login-group__sub-title']).":" !!}<span class="red">*</span>
                        @livewire('search-group-members-for-create-group')
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12 text-left">
                        {!! Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnCreateGroup','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) !!}
                        <button type="button" id="btnCancel" class="btn btn-secondary ml-1"
                                data-dismiss="modal">{{ __('messages.cancel') }}
                        </button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
