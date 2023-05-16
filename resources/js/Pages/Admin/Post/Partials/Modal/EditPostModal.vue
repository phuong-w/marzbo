<template>
    <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-700px" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    <div class="compose-box">
                        <div class="compose-content" id="editPostModalTitle">
                            <h5 class="">Edit Post</h5>
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex mail-to mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 flaticon-notes"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            <div class="w-100">
                                                <span class="text-uppercase font-weight-bold" id="sSocialMediaName">Facebook</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex  mail-subject mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text flaticon-menu-list"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    <div class="w-100" id="boxDescription">
                                        <textarea id="postDescription"></textarea>
                                        <span class="validation-text"></span>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button class="btn btn-update-post">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
@import "/resources/sass/plugins/editors/markdown/simplemde.min.scss";
</style>

<style scoped>
.mw-700px {
    max-width: 700px;
}

.modal-footer .btn[data-dismiss="modal"] {
    background-color: #fff;
    color: #4361ee;
    font-weight: 700;
    border: 1px solid #e8e8e8;
    padding: 10px 25px;
}

.btn-update-post {
    background-color: #4361ee;
    color: #fff;
    font-weight: 600;
    border: 1px solid #4361ee;
    padding: 10px 25px;
}
</style>
