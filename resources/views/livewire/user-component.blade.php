<div>
    <div class="card">
        <div class="card-header">
            Manage User
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <input type="text" wire:model.live="search" class="form-control w-50" placeholder="Search . . .">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jenis</th>
                            <th>Process</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->jenis }}</td>
                                <td>
                                    <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPage">Update</a>
                                    <a href="#" wire:click="confirm({{ $data->id }})" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePage">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $user->links() }}
            </div>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createPage">Create</a>
        </div>
    </div>

    <!-- Create (Modal) -->
    <div wire:ignore.self class="modal fade" id="createPage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        {{-- Nama --}}
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" value="{{ @old('nama') }}">
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Email --}}
                        <div class="form-group">
                            <label for="nama">Email</label>
                            <input type="text" class="form-control" wire:model="email" value="{{ @old('nama') }}">
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Password --}}
                        <div class="form-group">
                            <label for="nama">Password</label>
                            <input type="password" class="form-control" wire:model="password"
                                value="{{ @old('nama') }}">
                            @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="create" class="btn btn-primary" data-dismiss="modal">Save</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        {{-- Nama --}}
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" value="{{ @old('nama') }}">
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Email --}}
                        <div class="form-group">
                            <label for="nama">Email</label>
                            <input type="text" class="form-control" wire:model="email" value="{{ @old('nama') }}">
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Password --}}
                        <div class="form-group">
                            <label for="nama">Password</label>
                            <input type="password" class="form-control" wire:model="password"
                                value="{{ @old('nama') }}">
                            @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="update" class="btn btn-primary" data-dismiss="modal">Save</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Confirm to Delete Data ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="delete" class="btn btn-primary" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
