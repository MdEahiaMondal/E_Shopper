
{{--  // modal here--}}
<div class="modal fade" style="width: 695px" id="productModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: gold">
                <h4 class="modal-title" id="modelTitle"></h4>
            </div>


            <form   id="productForm" name="productForm" enctype="multipart/form-data">

                <div class="modal-body">

                    <input type="hidden" name="row_id" id="row_id"> {{--// this row id--}}
                    <input type="hidden" id="productHiddenImageName" name="productHiddenImageName"> {{--// this image name from database  --}}

                    <div class="span5">
                        <div class="form-group">
                            <label for="name"><h3>Name <sup style="color: #f82f53">*</sup> </h3></label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Product Name" >
                            <p class="removeErrorText" id="error_Name"></p>
                        </div>

                        <div class="form-group">
                            <label for="price"><h3>Price <sup style="color: #f82f53">*</sup></h3></label>
                            <input type="text" name="price" value="{{old('price')}}" id="price" placeholder="Product Price">
                            <p class="removeErrorText" id="error_price"></p>
                        </div>

                        <div class="form-group">
                            <label for="quantity"><h3>Quantity <sup style="color: #f82f53">*</sup></h3></label>
                            <input type="text" name="quantity" value="{{old('quantity')}}" id="quantity" placeholder="Product Quantity">
                            <p class="removeErrorText" id="error_quantity"></p>
                        </div>

                        <div class="form-group">
                            <label for="size"><h3>Size</h3></label>
                            <input type="text" name="size" value="{{old('size')}}" id="size" placeholder="Product Size">
                        </div>

                        <div class="form-group">
                            <label for="color"><h3>Color</h3></label>
                            <input type="text" name="color" value="{{old('color')}}" id="color">
                        </div>


                        <div class="form-group form-check">
                            <div class="span3">
                                <label class="form-check-label">
                                    <input type="checkbox" name="features" value="1" class="form-check-input" id="features">Features
                                </label>
                            </div>

                            <div class="span3">
                                <label class="form-check-label">
                                    <input type="checkbox"  name="status" value="1" class="form-check-input" id="status"> Status
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="span5">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="category_id"> <h3>Select Category <sup style="color: #f82f53">*</sup></h3></label>
                            </div>
                            <select class="custom-select" id="category_id" name="category_id">
                                <option value="selectedCategoryValue" selected>Choose...</option>
                            </select>
                            <p class="removeErrorText" id="error_category_id"></p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="brand_id"> <h3>Select Brand <sup style="color: #f82f53">*</sup></h3></label>
                            </div>
                            <select class="custom-select" id="brand_id" name="brand_id">
                                <option value="selectedBrandValue" selected>Choose...</option> {{--// only for selected value="selectedBrandValue"--}}
                            </select>
                            <p class="removeErrorText" id="error_brand_id"></p>
                        </div>
                        <div class="form-group">
                            <label for="description"><h3>Description <sup style="color: #f82f53">*</sup></h3></label>
                            <textarea name="description" id="description" cols="30" rows="10" placeholder="Please type something aboout your product">{{old('description')}}</textarea>
                            <p class="removeErrorText" id="error_description"></p>
                        </div>

                        <div class="form-group form-check">
                            <label for="image"><h3>Image</h3></label>
                            <input type="file" name="image" id="image" accept="image/*" onchange="preview_image(event)">
                            <p class="removeErrorText" id="error_image"></p>
                        </div>

                        <div class="form-group form-check" >
                            <h2 class="">Preview</h2>
                            <div style="border: groove; width: 243px; height: 183px;">
                                <img style="width: 243px; height: 183px;" src="" id="output_image" alt="">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="cancleButton" value="create">Cancle</button>
                        <button type="submit" class="btn btn-success"  id="actionButton" value="create">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- // modal here--}}


<style>
    .errorsProduct{
        color: red;
        margin-bottom: 30px;
    }
    .borderColor{
        border-color: #FF0000;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
    }
</style>
