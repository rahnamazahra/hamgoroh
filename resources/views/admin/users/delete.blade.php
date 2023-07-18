<!--begin::Modal-->
<div wire:ignore.self class="modal fade" id="UserDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-between">
                <h5 class="modal-title">آیا از حذف این آیتم مطمعن هستید؟</h5>
                <!--begin::Close-->
                <div wire:click.prevent="cancelUser()" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opaUser="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <form>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="deleteUser()" class="btn btn-primary" data-bs-dismiss="modal">بله</button>
                <button type="button" wire:click.prevent="cancelUser()" class="btn btn-light" data-bs-dismiss="modal">انصراف</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--end::Modal-->



