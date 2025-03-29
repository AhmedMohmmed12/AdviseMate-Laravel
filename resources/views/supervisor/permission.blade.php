@extends('layouts.AdviseMateAdvisor')
@section('title','Manage Permissions')
@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            <div class="mt-4 mb-4">
                <h2>User Management</h2>
            </div>
            
            <div class="permissions-container">
                <div class="permissions-header d-flex justify-content-between align-items-center mb-4">
                    <h3>Manage Permissions</h3>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addPermissionModal">
                        <i class="fas fa-plus mr-2"></i>Add New Permission
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped permissions-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Create</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-sm btn-info mr-2">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add Permission Modal -->
<div class="modal fade" id="addPermissionModal" tabindex="-1" role="dialog" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPermissionModalLabel">Add New Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addPermissionForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Permission Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection