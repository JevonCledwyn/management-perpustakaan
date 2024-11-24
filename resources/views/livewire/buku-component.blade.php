<div>
    <div class="card">
        <div class="card-header text-white" style="background-color: #808080;">
            Manage Books
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
                            <th scope="col">Judul</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Process</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->judul }}</td>
                                <td>{{ $data->kategori->nama }}</td>
                                <td>{{ $data->penulis }}</td>
                                <td>{{ $data->penerbit }}</td>
                                <td>{{ $data->tahun }}</td>
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
                {{ $buku->links() }}
            </div>
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#createPage">Create</a>
        </div>
    </div>

    <!-- Create Book (Modal) -->
    <div wire:ignore.self class="modal fade" id="createPage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Judul -->
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" wire:model="judul" value="{{ @old('judul') }}">
                            @error('judul')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select wire:model="kategori" class="form-control">
                                <option value="">Choose</option>
                                @foreach ($category as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Penulis -->
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" wire:model="penulis"
                                value="{{ @old('penulis') }}">
                            @error('penulis')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Penerbit -->
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control" wire:model="penerbit"
                                value="{{ @old('penerbit') }}">
                            @error('penerbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- ISBN -->
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control" wire:model="isbn" value="{{ @old('isbn') }}">
                            @error('isbn')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Jumlah -->
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" wire:model="jumlah"
                                value="{{ @old('jumlah') }}">
                            @error('jumlah')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Tahun -->
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" wire:model="tahun" value="{{ @old('tahun') }}">
                            @error('tahun')
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Judul -->
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" wire:model="judul"
                                value="{{ @old('judul') }}">
                            @error('judul')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select wire:model="kategori" class="form-control">
                                <option value="">Choose</option>
                                @foreach ($category as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Penulis -->
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" wire:model="penulis"
                                value="{{ @old('penulis') }}">
                            @error('penulis')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Penerbit -->
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control" wire:model="penerbit"
                                value="{{ @old('penerbit') }}">
                            @error('penerbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- ISBN -->
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control" wire:model="isbn"
                                value="{{ @old('isbn') }}">
                            @error('isbn')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Jumlah -->
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" wire:model="jumlah"
                                value="{{ @old('jumlah') }}">
                            @error('jumlah')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Tahun -->
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" wire:model="tahun"
                                value="{{ @old('tahun') }}">
                            @error('tahun')
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
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
