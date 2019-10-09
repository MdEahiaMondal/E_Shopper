{{--  // modal here--}}
<div class="modal fade" id="categoryModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: gold">
                <h4 class="modal-title" id="modelTitle"></h4>
            </div>
            <p id="result"></p>
            <div class="modal-body">
                <input type="hidden" name="c_id" id="c_id">

                <div class="form-group">
                    <label for="c_name"><h3>Category Name<sup class="star-danger">*</sup></h3></label>
                    <input type="text" class="form-control" value="{{old('c_name')}}" name="c_name" id="c_name" placeholder="Enter Category Name" >
                </div>
                <div class="form-group">
                    <label for="c_description"><h3>Description:</h3></label>
                    <textarea id="c_description" name="c_description" cols="30" rows="10">{{old('c_description')}}</textarea>
                </div>

                <div class="form-group form-check hideMeC_status">
                    <label class="form-check-label">
                        <input class="form-check-input"   type="checkbox" id="c_status" name="c_status" value="1"> Category Status
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="cancleButton" value="create">Cancle</button>
                    <button type="submit" class="btn btn-primary" onclick="store()" id="createtButton">Create</button>
                    <button type="submit" class="btn btn-primary" onclick="update()" id="updatButton" >Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- // modal here--}}
