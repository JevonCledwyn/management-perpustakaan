<div>
    <div class="card">
        <!-- Mengubah background header menjadi abu dan teks putih -->
        <div class="card-header text-white" style="background-color: #808080;">
            Manage User
        </div>
        <!-- Mengubah background body menjadi putih tulang -->
        <div class="card-body" style="background-color: #f5f5dc;">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Search input dengan background putih tulang -->
            <input type="text" wire:model.live="search" class="form-control w-50 mb-3" placeholder="Search . . ."
                style="background-color: #f5f5dc;">
            <div class="table-responsive">
                <!-- Table dengan background putih tulang -->
                <table class="table" style="background-color: #f5f5dc;">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Process</th>
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
                                    <!-- Tombol Update dengan warna biru -->
                                    <a href="#" wire:click="edit({{ $data->id }})"
                                        class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editPage">Update</a>
                                    <!-- Tombol Delete tetap berwarna merah -->
                                    <a href="#" wire:click="confirm({{ $data->id }})"
                                        class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deletePage">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $user->links() }}
            </div>
            <!-- Tombol Create dengan warna hijau -->
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#createPage">Create</a>
        </div>
    </div>

    <!-- Create (Modal) -->
    <div wire:ignore.self class="modal fade" id="createPage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #808080;">
                    <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Nama -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" value="{{ @old('nama') }}"
                                style="background-color: #f5f5dc;">
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" wire:model="email" value="{{ @old('email') }}"
                                style="background-color: #f5f5dc;">
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" wire:model="password"
                                value="{{ @old('password') }}" style="background-color: #f5f5dc;">
                            @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="create" class="btn btn-primary"
                        data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit / Update (Modal) -->
    <div wire:ignore.self class="modal fade" id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #808080;">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
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
                                value="{{ @old('nama') }}" style="background-color: #f5f5dc;">
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" wire:model="email"
                                value="{{ @old('email') }}" style="background-color: #f5f5dc;">
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" wire:model="password"
                                value="{{ @old('password') }}" style="background-color: #f5f5dc;">
                            @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="update" class="btn btn-primary"
                        data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete (Modal) -->
    <div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #808080;">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Confirm to Delete Data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="delete" class="btn btn-danger"
                        data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
