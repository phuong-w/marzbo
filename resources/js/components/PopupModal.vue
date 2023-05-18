<template>
    <div class="container d-flex justify-content-center">
        <div id="popup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-body p-0">
                        <div class="card border-0 p-sm-3 p-2 justify-content-center">
                            <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div> </div>
                                <p class="font-weight-bold mb-2"> Are you sure ?</p><p class="text-muted"> You will not be able to revert this.</p>
                            </div>
                            <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                                <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted mr-2" data-dismiss="modal">Cancel</button></div><div class="col-auto"><button type="button" id="sConfirmDelete" class="btn btn-danger px-4" data-dismiss="modal" >Delete</button></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
button{
    font-size: calc(12px + (16 - 12) * ((100vw - 360px) / (1600 - 300))) !important;
}

p {
    font-size: calc(13px + (16 - 13) * ((100vw - 360px) / (1600 - 300))) !important;
}

button:focus {
    box-shadow: none !important;
    outline-width: 0;
}

.card{
    border-radius :12px;
    width: calc(500px + 10 * ((100vw - 320px) / 680)) ;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.8) ;
}

.card-header{
    border-radius :12px !important;
}

.modal-body .btn-danger{
    border-radius: 11px ;
    box-shadow:  0px 5px 5px rgba(0, 0, 0, 0.2) ;
}
.btn-light{
    background: transparent !important;
    border:0px !important;
}

.btn-light:hover{
    border-color:#fff !important;
}

.btn-light:active{
    border-color:#fff !important;
}

@media (max-width: 526px) {
    .card{
        width: unset;
    }
}

span{
    font-size: 30px !important;
}

.modal-content{
    background: transparent !important;
}
</style>
