<div>
    <div class="card">
        <div class="card-header text-white" style="background-color: #808080;">
            Manage Member
        </div>
        <div class="card-body" style="background-color: #f5f5dc;">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <input type="text" wire:model.live="search" class="form-control w-50 mb-3" placeholder="Search . . ."
                style="background-color: #f5f5dc;">
            <div class="table-responsive">
                <table class="table" style="background-color: #f5f5dc;">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Email</th>
                            <th scope="col">Process</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->telepon }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <a href="#" wire:click="edit({{ $data->id }})"
                                        class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editPage">Update</a>
                                    <a href="#" wire:click="confirm({{ $data->id }})"
                                        class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deletePage">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $member->links() }}
            </div>
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#createPage">Create</a>
        </div>
    </div>

    <!-- Create Member (Modal) -->
    <div wire:ignore.self class="modal fade" id="createPage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Nama -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" value="{{ @old('nama') }}">
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Telepon -->
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" wire:model="telepon"
                                value="{{ @old('telepon') }}">
                            @error('telepon')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Alamat -->
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea wire:model="alamat" class="form-control" cols="30" rows="10">{{ @old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" wire:model="email" value="{{ @old('email') }}">
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="create" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit / Update (Modal) -->
    <div wire:ignore.self class="modal fade" id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Nama -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="nama"
                                value="{{ @old('nama') }}">
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Telepon -->
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" wire:model="telepon"
                                value="{{ @old('telepon') }}">
                            @error('telepon')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Alamat -->
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea wire:model="alamat" class="form-control" cols="30" rows="10">{{ @old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" wire:model="email"
                                value="{{ @old('email') }}">
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="update" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete (Modal) -->
    <div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Confirm to Delete Data ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="delete" class="btn btn-primary"
                        data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
