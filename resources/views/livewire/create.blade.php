<div wire:ignore.self class="modal fade" id="add-product" aria-hidden="true" style="display:none" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" wire:model='name'>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" wire:model='description'>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" wire:model='price'>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Image</label>
                                {{-- @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="d-block mb-2" style="width:50px;" alt="">
                                @endif --}}
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" wire:model='image' name="image" class="custom-file-input"
                                            wire:model='image'>
                                        {{-- <label class="custom-file-label">
                                            @if ($image)
                                            {{$image->getClientOriginalName()}}
                                            @else
                                            Choose file</label>
                                        @endif --}}

                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent='store()'>Add Product</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>