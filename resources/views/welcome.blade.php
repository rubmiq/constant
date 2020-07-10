<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ruben Mikayelyan">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/add/js/jquery-ui.js"></script>
    <link href="assets/add/css/jquery-ui.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <nav>
        <div class="container">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal">
                Add Category
            </button>
        </div>
    </nav>
    
    <div class="container">
        <div class="main" class="col-md-12">

        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form">
                        <div class="col-md-12">
                            <label for="name_arm" >Armenian</label>
                            <input id="name_arm" name="name_arm" class="form-control mb-2">
                            <label for="name_rus">Russian</label>
                            <input id="name_rus" name="name_rus" class="form-control mb-2">
                            <label for="name_eng">English</label>
                            <input id="name_eng" name="name_eng" class="form-control mb-2">
                            <label>Category type</label>
                            <select id="add_parent_id" name="parent_id" class="form-control">
                                <option value="0">Main</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="add_category()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form">
                        <div class="col-md-12">
                            <label for="edit_name_arm">Armenian</label>
                            <input id="edit_name_arm" name="name_arm" class="form-control mb-2">
                            <input type="hidden" id="edit_id" class="form-control">
                            <label for="edit_name_rus">Russian</label>
                            <input id="edit_name_rus" name="name_rus" class="form-control mb-2">
                            <label for="edit_name_eng">English</label>
                            <input id="edit_name_eng" name="name_eng" class="form-control mb-2">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="edit_category()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/add/js/scripts.js"></script>
</body>

</html>