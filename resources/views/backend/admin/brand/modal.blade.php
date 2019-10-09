{{--  // modal here--}}
<div class="modal fade" id="brandModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: gold">
                <h4 class="modal-title" id="modelTitle"></h4>
            </div>
            <p id="result"></p>
            <div class="modal-body">
                <input type="hidden" name="brand_id" id="brand_id">

                <div class="form-group">
                    <label for="b_name"><h3>Brand Name<sup class="star-danger">*</sup></h3></label>
                    <input type="text" class="form-control" value="{{old('b_name')}}" name="b_name" id="b_name" placeholder="Enter Brand Name" >
                </div>
                <div class="form-group">
                    <label for="b_description"><h3>Description:</h3></label>
                    <textarea id="b_description" name="b_description" cols="30" rows="10">{{old('b_description')}}</textarea>
                </div>

                <div class="form-group form-check brand_checkbox">
                    <label class="form-check-label">
                        <input class="form-check-input"   type="checkbox" id="b_status" name="b_status" value="1"> Brand Status
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="cancleButton" value="create">Cancle</button>
                    <button type="submit" class="btn btn-primary" onclick="create()" id="createtButton">Create</button>
                    <button type="submit" class="btn btn-primary" onclick="update()" id="updatButton" >Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- // modal here--}}
