
{{--  // modal here--}}
<div class="modal fade" id="sliderModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: gold">
                <h4 class="modal-title" id="modelTitle"></h4>
            </div>

            <form method="post" id="sliderForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="s_id" id="s_id"> {{--// this row id--}}
                    <input type="hidden" id="sliderHiddenImageName" name="sliderHiddenImageName"> {{--// this image name from database  --}}
                    <div class="form-group">
                        <label for="s_image"><h3>Slider Image</h3></label>
                        <input  type="file" class="form-control" id="s_image" name="s_image" accept="image/*" onchange="preview_image(event)">
                        <img style="width: 250px; height: 119px;" src="" id="output_image" alt="">

                    </div>

                    <div class="form-group form-check slider_status">
                        <label class="form-check-label">
                            <input  type="checkbox" class="form-check-input" id="s_status" name="s_status" value="1"> Slider Status
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="cancleButton" value="create">Cancle</button>
                        <button type="submit" class="btn btn-primary"  id="actionSubmitSlider" value="create">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- // modal here--}}

