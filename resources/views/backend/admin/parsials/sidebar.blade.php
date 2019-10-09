<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li><a href="{{URL::to('admin/dashboard')}}"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
            <li><a class="submenu" href="{{route('categories.index')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Categories</span></a></li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Brand</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{URL::to('all-brand')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Brands</span></a></li>
                    <li><a class="submenu" href="{{URL::to('add-brand')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Brand</span></a></li>
                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Product</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{URL::to('all-product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Products</span></a></li>
                    <li><a class="submenu" href="{{URL::to('add-product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Product</span></a></li>
                    <li><a class="submenu" href="{{URL::to('recycle-product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Recycle Bin</span></a></li>
                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Slider</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{URL::to('add-slider')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Add Slider</span></a></li>
                    <li><a class="submenu" href="{{URL::to('all-slider')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Slider</span></a></li>
                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Order</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{URL::to('all-order')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Orders</span></a></li>
                </ul>
            </li>
            <li><a href="form.html"><i class="icon-edit"></i><span class="hidden-tablet"> Social Links</span></a></li>
            <li><a href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Delevaries Man</span></a></li>
            <li><a href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Shop Name</span></a></li>
        </ul>
    </div>
</div>
<!-- end: Main Menu -->
