<div class="create-comment__block overflow-hidden position-relative shadow brad-2 p-3 mb-5" style="display: none;">
    <div class="modal-white" style="display: none;">
        <div class="center position-absolute">
            <div class="lds-dual-ring"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-check-label  carmine" for="text">
            Comment
        </label>
        <textarea class="form-control" name="text" id="text"></textarea>
    </div>
    <div class="form-group">
        <label  class="form-check-label carmine" for="rate">
            Rate
        </label>
        <input type="number" step="0.1" name="rate" min="0" max="5" class="form-control w-auto" size="2" id="rate">
    </div>
    <div class="form-group mb-0">
        <button type="submit" class="save-comment btn btn-group carmine-bg text-white">Save</button>
    </div>
</div>
