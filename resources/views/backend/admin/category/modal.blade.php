{{--  // modal here--}}
<div class="modal fade" id="categoryModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: gold">
                <h4 class="modal-title" id="modelTitle"></h4>
            </div>
            <p id="result"></p>
            <div class="modal-body">
                <input type="hidden" name="row_id" id="row_id">

                <div class="form-group">
                    <label for="name"><h3>Category Name<sup class="star-danger">*</sup></h3></label>
                    <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" placeholder="Enter Category Name" >
                </div>
                <div class="form-group">
                    <label for="description"><h3>Description:</h3></label>
                    <textarea id="description" name="description" cols="30" rows="10">{{old('description')}}</textarea>
                </div>

            {{--    <div class="form-group">
                    <label for="image"><h3>Image:</h3></label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="preview_image(event)">
                    <img style="width: 250px; height: 119px;" src="" id="output_image" alt="">
                </div>
--}}
                <div class="form-group form-check hideStatus">
                    <label class="form-check-label">
                        <input class="form-check-input"   type="checkbox" id="status" name="status" value="1"> Category Status
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
