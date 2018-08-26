@extends('backend.app')
@section('content')
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Basic example</h4>
                <p class="text-muted font-14 mb-4">
                    For basic styling—light padding and only horizontal dividers—add the base class <code>.table</code> to any <code>&lt;table&gt;</code>.
                </p>

                <div class="table-responsive-sm">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Date of Birth</th>
                                <th>Active?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Risa D. Pearson</td>
                                <td>336-508-2157</td>
                                <td>July 24, 1950</td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input type="checkbox" id="switch1" checked="" data-switch="success">
                                        <label for="switch1" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Ann C. Thompson</td>
                                <td>646-473-2057</td>
                                <td>January 25, 1959</td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input type="checkbox" id="switch2" checked="" data-switch="success">
                                        <label for="switch2" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Paul J. Friend</td>
                                <td>281-308-0793</td>
                                <td>September 1, 1939</td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input type="checkbox" id="switch3" data-switch="success">
                                        <label for="switch3" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Linda G. Smith</td>
                                <td>606-253-1207</td>
                                <td>May 3, 1962</td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input type="checkbox" id="switch4" data-switch="success">
                                        <label for="switch4" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Inverse table</h4>
                <p class="text-muted font-14 mb-4">
                    You can also invert the colors—with light text on dark backgrounds—with <code>.table-dark</code>.
                </p>

                <div class="table-responsive-sm">
                    <table class="table table-dark mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Date of Birth</th>
                                <th>Active?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Risa D. Pearson</td>
                                <td>336-508-2157</td>
                                <td>July 24, 1950</td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input type="checkbox" id="switch6" data-switch="success">
                                        <label for="switch6" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Ann C. Thompson</td>
                                <td>646-473-2057</td>
                                <td>January 25, 1959</td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input type="checkbox" id="switch7" checked="" data-switch="success">
                                        <label for="switch7" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Paul J. Friend</td>
                                <td>281-308-0793</td>
                                <td>September 1, 1939</td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input type="checkbox" id="switch8" data-switch="success">
                                        <label for="switch8" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Sean C. Nguyen</td>
                                <td>269-714-6825</td>
                                <td>February 5, 1994</td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input type="checkbox" id="switch10" checked="" data-switch="success">
                                        <label for="switch10" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Striped rows</h4>
                <p class="text-muted font-14 mb-4">
                    Use <code>.table-striped</code> to add zebra-striping to any table row
                    within the <code>&lt;tbody&gt;</code>.
                </p>

                <div class="table-responsive-sm">
                    <table class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Account No.</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-2.jpg" alt="table-user" class="mr-2 rounded-circle">
                                    Risa D. Pearson
                                </td>
                                <td>AC336 508 2157</td>
                                <td>July 24, 1950</td>
                                <td class="table-action">
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-3.jpg" alt="table-user" class="mr-2 rounded-circle">
                                    Ann C. Thompson
                                </td>
                                <td>SB646 473 2057</td>
                                <td>January 25, 1959</td>
                                <td class="table-action">
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-4.jpg" alt="table-user" class="mr-2 rounded-circle">
                                    Paul J. Friend
                                </td>
                                <td>DL281 308 0793</td>
                                <td>September 1, 1939</td>
                                <td class="table-action">
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-5.jpg" alt="table-user" class="mr-2 rounded-circle">
                                    Sean C. Nguyen
                                </td>
                                <td>CA269 714 6825</td>
                                <td>February 5, 1994</td>
                                <td class="table-action">
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Bordered table</h4>
                <p class="text-muted font-14 mb-4">
                    Add <code>.table-bordered</code> for borders on all sides of the table and cells.
                </p>

                <div class="table-responsive-sm">
                    <table class="table table-bordered table-centered mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Account No.</th>
                                <th>Balance</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-6.jpg" alt="table-user" class="mr-2 rounded-circle">
                                    Risa D. Pearson
                                </td>
                                <td>AC336 508 2157</td>
                                <td>July 24, 1950</td>
                                <td class="table-action text-center">
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-7.jpg" alt="table-user" class="mr-2 rounded-circle">
                                    Ann C. Thompson
                                </td>
                                <td>SB646 473 2057</td>
                                <td>January 25, 1959</td>
                                <td class="table-action text-center">
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-8.jpg" alt="table-user" class="mr-2 rounded-circle">
                                    Paul J. Friend
                                </td>
                                <td>DL281 308 0793</td>
                                <td>September 1, 1939</td>
                                <td class="table-action text-center">
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-user">
                                    <img src="assets/images/users/avatar-9.jpg" alt="table-user" class="mr-2 rounded-circle">
                                    Sean C. Nguyen
                                </td>
                                <td>CA269 714 6825</td>
                                <td>February 5, 1994</td>
                                <td class="table-action text-center">
                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->


<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Hoverable rows</h4>
                <p class="text-muted font-14 mb-4">
                    Add <code>.table-hover</code> to enable a hover state on table rows within a <code>&lt;tbody&gt;</code>.
                </p>

                <div class="table-responsive-sm">
                    <table class="table table-hover table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ASOS Ridley High Waist</td>
                                <td>$79.49</td>
                                <td><span class="badge badge-primary">82 Pcs</span></td>
                                <td>$6,518.18</td>
                            </tr>
                            <tr>
                                <td>Marco Lightweight Shirt</td>
                                <td>$128.50</td>
                                <td><span class="badge badge-primary">37 Pcs</span></td>
                                <td>$4,754.50</td>
                            </tr>
                            <tr>
                                <td>Half Sleeve Shirt</td>
                                <td>$39.99</td>
                                <td><span class="badge badge-primary">64 Pcs</span></td>
                                <td>$2,559.36</td>
                            </tr>
                            <tr>
                                <td>Lightweight Jacket</td>
                                <td>$20.00</td>
                                <td><span class="badge badge-primary">184 Pcs</span></td>
                                <td>$3,680.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Small table</h4>
                <p class="text-muted font-14 mb-4">
                    Add <code>.table-sm</code> to make tables more compact by cutting cell padding in half.
                </p>

                <div class="table-responsive-sm">
                    <table class="table table-sm table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ASOS Ridley High Waist</td>
                                <td>$79.49</td>
                                <td><span class="badge badge-primary">82 Pcs</span></td>
                                <td>$6,518.18</td>
                            </tr>
                            <tr>
                                <td>Marco Lightweight Shirt</td>
                                <td>$128.50</td>
                                <td><span class="badge badge-primary">37 Pcs</span></td>
                                <td>$4,754.50</td>
                            </tr>
                            <tr>
                                <td>Half Sleeve Shirt</td>
                                <td>$39.99</td>
                                <td><span class="badge badge-primary">64 Pcs</span></td>
                                <td>$2,559.36</td>
                            </tr>
                            <tr>
                                <td>Lightweight Jacket</td>
                                <td>$20.00</td>
                                <td><span class="badge badge-primary">184 Pcs</span></td>
                                <td>$3,680.00</td>
                            </tr>
                            <tr>
                                <td>Marco Shoes</td>
                                <td>$28.49</td>
                                <td><span class="badge badge-primary">69 Pcs</span></td>
                                <td>$1,965.81</td>
                            </tr>
                            <tr>
                                <td>ASOS Ridley High Waist</td>
                                <td>$79.49</td>
                                <td><span class="badge badge-primary">82 Pcs</span></td>
                                <td>$6,518.18</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->


<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Table head options</h4>
                <p class="text-muted font-14 mb-4">
                    Use one of two modifier classes to make <code>&lt;thead&gt;</code>s appear light or dark gray.
                </p>

                <div class="table-responsive-sm">
                    <table class="table table-centered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product</th>
                                <th>Courier</th>
                                <th>Process</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ASOS Ridley High Waist</td>
                                <td>FedEx</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><i class="mdi mdi-circle text-success"></i> Delivered</td>
                            </tr>
                            <tr>
                                <td>Marco Lightweight Shirt</td>
                                <td>DHL</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><i class="mdi mdi-circle text-warning"></i> Shipped</td>
                            </tr>
                            <tr>
                                <td>Half Sleeve Shirt</td>
                                <td>Bright</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><i class="mdi mdi-circle text-info"></i> Order Received</td>
                            </tr>
                            <tr>
                                <td>Lightweight Jacket</td>
                                <td>FedEx</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><i class="mdi mdi-circle text-success"></i> Delivered</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Contextual with background color</h4>
                <p class="text-muted font-14 mb-4">
                    Use contextual classes to color table rows or individual cells.
                </p>

                <div class="table-responsive-sm">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Courier</th>
                                <th>Process</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-success">
                                <td>ASOS Ridley High Waist</td>
                                <td>FedEx</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><i class="mdi mdi-circle text-success"></i> Delivered</td>
                            </tr>
                            <tr>
                                <td>Marco Lightweight Shirt</td>
                                <td>DHL</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><i class="mdi mdi-circle text-warning"></i> Shipped</td>
                            </tr>
                            <tr class="bg-danger text-white">
                                <td>Half Sleeve Shirt</td>
                                <td>Bright</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><i class="mdi mdi-circle text-info"></i> Order Received</td>
                            </tr>
                            <tr>
                                <td>Lightweight Jacket</td>
                                <td>FedEx</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><i class="mdi mdi-circle text-success"></i> Delivered</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Always responsive</h4>
                <p class="text-muted font-14 mb-4">
                    Across every breakpoint, use
                    <code>.table-responsive</code> for horizontally scrolling tables. Use
                    <code>.table-responsive{-sm|-md|-lg|-xl}</code> as needed to create responsive tables up to a particular breakpoint. From that breakpoint and up, the table will behave
                    normally and not scroll horizontally.
                </p>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Heading</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection